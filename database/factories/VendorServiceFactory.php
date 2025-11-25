<?php

namespace Database\Factories;

use App\Models\VendorService;
use App\Models\Vendor;
use Illuminate\Database\Eloquent\Factories\Factory;

class VendorServiceFactory extends Factory
{
    protected $model = VendorService::class;

    public function definition(): array
    {
        return [
            'vendor_id' => Vendor::factory(),
            'name' => fake()->catchPhrase(),
            'category' => fake()->randomElement(['services', 'products', 'consulting', 'support', 'development', 'maintenance']),
            'description' => fake()->paragraph(),
            'unit_price' => fake()->randomFloat(2, 10, 500),
            'unit_of_measure' => fake()->randomElement(['hour', 'day', 'week', 'month', 'item', 'project']),
            'is_active' => fake()->boolean(90), // 90% chance of being active
        ];
    }
}