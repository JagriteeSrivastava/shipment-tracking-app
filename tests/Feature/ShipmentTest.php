<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\Shipment;
use App\Models\StatusLog;

class ShipmentTest extends TestCase
{
    use RefreshDatabase;

    public function test_shipment_list_page_loads(): void
    {
        $response = $this->get('/shipments');
        $response->assertStatus(200);
    }

    public function test_shipment_details_page_loads(): void
    {
        $shipment = Shipment::factory()->create();
        $response = $this->get('/shipments/' . $shipment->id);
        $response->assertStatus(200);
        $response->assertSee($shipment->tracking_number);
    }

    public function test_search_functionality(): void
    {
        Shipment::factory()->create(['tracking_number' => 'ABC12345']);
        Shipment::factory()->create(['tracking_number' => 'XYZ98765']);

        // DataTables now uses AJAX, so we test the JSON response
        $response = $this->get('/shipments?tracking_number=ABC', ['X-Requested-With' => 'XMLHttpRequest']);
        
        $response->assertStatus(200);
        $response->assertJsonFragment(['tracking_number' => 'ABC12345']);
        $response->assertJsonMissing(['tracking_number' => 'XYZ98765']);
    }

    public function test_timeline_display(): void
    {
        $shipment = Shipment::factory()->create();
        $log = StatusLog::factory()->create(['shipment_id' => $shipment->id, 'status' => 'Testing Status']);

        $response = $this->get('/shipments/' . $shipment->id);
        $response->assertSee('Testing Status');
    }
}
