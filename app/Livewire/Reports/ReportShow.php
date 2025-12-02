<?php

declare(strict_types=1);

namespace App\Livewire\Reports;

use App\Models\Report;
use Illuminate\Contracts\View\View;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Component;

#[Layout('components.layouts.app')]
#[Title('View Report')]
final class ReportShow extends Component
{
    public Report $report;

    public function mount(Report $report): void
    {
        $this->report = $report;
    }

    public function render(): View
    {
        return view('livewire.reports.report-show');
    }
}
