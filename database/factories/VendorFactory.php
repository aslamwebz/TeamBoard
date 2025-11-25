<?php

namespace Database\Factories;

use App\Models\Vendor;
use Illuminate\Database\Eloquent\Factories\Factory;

class VendorFactory extends Factory
{
    protected $model = Vendor::class;

    public function definition(): array
    {
        return [
            'name' => fake()->company(),
            'email' => fake()->unique()->safeEmail(),
            'phone' => fake()->phoneNumber(),
            'address' => fake()->streetAddress(),
            'city' => fake()->city(),
            'state' => fake()->stateAbbr(),
            'zip_code' => fake()->postcode(),
            'country' => fake()->country(),
            'tax_id' => fake()->bothify('XX-#######'),
            'description' => fake()->optional()->paragraph(),
            'rating' => fake()->randomFloat(2, 1, 5),
            'website' => fake()->optional()->url(),
            'status' => fake()->randomElement(['active', 'inactive', 'pending']),
            'payment_terms' => fake()->randomElement(['NET30', 'NET60', 'NET90', 'COD', '2% Discount NET10']),
            'credit_limit' => fake()->randomFloat(2, 1000, 100000),
            'last_transaction_date' => fake()->optional()->date(),
        ];
    }
}