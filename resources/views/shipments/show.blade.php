@extends('layouts.app')

@section('content')
    <div class="animate-fade-in">
        <a href="{{ route('shipments.index') }}" class="btn btn-secondary"
            style="margin-bottom: 1rem; display: inline-flex; gap: 0.5rem;">
            <span>&larr;</span> Back to List
        </a>

        <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 2rem; align-items: start;">
            <!-- Left: Details -->
            <div class="card glass">
                <h2 style="margin-top: 0;">{{ $shipment->tracking_number }}</h2>
                <div style="display: flex; gap: 1rem; align-items: center; margin-bottom: 2rem;">
                    <span class="badge badge-{{ str_replace(' ', '-', $shipment->status) }}"
                        style="font-size: 1rem; padding: 0.5rem 1rem;">
                        {{ $shipment->status }}
                    </span>
                    <span style="color: var(--text-muted);">
                        Created: {{ \Carbon\Carbon::parse($shipment->shipment_date)->format('M d, Y') }}
                    </span>
                </div>

                <div style="display: grid; gap: 2rem;">
                    <div>
                        <h3
                            style="color: var(--text-muted); font-size: 0.9rem; text-transform: uppercase; margin-bottom: 0.5rem;">
                            From</h3>
                        <p style="margin: 0; font-weight: 600;">{{ $shipment->sender_name }}</p>
                        <p style="margin: 0; color: var(--text-muted);">{{ $shipment->sender_address }}</p>
                    </div>
                    <div>
                        <h3
                            style="color: var(--text-muted); font-size: 0.9rem; text-transform: uppercase; margin-bottom: 0.5rem;">
                            To</h3>
                        <p style="margin: 0; font-weight: 600;">{{ $shipment->receiver_name }}</p>
                        <p style="margin: 0; color: var(--text-muted);">{{ $shipment->receiver_address }}</p>
                    </div>
                </div>
            </div>

            <!-- Right: Timeline -->
            <div>
                <h3 style="margin-top: 0; margin-bottom: 1.5rem;">Tracking History</h3>

                <div class="timeline">
                    @foreach($shipment->statusLogs as $log)
                        <div class="timeline-item">
                            <div class="timeline-dot"></div>
                            <div class="timeline-content">
                                <div style="display: flex; justify-content: space-between; margin-bottom: 0.5rem;">
                                    <strong style="color: var(--primary);">{{ $log->status }}</strong>
                                    <span style="color: var(--text-muted); font-size: 0.85rem;">
                                        {{ $log->created_at->format('M d, H:i') }}
                                    </span>
                                </div>
                                <p style="margin: 0; font-size: 0.9rem;">
                                    Location: {{ $log->location }}
                                </p>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>

            <!-- Update Status Form -->
            <div style="margin-top: 2rem; border-top: 2px solid #f3f4f6; padding-top: 2rem;">
                <h3 style="margin-top: 0; margin-bottom: 1rem;">Update Status</h3>
                <form action="{{ route('shipments.status.update', $shipment->id) }}" method="POST">
                    @csrf
                    <div style="margin-bottom: 1rem;">
                        <label style="display: block; margin-bottom: 0.5rem; font-size: 0.9rem; font-weight: 500;">New
                            Status</label>
                        <select name="status"
                            style="width: 100%; padding: 0.5rem; border: 1px solid #d1d5db; border-radius: 0.5rem; font-family: inherit;"
                            required>
                            <option value="Pending">Pending</option>
                            <option value="In Transit">In Transit</option>
                            <option value="Delivered">Delivered</option>
                        </select>
                    </div>
                    <div style="margin-bottom: 1rem;">
                        <label style="display: block; margin-bottom: 0.5rem; font-size: 0.9rem; font-weight: 500;">Current
                            Location</label>
                        <input type="text" name="location" placeholder="City, Country"
                            style="width: 100%; padding: 0.5rem; border: 1px solid #d1d5db; border-radius: 0.5rem; font-family: inherit;"
                            required>
                    </div>
                    <button type="submit" class="btn btn-primary" style="width: 100%;">Update Status</button>
                </form>
            </div>

        </div>
    </div>

    <style>
        /* Responsive adjustment for this page */
        @media (max-width: 768px) {
            div[style*="grid-template-columns"] {
                grid-template-columns: 1fr !important;
            }
        }
    </style>
@endsection