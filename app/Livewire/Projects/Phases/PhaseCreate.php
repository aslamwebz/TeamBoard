<?php

namespace App\Livewire\Projects\Phases;

use App\Models\Project;
use App\Models\ProjectPhase;
use Livewire\Component;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;

#[Layout('components.layouts.app')]
#[Title('Create Phase')]
class PhaseCreate extends Component
{
    public Project $project;
    public $name = '';
    public $description = '';
    public $start_date = '';
    public $end_date = '';
    public $status = 'not_started';
    public $order = 0;

    protected $rules = [
        'name' => 'required|string|max:255',
        'description' => 'nullable|string',
        'start_date' => 'nullable|date',
        'end_date' => 'nullable|date|after_or_equal:start_date',
        'status' => 'required|in:not_started,in_progress,completed,on_hold',
        'order' => 'required|integer|min:0',
    ];

    public function mount(Project $project)
    {
        $this->project = $project;
    }

    public function createPhase()
    {
        $this->validate();

        $this->project->phases()->create([
            'name' => $this->name,
            'description' => $this->description,
            'start_date' => $this->start_date,
            'end_date' => $this->end_date,
            'status' => $this->status,
            'order' => $this->order,
        ]);

        session()->flash('message', 'Phase created successfully.');

        return redirect()->route('projects.show', $this->project);
    }

    public function render()
    {
        return view('livewire.projects.phases.create');
    }
}