<?php

namespace Database\Seeders;

use App\Models\Client;
use App\Models\Project;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ProjectSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $project = Project::create([
            'name' => 'Project POS',
            'description' => 'POS Machine Project',
            'status' => 'planning',
            'start_date' => '2026-01-01',
            'end_date' => '2026-12-31',
        ]);

        $project->clients()->attach(Client::first());
    }
}
