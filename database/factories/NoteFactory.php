<?php

namespace Database\Factories;

use App\Models\Note;
use App\Models\Client;
use App\Models\Project;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class NoteFactory extends Factory
{
    protected $model = Note::class;

    public function definition(): array
    {
        $noteableType = fake()->randomElement(['App\Models\Client', 'App\Models\Project']);
        $noteableId = $noteableType === 'App\Models\Client' ? Client::factory() : Project::factory();

        return [
            'noteable_type' => $noteableType,
            'noteable_id' => $noteableId,
            'title' => fake()->sentence(),
            'content' => fake()->paragraphs(3, true),
            'type' => fake()->randomElement(['general', 'follow_up', 'meeting', 'reminder', 'important']),
            'is_public' => fake()->boolean(70), // 70% public
            'created_by' => User::factory(),
        ];
    }
}