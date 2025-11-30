<?php

namespace Database\Factories;

use App\Models\Milestone;
use App\Models\Project;
use App\Models\ProjectPhase;
use Illuminate\Database\Eloquent\Factories\Factory;

class MilestoneFactory extends Factory
{
    protected $model = Milestone::class;

    public function definition(): array
    {
        return [
            'name' => fake()->sentence(3),
            'description' => fake()->paragraph(),
            'project_id' => Project::factory(),
            'project_phase_id' => fake()->optional()->numberBetween(1, 10),
            'due_date' => fake()->dateTimeBetween('now', '+6 months'),
            'status' => fake()->randomElement(['not_started', 'in_progress', 'completed', 'on_hold']),
            'order' => fake()->numberBetween(1, 100),
        ];
    }
}