<?php

namespace Database\Seeders\webz;

use App\Models\Invoice;
use Illuminate\Database\Seeder;

class InvoicePaymentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $invoices = Invoice::whereIn('status', ['paid', 'partial'])->get();

        if ($invoices->isEmpty()) {
            $this->command->warn('No paid or partially paid invoices found.');
            return;
        }

        foreach ($invoices as $invoice) {
            $paidAmount = 0;
            $remaining = $invoice->total;

            // Create 1-3 payments for paid invoices
            $paymentCount = $invoice->status === 'paid' ? rand(1, 3) : 1;

            for ($i = 0; $i < $paymentCount; $i++) {
                if ($remaining <= 0)
                    break;

                $paymentAmount = $paymentCount === 1 ? $remaining : (
                    $i === $paymentCount - 1 ? $remaining : min($remaining, $invoice->total / $paymentCount)
                );

                $invoice->payments()->create([
                    'amount' => $paymentAmount,
                    'payment_method' => fake()->randomElement(['credit_card', 'bank_transfer', 'check', 'paypal', 'cash']),
                    'payment_date' => fake()->dateTimeBetween($invoice->issue_date, $invoice->due_date),
                    'transaction_reference' => 'TXN-' . strtoupper(fake()->bothify('?????-#####')),
                    'notes' => fake()->sentence(),
                ]);

                $paidAmount += $paymentAmount;
                $remaining -= $paymentAmount;
            }
        }
    }
}
