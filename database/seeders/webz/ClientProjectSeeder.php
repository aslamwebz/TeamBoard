<?php

namespace Database\Seeders\webz;

use App\Models\Client;
use App\Models\Project;
use Illuminate\Database\Seeder;

class ClientProjectSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $clients = Client::all();
        $projects = Project::all();

        if ($clients->isEmpty() || $projects->isEmpty()) {
            $this->command->warn('Clients or Projects not found. Please run ClientSeeder and ProjectSeeder first.');
            return;
        }

        // Link projects to clients (some projects may already have clients)
        foreach ($projects as $project) {
            if (!$project->client_id) {
                $client = $clients->random();
                $project->update(['client_id' => $client->id]);
            }
        }
    }
}
