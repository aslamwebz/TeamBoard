<?php

namespace Database\Factories;

use App\Models\PurchaseOrderItem;
use App\Models\PurchaseOrder;
use Illuminate\Database\Eloquent\Factories\Factory;

class PurchaseOrderItemFactory extends Factory
{
    protected $model = PurchaseOrderItem::class;

    public function definition(): array
    {
        $quantity = fake()->numberBetween(1, 10);
        $unitPrice = fake()->randomFloat(2, 10, 500);
        $totalPrice = $quantity * $unitPrice;

        return [
            'purchase_order_id' => PurchaseOrder::factory(),
            'name' => fake()->words(3, true),
            'description' => fake()->optional()->sentence(),
            'unit_price' => $unitPrice,
            'quantity' => $quantity,
            'total_price' => $totalPrice,
            'unit_of_measure' => fake()->randomElement(['ea', 'ft', 'lb', 'kg', 'hr', 'item', 'set', 'box']),
            'received_quantity' => fake()->numberBetween(0, $quantity), // May not be fully received yet
            'service_code' => 'CODE-' . strtoupper(fake()->lexify('????')),
        ];
    }
}