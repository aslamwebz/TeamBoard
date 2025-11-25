<?php

namespace Database\Seeders\webz;

use App\Models\Project;
use App\Models\Client;
use Illuminate\Database\Seeder;

class ProjectSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $clients = Client::all();
        
        if ($clients->isEmpty()) {
            $this->command->warn('No clients found. Please run ClientSeeder first.');
            return;
        }

        $projects = [
            [
                'name' => 'Website Redesign Project',
                'description' => 'Complete redesign of the corporate website with modern UI/UX',
                'status' => 'in_progress',
                'due_date' => now()->addMonths(3),
            ],
            [
                'name' => 'Mobile App Development',
                'description' => 'Development of a cross-platform mobile application for iOS and Android',
                'status' => 'in_progress',
                'due_date' => now()->addMonths(6),
            ],
            [
                'name' => 'Cloud Migration Initiative',
                'description' => 'Migrating all on-premise services to cloud infrastructure',
                'status' => 'planning',
                'due_date' => now()->addMonths(8),
            ],
            [
                'name' => 'Inventory Management System',
                'description' => 'Building a comprehensive inventory management solution',
                'status' => 'in_progress',
                'due_date' => now()->addMonths(4),
            ],
            [
                'name' => 'Data Analytics Platform',
                'description' => 'Creating a data analytics platform for business intelligence',
                'status' => 'completed',
                'due_date' => now()->subMonths(2),
            ],
            [
                'name' => 'Cybersecurity Enhancement',
                'description' => 'Upgrading cybersecurity measures and protocols',
                'status' => 'in_progress',
                'due_date' => now()->addMonths(5),
            ],
            [
                'name' => 'Customer Portal Development',
                'description' => 'Building a customer portal for self-service options',
                'status' => 'planning',
                'due_date' => now()->addMonths(2),
            ],
            [
                'name' => 'HR Management System',
                'description' => 'Implementing a new human resources management system',
                'status' => 'on_hold',
                'due_date' => now()->addMonths(7),
            ],
            [
                'name' => 'E-commerce Platform Upgrade',
                'description' => 'Upgrading the e-commerce platform for better performance',
                'status' => 'in_progress',
                'due_date' => now()->addMonths(3),
            ],
            [
                'name' => 'AI-Powered Chatbot',
                'description' => 'Developing an AI-powered customer service chatbot',
                'status' => 'completed',
                'due_date' => now()->subMonth(),
            ],
        ];

        foreach ($projects as $index => $project) {
            $client = $clients->random();
            Project::factory()->create(array_merge($project, ['client_id' => $client->id]));
        }
    }
}