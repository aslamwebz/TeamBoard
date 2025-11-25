<?php

namespace Database\Seeders\webz;

use App\Models\Client;
use App\Models\Contact;
use Illuminate\Database\Seeder;

class ClientContactSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $clients = Client::all();
        
        if ($clients->isEmpty()) {
            $this->command->warn('No clients found. Please run ClientSeeder first.');
            return;
        }

        foreach ($clients as $client) {
            // Create 2-4 contacts per client
            $contactCount = rand(2, 4);
            
            for ($i = 0; $i < $contactCount; $i++) {
                Contact::factory()->create([
                    'client_id' => $client->id,
                    'first_name' => fake()->firstName(),
                    'last_name' => fake()->lastName(),
                    'email' => fake()->unique()->safeEmail(),
                    'phone' => fake()->phoneNumber(),
                    'position' => fake()->jobTitle(),
                    'is_primary' => $i === 0, // First contact is primary
                ]);
            }
        }
    }
}