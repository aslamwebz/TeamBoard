<?php

declare(strict_types=1);

namespace App\Livewire\Projects\Phases;

use App\Models\Project;
use Illuminate\Contracts\View\View;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Component;
use Livewire\WithPagination;

#[Layout('components.layouts.app')]
#[Title('Project Phases')]
final class PhaseIndex extends Component
{
    use WithPagination;

    public Project $project;

    public function mount(Project $project): void
    {
        $this->project = $project;
    }

    public function render(): View
    {
        $phases = $this->project->phases()->paginate(10);

        return view('livewire.projects.phases.index', compact('phases'));
    }
}
