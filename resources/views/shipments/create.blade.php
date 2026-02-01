@extends('layouts.app')

@section('content')
    <div class="animate-fade-in" style="max-width: 600px; margin: 0 auto;">
        <a href="{{ route('shipments.index') }}" class="btn btn-secondary"
            style="margin-bottom: 1rem; display: inline-flex; gap: 0.5rem;">
            <span>&larr;</span> Back to List
        </a>

        <div class="card glass">
            <h2 style="margin-top: 0; margin-bottom: 1.5rem;">Create New Shipment</h2>

            <form action="{{ route('shipments.store') }}" method="POST">
                @csrf

                <div style="margin-bottom: 1rem;">
                    <label style="display: block; margin-bottom: 0.5rem; font-weight: 500;">Tracking Number</label>
                    <input type="text" name="tracking_number" value="{{ strtoupper(Str::random(10)) }}"
                        style="width: 100%; padding: 0.75rem; border: 1px solid #d1d5db; border-radius: 0.5rem; font-family: inherit; background-color: #f3f4f6; color: #6b7280; cursor: not-allowed;"
                        readonly>
                    @error('tracking_number') <span style="color: red; font-size: 0.85rem;">{{ $message }}</span> @enderror
                </div>

                <div style="margin-bottom: 1rem;">
                    <label style="display: block; margin-bottom: 0.5rem; font-weight: 500;">Sender Name</label>
                    <input type="text" name="sender_name"
                        style="width: 100%; padding: 0.75rem; border: 1px solid #d1d5db; border-radius: 0.5rem; font-family: inherit;"
                        required>
                </div>

                <div style="margin-bottom: 1rem;">
                    <label style="display: block; margin-bottom: 0.5rem; font-weight: 500;">Sender Address</label>
                    <textarea name="sender_address" rows="3"
                        style="width: 100%; padding: 0.75rem; border: 1px solid #d1d5db; border-radius: 0.5rem; font-family: inherit;"
                        required></textarea>
                </div>

                <div style="margin-bottom: 1rem;">
                    <label style="display: block; margin-bottom: 0.5rem; font-weight: 500;">Receiver Name</label>
                    <input type="text" name="receiver_name"
                        style="width: 100%; padding: 0.75rem; border: 1px solid #d1d5db; border-radius: 0.5rem; font-family: inherit;"
                        required>
                </div>

                <div style="margin-bottom: 1rem;">
                    <label style="display: block; margin-bottom: 0.5rem; font-weight: 500;">Receiver Address</label>
                    <textarea name="receiver_address" rows="3"
                        style="width: 100%; padding: 0.75rem; border: 1px solid #d1d5db; border-radius: 0.5rem; font-family: inherit;"
                        required></textarea>
                </div>

                <div style="margin-bottom: 1.5rem;">
                    <label style="display: block; margin-bottom: 0.5rem; font-weight: 500;">Shipment Date</label>
                    <input type="date" name="shipment_date" value="{{ date('Y-m-d') }}"
                        style="width: 100%; padding: 0.75rem; border: 1px solid #d1d5db; border-radius: 0.5rem; font-family: inherit;"
                        required>
                </div>

                <button type="submit" class="btn btn-primary" style="width: 100%;">Create Shipment</button>
            </form>
        </div>
    </div>
@endsection