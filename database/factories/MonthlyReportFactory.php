<?php

namespace Database\Factories;

use App\Models\MonthlyReport;
use App\Models\Report;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class MonthlyReportFactory extends Factory
{
    protected $model = MonthlyReport::class;

    public function definition(): array
    {
        $startDate = fake()->dateTimeThisYear();
        $endDate = clone $startDate;
        $endDate->modify('+1 month');

        return [
            'report_id' => Report::factory(),
            'period_start' => $startDate,
            'period_end' => $endDate,
            'data' => json_encode([
                'summary' => fake()->paragraph(),
                'metrics' => [
                    'total' => fake()->randomFloat(2, 1000, 50000),
                    'change_percent' => fake()->randomFloat(2, -20, 30),
                ],
                'insights' => [fake()->sentence(), fake()->sentence(), fake()->sentence()],
            ]),
            'generated_at' => fake()->dateTimeBetween($startDate, $endDate),
            'generated_by' => User::factory(),
        ];
    }
}