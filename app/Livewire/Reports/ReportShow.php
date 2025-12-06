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

    public function getReportStatusBadgeClass(string $status): string
    {
        $reportStatus = \App\Enums\ReportStatus::tryFrom($status);
        if ($reportStatus) {
            return $reportStatus->getColorClass();
        }

        return 'bg-gray-100 text-gray-800 dark:bg-gray-700 dark:text-gray-300';
    }
}
