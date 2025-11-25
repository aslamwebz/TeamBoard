<?php

namespace Database\Seeders\webz;

use App\Models\Project;
use App\Models\Team;
use Illuminate\Database\Seeder;

class ProjectTeamSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $projects = Project::all();
        $teams = Team::all();
        
        if ($projects->isEmpty() || $teams->isEmpty()) {
            $this->command->warn('Projects or Teams not found. Please run ProjectSeeder and TeamSeeder first.');
            return;
        }

        foreach ($projects as $project) {
            // Assign 1-3 teams per project
            $teamIds = $teams->random(min(3, $teams->count()))->pluck('id')->toArray();
            $project->teams()->attach($teamIds);
        }
    }
}