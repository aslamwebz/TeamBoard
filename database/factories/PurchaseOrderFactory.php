<?php

namespace Database\Factories;

use App\Models\PurchaseOrder;
use App\Models\Vendor;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class PurchaseOrderFactory extends Factory
{
    protected $model = PurchaseOrder::class;

    public function definition(): array
    {
        $orderDate = fake()->dateTimeBetween('-1 year', 'now');
        $expectedDeliveryDate = (clone $orderDate)->modify('+' . fake()->numberBetween(7, 30) . ' days');
        $subtotal = fake()->randomFloat(2, 100, 10000);
        $tax = $subtotal * 0.08; // 8% tax
        $total = $subtotal + $tax;

        return [
            'vendor_id' => Vendor::inRandomOrder()->first()?->id ?? Vendor::factory(),
            'po_number' => 'PO-' . fake()->unique()->numberBetween(1000, 9999),
            'order_date' => $orderDate,
            'required_date' => fake()->dateTimeBetween($orderDate, '+2 months'),
            'expected_delivery_date' => $expectedDeliveryDate,
            'subtotal' => $subtotal,
            'tax_amount' => $tax,
            'total_amount' => $total,
            'status' => fake()->randomElement(['draft', 'pending', 'approved', 'sent', 'partially_received', 'received', 'closed', 'cancelled']),
            'notes' => fake()->optional()->paragraph(),
            'delivery_address' => fake()->address(),
            'shipping_method' => fake()->optional()->randomElement(['standard', 'express', 'overnight']),
            'payment_terms' => fake()->optional()->randomElement(['NET30', 'NET60', 'COD', '2% Discount NET10']),
            'created_by' => User::inRandomOrder()->first()?->id ?? User::factory(),
            'approved_by' => 1,
            'approved_at' => fake()->optional()->dateTimeBetween($orderDate, 'now'),
            'sent_at' => fake()->optional()->dateTimeBetween($orderDate, 'now'),
            'received_at' => fake()->optional()->dateTimeBetween($orderDate, 'now'),
        ];
    }

    public function approved(): static
    {
        return $this->state(fn (array $attributes) => [
            'status' => 'approved',
            'approved_by' => 1,
            'approved_at' => fake()->dateTimeBetween($attributes['order_date'], 'now'),
        ]);
    }

    public function sent(): static
    {
        return $this->state(fn (array $attributes) => [
            'status' => 'sent',
            'sent_at' => fake()->dateTimeBetween($attributes['approved_at'] ?? $attributes['order_date'], 'now'),
        ]);
    }

    public function received(): static
    {
        return $this->state(fn (array $attributes) => [
            'status' => 'received',
            'received_at' => fake()->dateTimeBetween($attributes['sent_at'] ?? $attributes['order_date'], 'now'),
        ]);
    }
}