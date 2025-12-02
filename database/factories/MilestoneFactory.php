<?php

declare(strict_types=1);

namespace Database\Factories;

use App\Models\Milestone;
use App\Models\Project;
use Illuminate\Database\Eloquent\Factories\Factory;

final class MilestoneFactory extends Factory
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
