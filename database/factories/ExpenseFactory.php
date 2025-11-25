<?php

namespace Database\Factories;

use App\Models\Expense;
use App\Models\Vendor;
use Illuminate\Database\Eloquent\Factories\Factory;

class ExpenseFactory extends Factory
{
    protected $model = Expense::class;

    public function definition(): array
    {
        $expenseDate = fake()->dateTimeBetween('-6 months', 'now');

        return [
            'vendor_id' => Vendor::factory(),
            'name' => fake()->words(3, true),
            'category' => fake()->randomElement(['travel', 'office', 'software', 'consulting', 'utilities', 'rent', 'marketing', 'training', 'equipment', 'meals']),
            'description' => fake()->sentence(),
            'amount' => fake()->randomFloat(2, 50, 5000),
            'expense_date' => $expenseDate,
            'expense_type' => fake()->randomElement(['travel', 'office', 'software', 'consulting', 'utilities', 'rent', 'marketing', 'training', 'equipment', 'meals']),
            'status' => fake()->randomElement(['draft', 'pending_approval', 'approved', 'paid', 'rejected']),
            'receipt_url' => fake()->optional()->url(),
            'notes' => fake()->optional()->sentence(),
        ];
    }
}