<?php

namespace Database\Seeders\webz;

use Illuminate\Database\Seeder;

class ReportSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $reports = [
            ['name' => 'Sales Report', 'type' => 'sales', 'description' => 'Monthly sales performance report'],
            ['name' => 'Project Status Report', 'type' => 'project', 'description' => 'Project status and progress report'],
            ['name' => 'Financial Overview', 'type' => 'financial', 'description' => 'Comprehensive financial summary'],
            ['name' => 'Client Activity Report', 'type' => 'client', 'description' => 'Client engagement and activity report'],
            ['name' => 'Expense Analysis', 'type' => 'expense', 'description' => 'Detailed expense category analysis'],
            ['name' => 'Invoice Summary', 'type' => 'invoice', 'description' => 'Summary of invoices and payments'],
            ['name' => 'Team Performance', 'type' => 'team', 'description' => 'Team productivity and performance report'],
            ['name' => 'Vendor Report', 'type' => 'vendor', 'description' => 'Vendor performance and payment report'],
            ['name' => 'Task Completion', 'type' => 'task', 'description' => 'Task completion and efficiency report'],
            ['name' => 'Revenue Forecast', 'type' => 'revenue', 'description' => 'Revenue forecast and projection report'],
        ];

        foreach ($reports as $report) {
            // Get a valid user_id - try to get first user, create a dummy user if none exist
            $userId = \App\Models\User::first()?->id ?? \App\Models\User::create([
                'name' => 'Default User',
                'email' => 'default@webz.com',
                'password' => bcrypt('password'),
                'email_verified_at' => now(),
            ])->id;

            \App\Models\Report::updateOrCreate(
                ['title' => $report['name']], // Use 'title' field instead of 'name'
                [
                    'title' => $report['name'],
                    'report_type' => $report['type'],
                    'description' => $report['description'],
                    'user_id' => $userId, // Assign to an existing user
                ]
            );
        }
    }
}
