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
        // Create or get a user
        $user = User::inRandomOrder()->first() ?? User::factory()->create();
        
        // Only create invoice or expense if they don't exist
        $invoice = Invoice::inRandomOrder()->first();
        $expense = Expense::inRandomOrder()->first();
        
        // Only set expense_id if we have an expense
        $expenseId = null;
        if ($expense && fake()->boolean(50)) {
            $expenseId = $expense->id;
        }
        
        // Only set invoice_id if we have an invoice
        $invoiceId = null;
        if ($invoice && fake()->boolean(70)) {
            $invoiceId = $invoice->id;
        }

        return [
            'invoice_id' => $invoiceId,
            'expense_id' => $expenseId,
            'user_id' => $user->id,
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