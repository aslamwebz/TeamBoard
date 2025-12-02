<?php

declare(strict_types=1);

namespace Database\Factories;

use App\Models\Domain;
use App\Models\Tenant;
use Illuminate\Database\Eloquent\Factories\Factory;

final class DomainFactory extends Factory
{
    protected $model = Domain::class;

    public function definition(): array
    {
        return [
            'domain' => fake()->unique()->domainName(),
            'tenant_id' => Tenant::factory(),
        ];
    }
}
