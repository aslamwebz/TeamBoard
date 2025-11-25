<?php

namespace App\Livewire\Reports;

use App\Models\Report;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Component;

#[Layout('components.layouts.app')]
#[Title('Edit Report')]
class ReportEdit extends Component
{
    public $reportId;
    public $report;
    public $title = '';
    public $description = '';
    public $report_type = 'financial';
    public $status = 'draft';
    public $data = [];

    protected $rules = [
        'title' => 'required|string|max:255',
        'description' => 'nullable|string|max:500',
        'report_type' => 'required|in:financial,project,invoice,client',
        'status' => 'required|in:draft,generated,archived',
    ];

    public function mount(Report $report)
    {
        $this->report = $report;
        $this->reportId = $report->id;
        $this->title = $report->title;
        $this->description = $report->description;
        $this->report_type = $report->report_type;
        $this->status = $report->status;
        $this->data = $report->data ?? [];
    }

    public function updateReport()
    {
        $validated = $this->validate();

        $report = Report::find($this->reportId);
        if ($report) {
            $report->update($validated);
        }

        return $this->redirectRoute('reports.index', navigate: true);
    }

    public function render()
    {
        return view('livewire.reports.edit');
    }
}
