<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\ActivityLog>
 */
class ActivityLogFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'action' => fake()->word(),
            'description' => fake()->sentence(),
            'type' => fake()->word(),
            'type_id' => 1,
            'user_id' => 1,
            'metadata' => ['key' => 'value', 'key2' => 'value2'],
        ];
    }
}
