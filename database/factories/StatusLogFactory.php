<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\StatusLog>
 */
class StatusLogFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'shipment_id' => \App\Models\Shipment::factory(),
            'status' => fake()->randomElement(['Pending', 'In Transit', 'Delivered']),
            'location' => fake()->city(),
        ];
    }
}
