<?php

namespace App\Livewire\Reports;

use App\Models\Report;
use Livewire\Component;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;

#[Layout('components.layouts.app')]
#[Title('View Report')]
class ReportShow extends Component
{
    public Report $report;

    public function mount(Report $report)
    {
        $this->report = $report;
    }

    public function render()
    {
        return view('livewire.reports.show');
    }
}