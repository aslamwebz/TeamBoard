<?php

namespace Database\Factories;

use App\Models\Notification;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class NotificationFactory extends Factory
{
    protected $model = Notification::class;

    public function definition(): array
    {
        return [
            'user_id' => User::factory(),
            'type' => fake()->word(),
            'message' => fake()->sentence(),
            'data' => ['key' => 'value'],
            'read_at' => fake()->optional()->dateTime(),
            'email_sent_at' => fake()->optional()->dateTime(),
            'push_sent_at' => fake()->optional()->dateTime(),
        ];
    }
}