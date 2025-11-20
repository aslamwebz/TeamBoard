<?php

namespace App\Livewire\Projects\Milestones;

use App\Models\Milestone;
use App\Models\ProjectPhase;
use Livewire\Component;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;

#[Layout('components.layouts.app')]
#[Title('Edit Milestone')]
class Edit extends Component
{
    public Milestone $milestone;
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

    public function mount(Milestone $milestone)
    {
        $this->milestone = $milestone;
        $this->name = $milestone->name;
        $this->description = $milestone->description;
        $this->due_date = $milestone->due_date?->format('Y-m-d');
        $this->project_phase_id = $milestone->project_phase_id;
        $this->status = $milestone->status;
        $this->order = $milestone->order;
    }

    public function updateMilestone()
    {
        $this->validate();

        $this->milestone->update([
            'name' => $this->name,
            'description' => $this->description,
            'due_date' => $this->due_date,
            'project_phase_id' => $this->project_phase_id ?: null,
            'status' => $this->status,
            'order' => $this->order,
        ]);

        session()->flash('message', 'Milestone updated successfully.');

        return redirect()->route('projects.show', $this->milestone->project);
    }

    public function deleteMilestone()
    {
        $project = $this->milestone->project;
        $this->milestone->delete();

        session()->flash('message', 'Milestone deleted successfully.');

        return redirect()->route('projects.show', $project);
    }

    public function render()
    {
        $phases = $this->milestone->project->phases;
        return view('livewire.projects.milestones.edit', compact('phases'));
    }
}