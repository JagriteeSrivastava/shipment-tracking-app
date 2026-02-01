<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Shipment>
 */
class ShipmentFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'tracking_number' => strtoupper(fake()->unique()->bothify('KR##??#####')),
            'sender_name' => fake()->name(),
            'sender_address' => fake()->address(),
            'receiver_name' => fake()->name(),
            'receiver_address' => fake()->address(),
            'status' => fake()->randomElement(['Pending', 'In Transit', 'Delivered']),
            'shipment_date' => fake()->date(),
        ];
    }
}
