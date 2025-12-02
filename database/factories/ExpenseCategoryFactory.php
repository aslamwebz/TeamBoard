<?php

declare(strict_types=1);

namespace Database\Factories;

use App\Models\ExpenseCategory;
use Illuminate\Database\Eloquent\Factories\Factory;

final class ExpenseCategoryFactory extends Factory
{
    protected $model = ExpenseCategory::class;

    public function definition(): array
    {
        return [
            'name' => fake()->word().' Expense',
            'description' => fake()->sentence(),
            'color' => fake()->hexColor(),
            'is_active' => fake()->boolean(),
        ];
    }
}
