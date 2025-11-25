<?php

namespace Database\Seeders\webz;

use App\Models\Team;
use Illuminate\Database\Seeder;

class TeamSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $teams = [
            [
                'name' => 'Engineering Team',
                'description' => 'Software development and technical operations',
            ],
            [
                'name' => 'Marketing Team',
                'description' => 'Marketing and promotional activities',
            ],
            [
                'name' => 'Sales Team',
                'description' => 'Sales and customer acquisition',
            ],
            [
                'name' => 'Customer Support',
                'description' => 'Customer service and support',
            ],
            [
                'name' => 'HR Team',
                'description' => 'Human resources and personnel management',
            ],
            [
                'name' => 'Finance Team',
                'description' => 'Financial management and accounting',
            ],
            [
                'name' => 'Operations Team',
                'description' => 'Day-to-day operational activities',
            ],
            [
                'name' => 'Product Team',
                'description' => 'Product development and management',
            ],
            [
                'name' => 'Quality Assurance',
                'description' => 'Quality testing and assurance',
            ],
            [
                'name' => 'Administrative Team',
                'description' => 'General administration and coordination',
            ],
        ];

        foreach ($teams as $team) {
            Team::factory()->create($team);
        }
    }
}