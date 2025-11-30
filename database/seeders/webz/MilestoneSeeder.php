<?php

namespace Database\Seeders\webz;

use App\Models\Milestone;
use Illuminate\Database\Seeder;

class MilestoneSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Create random milestones using factory
        Milestone::factory()->count(40)->create();
    }
}