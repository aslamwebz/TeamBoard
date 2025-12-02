<?php

namespace Database\Factories;

use App\Models\Project;
use App\Models\Client;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class ProjectFactory extends Factory
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
        return $this->state(function (array $attributes) {
            return [
                'client_id' => Client::factory(),
            ];
        });
    }

}