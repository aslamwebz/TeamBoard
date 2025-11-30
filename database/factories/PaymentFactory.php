<?php

namespace Database\Factories;

use App\Models\Payment;
use App\Models\Invoice;
use App\Models\Expense;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class PaymentFactory extends Factory
{
    protected $model = Payment::class;

    public function definition(): array
    {
        return [
            'invoice_id' => fake()->optional(0.7)->numberBetween(1, 10),
            'expense_id' => fake()->optional(0.5)->numberBetween(1, 10),
            'user_id' => User::factory(),
            'amount' => fake()->randomFloat(2, 100, 5000),
            'payment_method' => fake()->randomElement(['cash', 'credit_card', 'debit_card', 'bank_transfer', 'check', 'paypal', 'stripe', 'other']),
            'transaction_reference' => fake()->uuid(),
            'payment_date' => fake()->date(),
            'notes' => fake()->optional()->sentence(),
            'status' => fake()->randomElement(['pending', 'processing', 'completed', 'failed', 'refunded', 'cancelled']),
            'currency' => 'USD',
            'custom_fields' => null,
        ];
    }
}