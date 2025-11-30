<?php

namespace Database\Factories;

use App\Models\ProjectPhase;
use App\Models\Project;
use Illuminate\Database\Eloquent\Factories\Factory;

class ProjectPhaseFactory extends Factory
{
    protected $model = ProjectPhase::class;

    public function definition(): array
    {
        return [
            'name' => fake()->words(3, true),
            'description' => fake()->optional()->paragraph(),
            'project_id' => Project::factory(),
            'start_date' => fake()->optional()->dateTimeBetween('-1 month', 'now'),
            'end_date' => fake()->optional()->dateTimeBetween('now', '+4 weeks'),
            'status' => fake()->randomElement(['not_started', 'in_progress', 'completed', 'on_hold']),
            'order' => fake()->numberBetween(1, 10),
        ];
    }
}