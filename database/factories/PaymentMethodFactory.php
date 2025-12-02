<?php

declare(strict_types=1);

namespace Database\Factories;

use App\Models\PaymentMethod;
use Illuminate\Database\Eloquent\Factories\Factory;

final class PaymentMethodFactory extends Factory
{
    protected $model = PaymentMethod::class;

    public function definition(): array
    {
        return [
            'name' => fake()->randomElement(['Credit Card', 'Debit Card', 'Bank Transfer', 'Check', 'PayPal', 'Stripe', 'Cash', 'Wire Transfer']),
            'type' => fake()->randomElement(['card', 'transfer', 'check', 'digital_wallet', 'digital_payment', 'cash']),
            'description' => fake()->sentence(),
            'is_active' => fake()->boolean(),
        ];
    }
}
