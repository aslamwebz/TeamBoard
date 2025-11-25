<?php

namespace Database\Factories;

use App\Models\Report;
use Illuminate\Database\Eloquent\Factories\Factory;

class ReportFactory extends Factory
{
    protected $model = Report::class;

    public function definition(): array
    {
        return [
            'name' => fake()->words(3, true),
            'type' => fake()->randomElement(['sales', 'project', 'financial', 'client', 'expense', 'invoice', 'team', 'vendor', 'task', 'revenue']),
            'description' => fake()->sentence(),
        ];
    }
}