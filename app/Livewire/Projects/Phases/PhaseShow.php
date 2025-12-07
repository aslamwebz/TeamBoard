<?php

declare(strict_types=1);

namespace App\Livewire\Projects\Phases;

use App\Models\ProjectPhase;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Component;

#[Layout('components.layouts.app')]
#[Title('View Phase')]
final class PhaseShow extends Component
{
    public ProjectPhase $phase;

    public array $statusColors = [];

    public function mount(ProjectPhase $phase)
    {
        $this->phase = $phase;

        // Define status colors for presentation using enum
        $this->statusColors = [
            'not_started' => \App\Enums\PhaseStatus::NOT_STARTED->getColorClass(),
            'in_progress' => \App\Enums\PhaseStatus::IN_PROGRESS->getColorClass(),
            'completed' => \App\Enums\PhaseStatus::COMPLETED->getColorClass(),
            'on_hold' => \App\Enums\PhaseStatus::ON_HOLD->getColorClass(),
        ];
    }

    public function render()
    {
        return view('livewire.projects.phases.show');
    }

    public function getTaskStatusBadgeClass(string $status): string
    {
        $taskStatus = \App\Enums\TaskStatus::tryFrom($status);
        if ($taskStatus) {
            return $taskStatus->getColorClass();
        }

        return 'bg-zinc-100 text-zinc-800 dark:bg-zinc-700 dark:text-zinc-300';
    }
}
