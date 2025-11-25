<?php

namespace Database\Seeders\webz;

use App\Models\PaymentMethod;
use Illuminate\Database\Seeder;

class PaymentRecordSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $paymentMethods = PaymentMethod::all();

        if ($paymentMethods->isEmpty()) {
            $this->command->warn('No payment methods found. Please run PaymentMethodSeeder first.');
            return;
        }

        // This seeder populates payment records for invoices
        // Since invoice payments are already created in InvoicePaymentSeeder, we'll just update the info
        $this->command->info('Payment records are handled in InvoicePaymentSeeder');
    }
}
