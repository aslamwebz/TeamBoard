<?php

namespace Database\Seeders\webz;

use App\Models\Skill;
use App\Models\WorkerProfile;
use Illuminate\Database\Seeder;

class WorkerSkillSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $workers = WorkerProfile::all();
        $skills = Skill::all();

        if ($workers->isEmpty() || $skills->isEmpty()) {
            $this->command->warn('Workers or Skills not found. Please run WorkerProfileSeeder and SkillSeeder first.');
            return;
        }

        foreach ($workers as $worker) {
            // Assign 3-7 skills to each worker
            $selectedSkills = $skills->random(rand(3, 7));

            foreach ($selectedSkills as $skill) {
                $worker->skills()->attach($skill->id, [
                    'proficiency_level' => fake()->numberBetween(1, 5),
                    'notes' => fake()->optional()->sentence(),
                ]);
            }
        }
    }
}
