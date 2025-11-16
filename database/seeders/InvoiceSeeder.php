<?php

namespace Database\Seeders;

use App\Models\Client;
use App\Models\Invoice;
use App\Models\Project;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class InvoiceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $clients = Client::all();
        $projects = Project::all();
        $user = User::first(); // Get a user to assign to projects if needed

        if ($clients->count() > 0) {
            Invoice::create([
                'client_id' => $clients->first()->id,
                'project_id' => $projects->isNotEmpty() ? $projects->first()->id : null,
                'invoice_number' => 'INV-2025-0001',
                'issue_date' => now()->subDays(10),
                'due_date' => now()->addDays(20),
                'amount' => 1500.00,
                'tax' => 150.00,
                'total' => 1650.00,
                'status' => 'sent',
                'description' => 'Website development services'
            ]);

            // Use a valid project or create one if needed
            $secondProjectId = null;
            if ($projects->count() > 1) {
                $secondProjectId = $projects->skip(1)->first()->id;
            } else {
                // Create a new project if we need one
                if ($user) {
                    $newProject = \App\Models\Project::create([
                        'name' => 'Mobile App Development',
                        'description' => 'Development of a mobile application',
                        'status' => 'in_progress',
                        'user_id' => $user->id,
                    ]);
                    $secondProjectId = $newProject->id;
                }
            }

            Invoice::create([
                'client_id' => $clients->skip(1)->first()->id,
                'project_id' => $secondProjectId,
                'invoice_number' => 'INV-2025-0002',
                'issue_date' => now()->subDays(5),
                'due_date' => now()->addDays(25),
                'amount' => 2500.00,
                'tax' => 250.00,
                'total' => 2750.00,
                'status' => 'paid',
                'description' => 'Mobile app development'
            ]);

            Invoice::create([
                'client_id' => $clients->last()->id,
                'project_id' => null,
                'invoice_number' => 'INV-2025-0003',
                'issue_date' => now()->subDays(15),
                'due_date' => now()->subDays(1),
                'amount' => 800.00,
                'tax' => 80.00,
                'total' => 880.00,
                'status' => 'overdue',
                'description' => 'Consulting services'
            ]);
        }
    }
}
