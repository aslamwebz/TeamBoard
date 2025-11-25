<?php

namespace Database\Seeders\webz;

use App\Models\Report;
use Illuminate\Database\Seeder;

class MonthlyReportSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $reports = Report::all();

        if ($reports->isEmpty()) {
            $this->command->warn('No reports found. Please run ReportSeeder first.');
            return;
        }

        foreach ($reports as $report) {
            // Create 6 monthly reports for each report type
            for ($i = 0; $i < 6; $i++) {
                $month = now()->subMonths($i);

                \App\Models\MonthlyReport::create([
                    'report_id' => $report->id,
                    'period_start' => $month->startOfMonth(),
                    'period_end' => $month->endOfMonth(),
                    'data' => json_encode([
                        'summary' => fake()->paragraph(2),
                        'metrics' => [
                            'total' => fake()->randomFloat(2, 1000, 50000),
                            'change_percent' => fake()->randomFloat(2, -20, 30),
                        ],
                        'insights' => [fake()->sentence(), fake()->sentence(), fake()->sentence()],
                    ]),
                    'generated_at' => fake()->dateTimeBetween($month->startOfMonth(), $month->endOfMonth()),
                    'generated_by' => 1,  // Assuming user ID 1
                ]);
            }
        }
    }
}
