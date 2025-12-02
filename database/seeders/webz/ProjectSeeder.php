<?php

declare(strict_types=1);

namespace Database\Seeders\webz;

use App\Models\Project;
use Illuminate\Database\Seeder;

final class ProjectSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Create random projects using factory
        Project::factory()->count(10)->create();
    }
}
