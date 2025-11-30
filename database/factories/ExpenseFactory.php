<?php

namespace Database\Factories;

use App\Models\Expense;
use App\Models\ExpenseCategory;
use App\Models\Project;
use App\Models\Vendor;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class ExpenseFactory extends Factory
{
    protected $model = Expense::class;

    public function definition(): array
    {
        $expenseDate = fake()->dateTimeBetween('-6 months', 'now');

        return [
            'expense_category_id' => ExpenseCategory::factory(),
            'project_id' => Project::factory(),
            'vendor_id' => Vendor::factory(),
            'user_id' => User::factory(),
            'title' => fake()->words(3, true),
            'description' => fake()->sentence(),
            'amount' => fake()->randomFloat(2, 50, 5000),
            'currency' => 'USD',
            'expense_date' => $expenseDate,
            'status' => fake()->randomElement(['pending', 'approved', 'rejected', 'paid', 'cancelled']),
            'payment_method' => fake()->optional()->randomElement(['cash', 'credit_card', 'debit_card', 'bank_transfer', 'check', 'paypal', 'other']),
            'notes' => fake()->optional()->sentence(),
            'receipt_path' => null, // Will be set via relationship in seeder
            'approver_id' => null, // Will be set to a valid user ID if needed
            'approved_at' => null, // Will be set via relationship in seeder
            'custom_fields' => null,
        ];
    }

    /**
     * Configure the factory to have an expense category relationship
     */
    public function withCategory(): static
    {
        return $this->state(function (array $attributes) {
            return [
                'expense_category_id' => ExpenseCategory::factory(),
            ];
        });
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
     * Configure the factory to have a vendor relationship
     */
    public function withVendor(): static
    {
        return $this->state(function (array $attributes) {
            return [
                'vendor_id' => Vendor::factory(),
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
     * Configure the factory to have an approver relationship
     */
    public function withApprover(): static
    {
        return $this->state(function (array $attributes) {
            return [
                'approver_id' => User::factory(),
            ];
        });
    }
}