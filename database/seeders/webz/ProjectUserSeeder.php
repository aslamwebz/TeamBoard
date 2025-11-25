<?php

namespace Database\Seeders\webz;

use App\Models\Project;
use App\Models\User;
use Illuminate\Database\Seeder;

class ProjectUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $projects = Project::all();
        $users = User::all();
        
        if ($projects->isEmpty() || $users->isEmpty()) {
            $this->command->warn('Projects or Users not found. Please run ProjectSeeder and UserSeeder first.');
            return;
        }

        foreach ($projects as $project) {
            // Assign 2-5 users per project
            $userIds = $users->random(min(5, $users->count()))->pluck('id')->toArray();
            $project->users()->attach($userIds);
        }
    }
}