<?php

namespace Database\Factories;

use App\Models\FileAttachment;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class FileAttachmentFactory extends Factory
{
    protected $model = FileAttachment::class;

    public function definition(): array
    {
        return [
            'filename' => fake()->word() . '.pdf',
            'original_name' => fake()->word() . '.pdf',
            'mime_type' => 'application/pdf',
            'size' => fake()->numberBetween(1000, 5000000),
            'attachable_type' => fake()->randomElement(['App\Models\Project', 'App\Models\Task', 'App\Models\Invoice']),
            'attachable_id' => fake()->numberBetween(1, 100),
            'user_id' => User::factory(),
        ];
    }
}