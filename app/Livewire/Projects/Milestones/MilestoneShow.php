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

    public function mount(Milestone $milestone)
    {
        $this->milestone = $milestone;
    }

    public function render()
    {
        return view('livewire.projects.milestones.milestone-show');
    }
}
