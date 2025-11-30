<?php

namespace Database\Factories;

use App\Models\InvoiceLineItem;
use App\Models\Invoice;
use Illuminate\Database\Eloquent\Factories\Factory;

class InvoiceLineItemFactory extends Factory
{
    protected $model = InvoiceLineItem::class;

    public function definition(): array
    {
        $quantity = fake()->numberBetween(1, 10);
        $unitPrice = fake()->randomFloat(2, 10, 1000);
        $total = $quantity * $unitPrice;

        return [
            'invoice_id' => Invoice::factory(),
            'description' => fake()->sentence(),
            'detail' => fake()->optional()->paragraph(),
            'quantity' => $quantity,
            'unit_price' => $unitPrice,
            'total' => $total,
        ];
    }
}