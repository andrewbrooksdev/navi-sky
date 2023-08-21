<?php

namespace Database\Factories;

use App\Models\Trip;
use App\Models\Waypoint;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Waypoint>
 */
class WaypointFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'trip_id' => Trip::factory(),
            'lat' => $this->faker->latitude,
            'lng' => $this->faker->longitude,
            'depart_at' => $this->faker->dateTimeBetween('+1 days', '+7 days'),
        ];
    }
}
