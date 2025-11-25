<?php

namespace Database\Seeders\webz;

use App\Models\Project;
use App\Models\Task;
use Illuminate\Database\Seeder;

class TaskSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $projects = Project::all();
        
        if ($projects->isEmpty()) {
            $this->command->warn('No projects found. Please run ProjectSeeder first.');
            return;
        }

        $tasks = [
            ['title' => 'Research competitor websites', 'description' => 'Analyze competitor websites to identify best practices'],
            ['title' => 'Design wireframes', 'description' => 'Create low-fidelity wireframes for the new website'],
            ['title' => 'Develop backend API', 'description' => 'Build the REST API endpoints for the mobile application'],
            ['title' => 'Set up cloud infrastructure', 'description' => 'Configure cloud resources and services for migration'],
            ['title' => 'Create database schema', 'description' => 'Design and implement the database schema for inventory system'],
            ['title' => 'Implement authentication system', 'description' => 'Build secure user authentication and authorization system'],
            ['title' => 'Prepare user training materials', 'description' => 'Create documentation and training content for new system'],
            ['title' => 'Conduct security audit', 'description' => 'Perform security assessment of current systems'],
            ['title' => 'Optimize database queries', 'description' => 'Optimize slow-performing database queries'],
            ['title' => 'Deploy staging environment', 'description' => 'Set up and configure staging environment for testing'],
        ];

        foreach ($projects as $project) {
            // Assign 5-8 tasks per project randomly
            $selectedTasks = collect($tasks)->random(random_int(5, 8));
            
            foreach ($selectedTasks as $task) {
                Task::factory()->create([
                    'title' => $task['title'],
                    'description' => $task['description'],
                    'project_id' => $project->id,
                    'status' => ['todo', 'in_progress', 'completed', 'on_hold'][array_rand(['todo', 'in_progress', 'completed', 'on_hold'])],
                    'due_date' => now()->addDays(rand(1, 30)),
                ]);
            }
        }
    }
}