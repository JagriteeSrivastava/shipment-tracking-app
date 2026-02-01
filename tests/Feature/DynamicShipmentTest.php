<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\Shipment;

class DynamicShipmentTest extends TestCase
{
    use RefreshDatabase;

    public function test_create_shipment_form_loads(): void
    {
        $response = $this->get('/shipments/create');
        $response->assertStatus(200);
    }

    public function test_can_create_new_shipment(): void
    {
        // Tracking number is now auto-generated, so we don't pass it
        $response = $this->post('/shipments', [
            // 'tracking_number' => 'TEST12345', // Readonly in view, handled in controller/validation if we allow it or generated
            'tracking_number' => 'TEST12345', // Controller validation still expects it
            'sender_name' => 'John Doe',
            'sender_address' => '123 Sender St',
            'receiver_name' => 'Jane Doe',
            'receiver_address' => '456 Receiver Ave',
            'shipment_date' => now()->format('Y-m-d'),
        ]);

        $response->assertStatus(302); // Redirect back or to show page
        $this->assertDatabaseHas('shipments', ['tracking_number' => 'TEST12345']);
        $this->assertDatabaseHas('status_logs', ['status' => 'Pending']);
    }

    public function test_can_update_shipment_status(): void
    {
        $shipment = Shipment::factory()->create(['status' => 'Pending']);

        $response = $this->post(route('shipments.status.update', $shipment->id), [
            'status' => 'In Transit',
            'location' => 'Hub City',
        ]);

        $response->assertStatus(302); // Redirect back
        $this->assertDatabaseHas('shipments', [
            'id' => $shipment->id,
            'status' => 'In Transit'
        ]);
        $this->assertDatabaseHas('status_logs', [
            'shipment_id' => $shipment->id,
            'status' => 'In Transit',
            'location' => 'Hub City'
        ]);
    }
}
