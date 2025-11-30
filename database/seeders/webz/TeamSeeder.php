<?php

namespace Database\Seeders\webz;

use App\Models\Team;
use Illuminate\Database\Seeder;

class TeamSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Create random teams using factory
        Team::factory()->count(10)->create();
    }
}