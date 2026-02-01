@extends('layouts.app')

@section('content')
<div class="animate-fade-in">
    <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 2rem;">
        <h1>Shipments</h1>
        <a href="{{ route('shipments.create') }}" class="btn btn-primary">New Shipment</a>
    </div>

    <!-- Custom Filter -->
    <div class="card glass" style="margin-bottom: 1rem; padding: 1rem;">
        <div style="display: flex; gap: 1rem; align-items: center;">
            <label style="font-weight: 500;">Filter by Tracking #:</label>
            <input type="text" id="tracking_filter" placeholder="Enter Tracking Number" 
                style="padding: 0.5rem; border: 1px solid #d1d5db; border-radius: 0.5rem; width: 250px;">
        </div>
    </div>

    <div class="card glass table-container" style="padding: 1.5rem;">
        <table id="shipments-table" class="table table-borderless" style="width:100%">
            <thead>
                <tr>
                    <th>Tracking #</th>
                    <th>Receiver</th>
                    <th>Destination</th>
                    <th>Status</th>
                    <th>Date</th>
                    <th>Action</th>
                </tr>
            </thead>
        </table>
    </div>
</div>

@push('scripts')
<script>
    $(document).ready(function() {
        var table = $('#shipments-table').DataTable({
            processing: true,
            serverSide: true,
            ajax: {
                url: "{{ route('shipments.index') }}",
                data: function (d) {
                    d.tracking_number = $('#tracking_filter').val();
                }
            },
            columns: [
                {data: 'tracking_number', name: 'tracking_number'},
                {data: 'receiver_name', name: 'receiver_name'},
                {data: 'receiver_address', name: 'sender_address'}, 
                {data: 'status', name: 'status'},
                {data: 'shipment_date', name: 'shipment_date'},
                {data: 'action', name: 'action', orderable: false, searchable: false},
            ],
            language: {
                search: "_INPUT_",
                searchPlaceholder: "Search all columns..."
            }
        });

        $('#tracking_filter').on('keyup', function() {
            table.draw();
        });
    });
</script>
@endpush
@endsection