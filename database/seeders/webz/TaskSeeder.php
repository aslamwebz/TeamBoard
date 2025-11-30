<?php

namespace Database\Seeders\webz;

use App\Models\Task;
use Illuminate\Database\Seeder;

class TaskSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Create random tasks using factory
        Task::factory()->count(50)->create();
    }
}