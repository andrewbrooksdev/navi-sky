<?php

namespace Database\Seeders;

use App\Models\Trip;
use App\Models\User;
use App\Models\Waypoint;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        User::factory(10)->create();
        Trip::factory(50)->create();
        Waypoint::factory(50)->create();
    }
}
