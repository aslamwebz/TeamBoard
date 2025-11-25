<?php

namespace Database\Seeders\webz;

use App\Models\Invoice;
use App\Models\Project;
use Illuminate\Database\Seeder;

class InvoiceProjectSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $invoices = Invoice::all();
        $projects = Project::all();

        if ($invoices->isEmpty() || $projects->isEmpty()) {
            $this->command->warn('Invoices or Projects not found. Please run InvoiceSeeder and ProjectSeeder first.');
            return;
        }

        foreach ($invoices as $invoice) {
            if ($invoice->project_id) {
                // Invoice already linked to a project
                continue;
            }

            // Link 60% of invoices to projects
            if (fake()->boolean(60)) {
                $project = $projects->random();
                $invoice->update(['project_id' => $project->id]);
            }
        }
    }
}
