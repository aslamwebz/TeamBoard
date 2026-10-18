<?php

declare(strict_types=1);

namespace Database\Factories;

use App\Models\Client;
use App\Models\Note;
use App\Models\Project;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

final class NoteFactory extends Factory
{
    protected $model = Note::class;

    public function definition(): array
    {
        $noteableType = fake()->randomElement([Client::class, Project::class]);
        $noteableId = $noteableType === Client::class ? Client::factory() : Project::factory();

        return [
            'noteable_type' => $noteableType,
            'noteable_id' => $noteableId,
            'title' => fake()->sentence(),
            'content' => fake()->paragraphs(3, true),
            'type' => fake()->randomElement(['general', 'follow_up', 'meeting', 'reminder', 'important']),
            'is_public' => fake()->boolean(70), // 70% public
            'created_by' => User::all()->random()->id,
        ];
    }
}
