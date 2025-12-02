<?php

declare(strict_types=1);

namespace App\Livewire\Projects\Milestones;

use App\Models\Project;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Component;
use Livewire\WithPagination;

#[Layout('components.layouts.app')]
#[Title('Project Milestones')]
final class MilestoneIndex extends Component
{
    use WithPagination;

    public Project $project;

    public function mount(Project $project)
    {
        $this->project = $project;
    }

    public function render()
    {
        $milestones = $this->project->milestones()->paginate(10);

        return view('livewire.projects.milestones.milestone-index', compact('milestones'));
    }
}
