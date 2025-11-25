<?php

namespace Database\Seeders\webz;

use App\Models\Project;
use App\Models\Task;
use App\Models\Timesheet;
use App\Models\WorkerProfile;
use Illuminate\Database\Seeder;

class TimesheetSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $workers = WorkerProfile::all();
        $projects = Project::all();

        if ($workers->isEmpty() || $projects->isEmpty()) {
            $this->command->warn('Workers or Projects not found. Please run WorkerProfileSeeder and ProjectSeeder first.');
            return;
        }

        foreach ($workers as $worker) {
            // Create 10-20 timesheet entries per worker
            for ($i = 0; $i < rand(10, 20); $i++) {
                $randomDate = fake()->dateTimeBetween('-2 months', 'now');

                $project = $projects->random();

                $tasks = $project->tasks;
                $task = $tasks->isEmpty() ? null : $tasks->random();

                Timesheet::factory()->create([
                    'worker_profile_id' => $worker->id,
                    'project_id' => $project->id,
                    'task_id' => $task?->id,
                    'date' => $randomDate,
                    'hours_worked' => fake()->randomFloat(1, 4, 12),
                    'activity_description' => fake()->sentence(),
                    'entry_type' => fake()->randomElement(['regular', 'overtime', 'vacation', 'sick_leave']),
                    'status' => fake()->randomElement(['pending', 'approved', 'rejected']),
                    'notes' => fake()->optional()->sentence(),
                    'approved_by' => fake()->optional()->numberBetween(1, 5),  // Random approver ID
                    'approved_at' => fake()->optional()->dateTimeBetween($randomDate, 'now'),
                ]);
            }
        }
    }
}
