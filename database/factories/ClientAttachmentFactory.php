<?php

namespace Database\Factories;

use App\Models\Client;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\ClientAttachment>
 */
class ClientAttachmentFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
        'client_id' => Client::factory()->create()->id,
        'name' => fake()->word(),
        'path' => fake()->word() . '.pdf',
        'mime_type' => fake()->mimeType(),
        'size' => fake()->numberBetween(1, 1024),
        'type' => fake()->randomElement(['contract', 'nda', 'onboarding']),
        'description' => fake()->sentence(),
        'uploaded_by' => 1,
        'uploaded_at' => now(),
        ];
    }
}
