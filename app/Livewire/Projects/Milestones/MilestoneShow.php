<?php

declare(strict_types=1);

namespace App\Livewire\Projects\Milestones;

use App\Models\Milestone;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Component;

#[Layout('components.layouts.app')]
#[Title('View Milestone')]
final class MilestoneShow extends Component
{
    public Milestone $milestone;

    public function mount(Milestone $milestone): void
    {
        $this->milestone = $milestone;
    }

    public function render(): \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
    {
        return view('livewire.projects.milestones.milestone-show');
    }

    public function getMilestoneStatusBadgeClass(string $status): string
    {
        $milestoneStatus = \App\Enums\PhaseStatus::tryFrom($status); // Milestones use the same statuses as phases
        if ($milestoneStatus) {
            return $milestoneStatus->getColorClass();
        }

        return 'bg-zinc-100 text-zinc-800 dark:bg-zinc-700 dark:text-zinc-300';
    }
}
