<?php

namespace Database\Factories;

use App\Models\Certification;
use Illuminate\Database\Eloquent\Factories\Factory;

class CertificationFactory extends Factory
{
    protected $model = Certification::class;

    public function definition(): array
    {
        $issueDate = fake()->dateTimeBetween('-5 years', 'now');
        $expires = fake()->boolean(70); // 70% of certifications have expiry dates
        
        return [
            'name' => fake()->catchPhrase(),
            'issuing_organization' => fake()->company(),
            'license_number' => strtoupper(fake()->bothify('?????-#####')),
            'issue_date' => $issueDate,
            'expiry_date' => $expires ? fake()->dateTimeBetween($issueDate, '+5 years') : null,
            'credential_id' => fake()->uuid(),
            'credential_url' => fake()->optional()->url(),
            'description' => fake()->optional()->sentence(),
        ];
    }
}