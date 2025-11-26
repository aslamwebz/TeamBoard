<?php

namespace App\Livewire\Projects\Milestones;

use App\Models\Milestone;
use App\Models\Project;
use App\Models\ProjectPhase;
use Livewire\Component;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;

#[Layout('components.layouts.app')]
#[Title('Create Milestone')]
class MilestoneCreate extends Component
{
    public Project $project;
    public $name = '';
    public $description = '';
    public $due_date = '';
    public $project_phase_id = '';
    public $status = 'not_started';
    public $order = 0;

    protected $rules = [
        'name' => 'required|string|max:255',
        'description' => 'nullable|string',
        'due_date' => 'nullable|date',
        'project_phase_id' => 'nullable|exists:project_phases,id',
        'status' => 'required|in:not_started,in_progress,completed,on_hold',
        'order' => 'required|integer|min:0',
    ];

    public function mount(Project $project)
    {
        $this->project = $project;
    }

    public function createMilestone()
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

    public function render()
    {
        $phases = $this->project->phases;
        return view('livewire.projects.milestones.milestone-create', compact('phases'));
    }
}