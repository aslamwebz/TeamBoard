<?php

namespace App\Livewire\Projects\Phases;

use App\Models\Project;
use App\Models\ProjectPhase;
use Illuminate\Contracts\View\View;
use Livewire\Component;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\WithPagination;

#[Layout('components.layouts.app')]
#[Title('Project Phases')]
class PhaseIndex extends Component
{
    use WithPagination;

    public Project $project;

    public function mount(Project $project) : void
    {
        $this->project = $project;
    }

    public function render() : View
    {
        $phases = $this->project->phases()->paginate(10);
        return view('livewire.projects.phases.index', compact('phases'));
    }
}