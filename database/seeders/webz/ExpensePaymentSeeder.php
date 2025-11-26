<?php

namespace Database\Seeders\webz;

use App\Models\Expense;
use App\Models\Payment;
use Illuminate\Database\Seeder;

class ExpensePaymentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $expenses = Expense::whereIn('status', ['paid', 'partially_paid', 'approved'])->get();

        if ($expenses->isEmpty()) {
            $this->command->warn('No paid or approved expenses found.');
            return;
        }

        foreach ($expenses as $expense) {
            $paidAmount = 0;
            $remaining = $expense->amount;

            // Create 1-2 payments for paid expenses
            $paymentCount = $expense->status === 'paid' ? rand(1, 2) : 1;

            for ($i = 0; $i < $paymentCount; $i++) {
                if ($remaining <= 0)
                    break;

                $paymentAmount = $paymentCount === 1 ? $remaining : (
                    $i === $paymentCount - 1 ? $remaining : min($remaining, $expense->amount / $paymentCount)
                );

                Payment::create([
                    'expense_id' => $expense->id,
                    'user_id' => $expense->user_id ?? 1, // Use expense's user_id or default to 1
                    'amount' => $paymentAmount,
                    'payment_method' => fake()->randomElement(['credit_card', 'bank_transfer', 'check', 'paypal', 'cash', 'debit_card']),
                    'payment_date' => fake()->dateTimeBetween($expense->expense_date, now()),
                    'transaction_reference' => 'EXP-PAY-' . strtoupper(fake()->bothify('?????-#####')),
                    'notes' => fake()->sentence(),
                    'status' => Payment::STATUS_COMPLETED,
                    'currency' => $expense->currency ?? 'USD',
                ]);

                $paidAmount += $paymentAmount;
                $remaining -= $paymentAmount;
            }
        }
    }
}