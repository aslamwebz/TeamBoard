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
        // Create a user if none exists
        $user = User::inRandomOrder()->first() ?? User::factory()->create();
        
        // Create a contact if none exists
        $contact = Contact::inRandomOrder()->first() ?? Contact::factory()->create();

        return [
            'contact_id' => $contact->id,
            'type' => fake()->randomElement(['email', 'call', 'meeting', 'note', 'task']),
            'description' => fake()->sentence(),
            'details' => ['note' => fake()->paragraph()],
            'activity_date' => fake()->dateTimeBetween('-1 year', 'now'),
            'created_by' => $user->id,
        ];
    }
}