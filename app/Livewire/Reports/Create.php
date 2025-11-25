<?php

namespace App\Livewire\Reports;

use App\Models\Report;
use Livewire\Component;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;

#[Layout('components.layouts.app')]
#[Title('Create Report')]
class Create extends Component
{
    public $title = '';
    public $description = '';
    public $report_type = 'financial';
    public $data = [];

    protected $rules = [
        'title' => 'required|string|max:255',
        'description' => 'nullable|string|max:500',
        'report_type' => 'required|in:financial,project,invoice,client',
    ];

    public function createReport()
    {
        $validated = $this->validate();
        
        $validated['user_id'] = auth()->id();
        $validated['status'] = Report::STATUS_GENERATED;
        $validated['generated_at'] = now();

        // Add sample data based on report type
        switch($this->report_type) {
            case 'financial':
                $validated['data'] = [
                    'period' => 'monthly',
                    'from_date' => now()->startOfMonth()->toDateString(),
                    'to_date' => now()->endOfMonth()->toDateString(),
                    'total_revenue' => 0,
                    'total_expenses' => 0,
                    'net_income' => 0
                ];
                break;
            case 'project':
                $validated['data'] = [
                    'status' => 'active',
                    'projects_count' => 0,
                    'completed_projects' => 0,
                    'in_progress_projects' => 0
                ];
                break;
            case 'invoice':
                $validated['data'] = [
                    'status' => 'paid',
                    'invoices_count' => 0,
                    'total_amount' => 0,
                    'overdue_invoices' => 0
                ];
                break;
            case 'client':
                $validated['data'] = [
                    'clients_count' => 0,
                    'active_clients' => 0,
                    'new_clients' => 0
                ];
                break;
        }

        Report::create($validated);

        return $this->redirectRoute('reports.index', navigate: true);
    }

    public function render()
    {
        return view('livewire.reports.create');
    }
}