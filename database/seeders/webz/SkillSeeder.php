<?php

namespace Database\Seeders\webz;

use App\Models\Skill;
use Illuminate\Database\Seeder;

class SkillSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $skills = [
            ['name' => 'Project Management', 'category' => 'management', 'description' => 'Ability to plan, execute, and finalize projects'],
            ['name' => 'Leadership', 'category' => 'soft', 'description' => 'Capacity to lead teams and individuals'],
            ['name' => 'Communication', 'category' => 'soft', 'description' => 'Effective verbal and written communication'],
            ['name' => 'Problem Solving', 'category' => 'soft', 'description' => 'Ability to identify and solve problems'],
            ['name' => 'Time Management', 'category' => 'soft', 'description' => 'Efficient time and task management'],
            ['name' => 'JavaScript', 'category' => 'technical', 'description' => 'Programming language for web development'],
            ['name' => 'Python', 'category' => 'technical', 'description' => 'High-level programming language'],
            ['name' => 'Data Analysis', 'category' => 'technical', 'description' => 'Interpretation and analysis of data'],
            ['name' => 'UI/UX Design', 'category' => 'creative', 'description' => 'User interface and experience design'],
            ['name' => 'Financial Planning', 'category' => 'finance', 'description' => 'Strategic financial planning and management'],
            ['name' => 'Marketing Strategy', 'category' => 'marketing', 'description' => 'Development and implementation of marketing strategies'],
            ['name' => 'Customer Service', 'category' => 'service', 'description' => 'Assisting customers and solving their issues'],
            ['name' => 'Sales', 'category' => 'sales', 'description' => 'Techniques and skills for selling products/services'],
            ['name' => 'Negotiation', 'category' => 'soft', 'description' => 'Ability to negotiate and reach agreements'],
            ['name' => 'Teamwork', 'category' => 'soft', 'description' => 'Collaborating effectively with others'],
        ];

        foreach ($skills as $skill) {
            Skill::factory()->create($skill);
        }
    }
}
