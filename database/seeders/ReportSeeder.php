<?php

namespace Database\Seeders;

use App\Models\Report;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ReportSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $user = User::first(); // Get the first user to associate with reports

        if ($user) {
            Report::create([
                'user_id' => $user->id,
                'title' => 'Monthly Financial Report',
                'description' => 'Financial summary for October 2025',
                'report_type' => 'financial',
                'data' => [
                    'period' => 'monthly',
                    'from_date' => '2025-10-01',
                    'to_date' => '2025-10-31',
                    'total_revenue' => 12500.00,
                    'total_expenses' => 8500.00,
                    'net_income' => 4000.00
                ],
                'generated_at' => now()->subDays(2),
                'status' => 'generated'
            ]);

            Report::create([
                'user_id' => $user->id,
                'title' => 'Project Status Report',
                'description' => 'Overview of active projects',
                'report_type' => 'project',
                'data' => [
                    'status' => 'active',
                    'projects_count' => 12,
                    'completed_projects' => 5,
                    'in_progress_projects' => 6,
                    'on_hold_projects' => 1
                ],
                'generated_at' => now()->subDays(1),
                'status' => 'generated'
            ]);

            Report::create([
                'user_id' => $user->id,
                'title' => 'Client Activity Report',
                'description' => 'Client engagement statistics',
                'report_type' => 'client',
                'data' => [
                    'clients_count' => 45,
                    'active_clients' => 32,
                    'new_clients' => 8,
                    'satisfaction_score' => 4.2
                ],
                'generated_at' => now(),
                'status' => 'generated'
            ]);
        }
    }
}
