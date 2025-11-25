<?php

namespace App\Livewire\Reports;

use App\Models\Report;
use Livewire\Component;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\WithPagination;

#[Layout('components.layouts.app')]
#[Title('Reports')]
class Index extends Component
{
    use WithPagination;

    public $search = '';
    public $typeFilter = '';
    public $statusFilter = '';
    public $showDeleteModal = false;
    public $reportToDeleteId;

    protected $queryString = ['search', 'typeFilter', 'statusFilter'];

    public function render()
    {
        $reports = Report::query()
            ->where('title', 'like', '%' . $this->search . '%')
            ->when($this->typeFilter, function ($query) {
                $query->where('report_type', $this->typeFilter);
            })
            ->when($this->statusFilter, function ($query) {
                $query->where('status', $this->statusFilter);
            })
            ->with(['user'])
            ->orderBy('created_at', 'desc')
            ->paginate(10);

        $reportTypes = [
            '' => 'All Types',
            'financial' => 'Financial',
            'project' => 'Project',
            'invoice' => 'Invoice',
            'client' => 'Client'
        ];

        $statuses = [
            '' => 'All Statuses',
            'draft' => 'Draft',
            'generated' => 'Generated',
            'archived' => 'Archived'
        ];

        return view('livewire.reports.index', [
            'reports' => $reports,
            'reportTypes' => $reportTypes,
            'statuses' => $statuses
        ]);
    }

    public function deleteReport($id)
    {
        $this->reportToDeleteId = $id;
        $this->showDeleteModal = true;
    }

    public function confirmDelete()
    {
        $report = Report::find($this->reportToDeleteId);
        if ($report) {
            $report->delete();
        }

        $this->showDeleteModal = false;
        $this->reportToDeleteId = null;
    }

    public function cancelDelete()
    {
        $this->showDeleteModal = false;
        $this->reportToDeleteId = null;
    }

    public function updateTypeFilter($type)
    {
        $this->typeFilter = $type;
    }

    public function updateStatusFilter($status)
    {
        $this->statusFilter = $status;
    }
}