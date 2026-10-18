<?php

declare(strict_types=1);

namespace Database\Factories;

use App\Models\Client;
use App\Models\Project;
use Illuminate\Database\Eloquent\Factories\Factory;

final class ProjectFactory extends Factory
{
    protected $model = Project::class;

    public function definition(): array
    {
        return [
            'name' => fake()->sentence(3),
            'description' => fake()->paragraph(),
            'status' => fake()->randomElement(['planning', 'in_progress', 'completed', 'on_hold']),
            'due_date' => fake()->optional()->date(),
            'client_id' => Client::factory(),
        ];
    }

    /**
     * Configure the factory to have a client relationship
     */
    public function withClient(): static
    {
        return $this->state(fn (array $attributes): array => [
            'client_id' => Client::factory(),
        ]);
    }
}
