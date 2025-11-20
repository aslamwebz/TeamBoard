<?php

namespace App\Livewire\Projects\Phases;

use App\Models\ProjectPhase;
use Livewire\Component;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;

#[Layout('components.layouts.app')]
#[Title('Edit Phase')]
class Edit extends Component
{
    public ProjectPhase $phase;
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

    public function mount(ProjectPhase $phase)
    {
        $this->phase = $phase;
        $this->name = $phase->name;
        $this->description = $phase->description;
        $this->start_date = $phase->start_date?->format('Y-m-d');
        $this->end_date = $phase->end_date?->format('Y-m-d');
        $this->status = $phase->status;
        $this->order = $phase->order;
    }

    public function updatePhase()
    {
        $this->validate();

        $this->phase->update([
            'name' => $this->name,
            'description' => $this->description,
            'start_date' => $this->start_date,
            'end_date' => $this->end_date,
            'status' => $this->status,
            'order' => $this->order,
        ]);

        session()->flash('message', 'Phase updated successfully.');

        return redirect()->route('projects.show', $this->phase->project);
    }

    public function deletePhase()
    {
        $project = $this->phase->project;
        $this->phase->delete();

        session()->flash('message', 'Phase deleted successfully.');

        return redirect()->route('projects.show', $project);
    }

    public function render()
    {
        return view('livewire.projects.phases.edit');
    }
}