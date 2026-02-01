<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        \App\Models\Shipment::factory(10)->create()->each(function ($shipment) {
            \App\Models\StatusLog::factory(3)->create([
                'shipment_id' => $shipment->id,
                'status' => $shipment->status // Match current status likely, or random history
            ]);
        });
    }
}
