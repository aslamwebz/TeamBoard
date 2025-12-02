<?php

declare(strict_types=1);

namespace Database\Seeders\webz;

use App\Models\Milestone;
use Illuminate\Database\Seeder;

final class MilestoneSeeder extends Seeder
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
