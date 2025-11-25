<?php

namespace Database\Seeders\webz;

use App\Models\Client;
use App\Models\Note;
use Illuminate\Database\Seeder;

class ClientNoteSeeder extends Seeder
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
            // Create 2-5 notes per client
            for ($i = 0; $i < rand(2, 5); $i++) {
                Note::factory()->create([
                    'noteable_type' => 'App\Models\Client',
                    'noteable_id' => $client->id,
                    'title' => fake()->sentence(3),
                    'content' => fake()->paragraph(3),
                    'type' => fake()->randomElement(['general', 'follow_up', 'meeting', 'reminder']),
                ]);
            }
        }
    }
}
