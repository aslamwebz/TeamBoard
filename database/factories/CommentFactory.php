<?php

declare(strict_types=1);

namespace Database\Factories;

use App\Models\Comment;
use App\Models\Discussion;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Comment>
 */
final class CommentFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'content' => fake()->sentence(),
            'discussion_id' => Discussion::factory(),
            'user_id' => User::factory(),
            'parent_id' => null,
        ];
    }

    /**
     * Indicate that the comment is a reply to another comment.
     */
    public function reply(): static
    {
        return $this->state(fn(array $attributes): array => [
            'parent_id' => Comment::factory(),
        ]);
    }

    /**
     * Indicate that the comment belongs to a specific discussion.
     */
    public function forDiscussion(Discussion $discussion): static
    {
        return $this->state(fn(array $attributes): array => [
            'discussion_id' => $discussion->id,
        ]);
    }

    /**
     * Indicate that the comment belongs to a specific user.
     */
    public function forUser(User $user): static
    {
        return $this->state(fn(array $attributes): array => [
            'user_id' => $user->id,
        ]);
    }
}
