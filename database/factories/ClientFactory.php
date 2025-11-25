<?php

namespace Database\Factories;

use App\Models\Client;
use Illuminate\Database\Eloquent\Factories\Factory;

class ClientFactory extends Factory
{
    protected $model = Client::class;

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
            'tax_vat_number' => fake()->bothify('TX######'),
            'industry' => fake()->randomElement(['Technology', 'Finance', 'Healthcare', 'Retail', 'Manufacturing', 'Education']),
            'description' => fake()->optional()->paragraph(),
        ];
    }
}