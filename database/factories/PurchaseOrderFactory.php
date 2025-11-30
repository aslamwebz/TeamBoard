<?php

namespace Database\Factories;

use App\Models\PurchaseOrder;
use App\Models\User;
use App\Models\Vendor;
use Illuminate\Database\Eloquent\Factories\Factory;

class PurchaseOrderFactory extends Factory
{
    protected $model = PurchaseOrder::class;

    public function definition(): array
    {
        $subtotal = fake()->randomFloat(2, 500, 10000);
        $tax = $subtotal * 0.08;
        $total = $subtotal + $tax;
        $orderDate = now()->subMonths(3);

        return [
            'vendor_id' => Vendor::factory(),
            'po_number' => 'PO-' . now()->format('Ymd') . '-' . str_pad(fake()->unique()->numberBetween(1, 9999), 4, '0', STR_PAD_LEFT),
            'order_date' => $orderDate,
            'required_date' => $this->faker->dateTimeBetween($orderDate, '+2 months'),
            'expected_delivery_date' => $this->faker->dateTimeBetween('+3 months', '+6 months'),
            'subtotal' => $subtotal,
            'tax_amount' => $tax,
            'total_amount' => $total,
            'status' => fake()->randomElement(['draft', 'pending', 'approved', 'sent', 'partially_received', 'received', 'closed', 'cancelled']),
            'notes' => fake()->optional()->paragraph(),
            'delivery_address' => fake()->optional()->address(),
            'shipping_method' => fake()->optional()->randomElement(['standard', 'express', 'overnight']),
            'payment_terms' => fake()->optional()->randomElement(['NET30', 'NET60', 'COD', '2% Discount NET10']),
            'created_by' => User::factory(),
            'approved_by' => 1,
            'approved_at' => fake()->optional()->dateTimeBetween($orderDate, 'now'),
            'sent_at' => fake()->optional()->dateTimeBetween($orderDate, 'now'),
            'received_at' => fake()->optional()->dateTimeBetween($orderDate, 'now'),
        ];
    }
}
