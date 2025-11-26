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
            'expense_category_id' => null, // Will be set via relationship in seeder
            'project_id' => null, // Will be set via relationship in seeder
            'vendor_id' => null, // Will be set via relationship in seeder
            'user_id' => null, // Will be set via relationship in seeder
            'title' => fake()->words(3, true),
            'description' => fake()->sentence(),
            'amount' => fake()->randomFloat(2, 50, 5000),
            'currency' => 'USD',
            'expense_date' => $expenseDate,
            'status' => fake()->randomElement(['pending', 'approved', 'rejected', 'paid', 'cancelled']),
            'payment_method' => fake()->optional()->randomElement(['cash', 'credit_card', 'debit_card', 'bank_transfer', 'check', 'paypal', 'other']),
            'notes' => fake()->optional()->sentence(),
            'receipt_path' => null, // Will be set via relationship in seeder
            'approver_id' => null, // Will be set via relationship in seeder
            'approved_at' => null, // Will be set via relationship in seeder
            'custom_fields' => null,
        ];
    }
}