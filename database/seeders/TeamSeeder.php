<?php

namespace Database\Seeders;

use App\Models\Team;
use App\Models\User;
use Illuminate\Database\Seeder;

class TeamSeeder extends Seeder
{
    public function run(): void
    {
        $team = Team::create([
            'name' => 'Development Team',
            'description' => 'Main development team for all projects',
        ]);

        // Attach first user to the team
        $team->users()->attach(User::first());
    }
}
