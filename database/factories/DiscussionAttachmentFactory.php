<?php

declare(strict_types=1);

namespace Database\Factories;

use App\Models\Discussion;
use App\Models\DiscussionAttachment;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

final class DiscussionAttachmentFactory extends Factory
{
    protected $model = DiscussionAttachment::class;

    public function definition(): array
    {
        return [
            'filename' => fake()->word().'.pdf',
            'original_name' => fake()->word().'.pdf',
            'mime_type' => 'application/pdf',
            'size' => fake()->numberBetween(1000, 5000000),
            'discussion_id' => Discussion::factory(),
            'comment_id' => fake()->optional()->numberBetween(1, 10),
            'user_id' => User::factory(),
        ];
    }
}
