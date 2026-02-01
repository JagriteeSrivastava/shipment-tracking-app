<?php

namespace App\Http\Controllers;

use App\Models\Shipment;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;
use Yajra\DataTables\Facades\DataTables;

class ShipmentController extends Controller
{
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $query = Shipment::latest();

            if ($request->has('tracking_number') && !empty($request->tracking_number)) {
                $query->where('tracking_number', 'like', "%{$request->tracking_number}%");
            }

            return DataTables::of($query)
                ->addColumn('action', function ($row) {
                    return '<a href="' . route('shipments.show', $row->id) . '" class="btn btn-primary" style="padding: 0.25rem 0.5rem; font-size: 0.8rem;">View</a>';
                })
                ->editColumn('shipment_date', function ($row) {
                    return \Carbon\Carbon::parse($row->shipment_date)->format('M d, Y');
                })
                ->editColumn('status', function ($row) {
                    return '<span class="badge badge-' . str_replace(' ', '-', $row->status) . '">' . $row->status . '</span>';
                })
                ->rawColumns(['action', 'status'])
                ->make(true);
        }

        return view('shipments.index');
    }

    public function show($id)
    {
        $shipment = Shipment::with(['statusLogs' => function($query) {
            $query->latest();
        }])->findOrFail($id);

        return view('shipments.show', compact('shipment'));
    }

    public function create()
    {
        return view('shipments.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'tracking_number' => 'required|unique:shipments',
            'sender_name' => 'required',
            'sender_address' => 'required',
            'receiver_name' => 'required',
            'receiver_address' => 'required',
            'shipment_date' => 'required|date',
        ]);

        $shipment = Shipment::create($validated + ['status' => 'Pending']);

        // Initial log
        $shipment->statusLogs()->create([
            'status' => 'Pending',
            'location' => 'Sender Location', // Simplification
        ]);

        Alert::success('Success', 'Shipment Created Successfully!');
        return redirect()->route('shipments.show', $shipment->id);
    }

    public function updateStatus(Request $request, $id)
    {
        $shipment = Shipment::findOrFail($id);
        
        $validated = $request->validate([
            'status' => 'required',
            'location' => 'required',
        ]);

        $shipment->update(['status' => $validated['status']]);

        $shipment->statusLogs()->create([
            'status' => $validated['status'],
            'location' => $validated['location'],
        ]);
        
        Alert::success('Success', 'Status Updated Successfully!');
        return back();
    }
}
