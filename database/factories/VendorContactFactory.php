<?php

namespace Database\Factories;

use App\Models\VendorContact;
use App\Models\Vendor;
use Illuminate\Database\Eloquent\Factories\Factory;

class VendorContactFactory extends Factory
{
    protected $model = VendorContact::class;

    public function definition(): array
    {
        return [
            'vendor_id' => Vendor::factory(), // Make sure VendorFactory exists
            'first_name' => fake()->firstName(),
            'last_name' => fake()->lastName(),
            'email' => fake()->unique()->safeEmail(),
            'phone' => fake()->phoneNumber(),
            'position' => fake()->jobTitle(),
            'is_primary' => fake()->boolean(20), // 20% chance of being primary
        ];
    }
}