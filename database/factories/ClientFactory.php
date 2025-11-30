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
            'company_name' => fake()->company(),
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
            'billing_plan' => fake()->randomElement(['Basic', 'Standard', 'Premium']),
            'subscription_start_date' => fake()->dateTimeBetween('-1 year', '+1 year'),
            'subscription_end_date' => fake()->dateTimeBetween('-1 year', '+1 year'),
            'subscription_status' => fake()->randomElement(['Active', 'Inactive', 'Expired']),
            'notes' => fake()->optional()->paragraph(),
            'billing_address' => fake()->optional()->streetAddress(),
            'shipping_address' => fake()->optional()->streetAddress(),
            'primary_contact_id' => fake()->optional()->numberBetween(1, 10),
            'custom_fields' => ['key' => 'value', 'key2' => 'value2'],
            'tax_vat_number' => fake()->bothify('TX######'),
        ];
    }
}