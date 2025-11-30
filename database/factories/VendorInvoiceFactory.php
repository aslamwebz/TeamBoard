<?php

namespace Database\Factories;

use App\Models\VendorInvoice;
use App\Models\Vendor;
use Illuminate\Database\Eloquent\Factories\Factory;

class VendorInvoiceFactory extends Factory
{
    protected $model = VendorInvoice::class;

    public function definition(): array
    {
        $total = fake()->randomFloat(2, 100, 10000);
        $tax = $total * 0.08; // 8% tax

        return [
            'vendor_id' => Vendor::factory(),
            'invoice_number' => 'VIN-' . fake()->unique()->numerify('####'),
            'invoice_date' => fake()->dateTimeBetween('-1 year', 'now')->format('Y-m-d'),
            'due_date' => fake()->dateTimeBetween('now', '+60 days')->format('Y-m-d'),
            'amount' => $total - $tax,
            'tax_amount' => $tax,
            'total_amount' => $total,
            'status' => fake()->randomElement(['draft', 'sent', 'paid', 'overdue', 'cancelled']),
            'notes' => fake()->optional()->sentence(),
            'file_path' => fake()->optional()->filePath(),
            'paid_at' => fake()->optional()->dateTime(),
            'payment_method' => fake()->optional()->randomElement(['credit_card', 'bank_transfer', 'check']),
        ];
    }
}