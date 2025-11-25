<?php

namespace Database\Seeders\webz;

use App\Models\Invoice;
use Illuminate\Database\Seeder;

class InvoiceLineItemSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $invoices = Invoice::all();

        if ($invoices->isEmpty()) {
            $this->command->warn('No invoices found. Please run InvoiceSeeder first.');
            return;
        }

        $items = [
            ['Service Fee', 'Professional services rendered', 1, 2000.0],
            ['Development Hours', 'Software development services', 40, 150.0],
            ['Consulting Services', 'Consulting and advisory services', 20, 200.0],
            ['Support Hours', 'Technical support and maintenance', 10, 125.0],
            ['Hosting Fee', 'Monthly hosting fee', 1, 500.0],
            ['License Fee', 'Software licensing', 5, 200.0],
            ['Setup Fee', 'Initial setup and configuration', 1, 1000.0],
            ['Training Session', 'Training and education services', 8, 150.0],
        ];

        foreach ($invoices as $invoice) {
            // Add 1-4 line items per invoice
            $itemCount = rand(1, 4);

            for ($i = 0; $i < $itemCount; $i++) {
                $item = $items[array_rand($items)];
                $quantity = $item[2];
                $unitPrice = $item[3];
                $total = $quantity * $unitPrice;

                $invoice->lineItems()->create([
                    'description' => $item[0],
                    'detail' => $item[1],
                    'quantity' => $quantity,
                    'unit_price' => $unitPrice,
                    'total' => $total,
                ]);
            }
        }
    }
}
