<?php

declare(strict_types=1);

namespace App\Livewire\Projects\Milestones;

use App\Models\Project;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Component;

#[Layout('components.layouts.app')]
#[Title('Create Milestone')]
final class MilestoneCreate extends Component
{
    public Project $project;

    public $name = '';

    public $description = '';

    public $due_date = '';

    public $project_phase_id = '';

    public $status = 'not_started';

    public $order = 0;

    public function mount(Project $project): void
    {
        $this->project = $project;
    }

    public function createMilestone(): \Illuminate\Http\RedirectResponse
    {
        $this->validate();

        $this->project->milestones()->create([
            'name' => $this->name,
            'description' => $this->description,
            'due_date' => $this->due_date,
            'project_phase_id' => $this->project_phase_id ?: null,
            'status' => $this->status,
            'order' => $this->order,
        ]);

        session()->flash('message', 'Milestone created successfully.');

        return redirect()->route('projects.show', $this->project);
    }

    public function render(): \Illuminate\Contracts\View\View
    {
        $phases = $this->project->phases;

        return view('livewire.projects.milestones.milestone-create', ['phases' => $phases]);
    }
}
