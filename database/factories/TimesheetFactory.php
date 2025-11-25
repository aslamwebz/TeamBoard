<?php

namespace Database\Factories;

use App\Models\Timesheet;
use App\Models\WorkerProfile;
use App\Models\Project;
use App\Models\Task;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class TimesheetFactory extends Factory
{
    protected $model = Timesheet::class;

    public function definition(): array
    {
        $date = fake()->dateTimeBetween('-1 month', 'now');
        $status = fake()->randomElement(['pending', 'approved', 'rejected']);
        
        return [
            'worker_profile_id' => WorkerProfile::factory(),
            'project_id' => fake()->optional(0.8)->numberBetween(1, 10), // 80% chance of having a project
            'task_id' => fake()->optional(0.6)->numberBetween(1, 30), // 60% chance of having a task
            'date' => $date,
            'hours_worked' => fake()->randomFloat(1, 1, 12),
            'activity_description' => fake()->sentence(),
            'entry_type' => fake()->randomElement(['regular', 'overtime', 'vacation', 'sick_leave', 'holiday']),
            'status' => $status,
            'approved_by' => $status === 'approved' ? fake()->optional()->numberBetween(1, 5) : null,
            'approved_at' => $status === 'approved' ? fake()->dateTimeBetween($date, 'now') : null,
            'notes' => fake()->optional()->sentence(),
        ];
    }
}