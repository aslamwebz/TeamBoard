<?php

namespace Database\Seeders\webz;

use App\Models\Team;
use App\Models\User;
use Illuminate\Database\Seeder;

class UserTeamSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $users = User::all();
        $teams = Team::all();
        
        if ($users->isEmpty() || $teams->isEmpty()) {
            $this->command->warn('Users or Teams not found. Please run UserSeeder and TeamSeeder first.');
            return;
        }

        // Assign users to teams
        foreach ($users as $index => $user) {
            // Each user can be in multiple teams
            $teamIds = $teams->random(min(3, $teams->count()))->pluck('id')->toArray();
            $user->teams()->attach($teamIds);
        }
    }
}