<?php

namespace Database\Factories;

use App\Models\Client;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class ClientFactory extends Factory
{
    protected $model = Client::class;

    public function definition(): array
    {
        // Generate a unique company name
        $companyName = fake()->company() . ' ' . Str::random(5);
        
        return [
            'company_name' => $companyName,
            'name' => fake()->name(),  // Changed from company() to name() for the contact person
            'email' => fake()->unique()->safeEmail($companyName),
            'phone' => fake()->phoneNumber(),
            'address' => fake()->streetAddress(),
            'city' => fake()->city(),
            'state' => fake()->stateAbbr(),
            'zip_code' => fake()->postcode(),
            'country' => fake()->country(),
            'tax_vat_number' => 'TX' . fake()->unique()->numerify('#######'),
            'industry' => fake()->randomElement(['Technology', 'Finance', 'Healthcare', 'Retail', 'Manufacturing', 'Education']),
            'description' => fake()->optional()->paragraph(),
            'billing_plan' => fake()->randomElement(['Basic', 'Standard', 'Premium']),
            'subscription_start_date' => fake()->dateTimeBetween('-1 year', '+1 year'),
            'subscription_end_date' => fake()->dateTimeBetween('+1 month', '+2 years'),
            'subscription_status' => fake()->randomElement(['Active', 'Inactive', 'Expired']),
            'notes' => fake()->optional()->paragraph(),
            'billing_address' => fake()->address(),
            'shipping_address' => fake()->optional()->address(),
            'primary_contact_id' => null, 
            'custom_fields' => ['key' => 'value', 'key2' => 'value2'],
        ];
    }
}