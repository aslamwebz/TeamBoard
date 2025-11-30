<?php

namespace Database\Factories;

use App\Models\Contact;
use App\Models\ContactActivity;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class ContactActivityFactory extends Factory
{
    protected $model = ContactActivity::class;

    public function definition(): array
    {
        return [
            'contact_id' => Contact::factory(),
            'type' => fake()->randomElement(['email', 'call', 'meeting', 'note', 'task']),
            'description' => fake()->sentence(),
            'details' => ['note' => fake()->paragraph()],
            'activity_date' => fake()->dateTimeBetween('-1 year', 'now'),
            'created_by' => User::factory(),
        ];
    }
}