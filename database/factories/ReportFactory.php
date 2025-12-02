<?php

declare(strict_types=1);

namespace Database\Factories;

use App\Models\Report;
use Illuminate\Database\Eloquent\Factories\Factory;

final class ReportFactory extends Factory
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
