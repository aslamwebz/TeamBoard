<?php declare(strict_types=1);

namespace App\Livewire\Reports;

use App\Enums\ReportStatus;
use App\Models\Report;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Component;

#[Layout('components.layouts.app')]
#[Title('Create Report')]
final class ReportCreate extends Component
{
    public $title = '';

    public $description = '';

    public $report_type = 'financial';

    public function mount(): void
    {
        $this->authorize('create', Report::class);
    }

    public function createReport(): RedirectResponse
    {
        $this->authorize('create', Report::class);

        $validated = $this->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'report_type' => 'required|string|in:financial,project,invoice,client',
        ]);

        $validated['user_id'] = auth()->id();
        $validated['status'] = ReportStatus::GENERATED->value;
        $validated['generated_at'] = now();

        // Add sample data based on report type
        switch ($this->report_type) {
            case 'financial':
                $validated['data'] = [
                    'period' => 'monthly',
                    'from_date' => now()->startOfMonth()->toDateString(),
                    'to_date' => now()->endOfMonth()->toDateString(),
                    'total_revenue' => 0,
                    'total_expenses' => 0,
                    'net_income' => 0,
                ];
                break;
            case 'project':
                $validated['data'] = [
                    'status' => 'active',
                    'projects_count' => 0,
                    'completed_projects' => 0,
                    'in_progress_projects' => 0,
                ];
                break;
            case 'invoice':
                $validated['data'] = [
                    'status' => 'paid',
                    'invoices_count' => 0,
                    'total_amount' => 0,
                    'overdue_invoices' => 0,
                ];
                break;
            case 'client':
                $validated['data'] = [
                    'clients_count' => 0,
                    'active_clients' => 0,
                    'new_clients' => 0,
                ];
                break;
        }

        Report::create($validated);

        return redirect()->route('reports.index');
    }

    public function render(): View
    {
        return view('livewire.reports.report-create');
    }
}
