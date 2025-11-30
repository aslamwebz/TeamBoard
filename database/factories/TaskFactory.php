<?php

namespace Database\Factories;

use App\Models\Task;
use App\Models\Project;
use App\Models\User;
use App\Models\ProjectPhase;
use Illuminate\Database\Eloquent\Factories\Factory;

class TaskFactory extends Factory
{
    protected $model = Task::class;

    public function definition(): array
    {
        return [
            'title' => fake()->sentence(3),
            'description' => fake()->optional()->paragraph(),
            'status' => fake()->randomElement(['todo', 'in_progress', 'completed', 'on_hold']),
            'due_date' => fake()->optional()->date('+2 weeks'),
            'project_id' => Project::factory(),
            'user_id' => fake()->optional()->numberBetween(1, 10), // 20% chance of having a user assigned
            'project_phase_id' => fake()->optional()->numberBetween(1, 10),
            'priority' => fake()->randomElement(['low', 'medium', 'high', 'critical']),
            'estimated_hours' => fake()->optional()->randomFloat(1, 1, 160),
            'actual_hours' => fake()->optional()->randomFloat(1, 0, 200),
        ];
    }

    /**
     * Configure the factory to have a project relationship
     */
    public function withProject(): static
    {
        return $this->state(function (array $attributes) {
            return [
                'project_id' => Project::factory(),
            ];
        });
    }

    /**
     * Configure the factory to have a user relationship
     */
    public function withUser(): static
    {
        return $this->state(function (array $attributes) {
            return [
                'user_id' => User::factory(),
            ];
        });
    }

    /**
     * Configure the factory to have a project phase relationship
     */
    public function withPhase(): static
    {
        return $this->state(function (array $attributes) {
            return [
                'project_phase_id' => ProjectPhase::factory(),
            ];
        });
    }
}