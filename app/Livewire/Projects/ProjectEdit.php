<?php

namespace App\Livewire\Projects;

use App\Models\Project;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;

#[Layout('components.layouts.app')]
#[Title('Edit Project')]
class ProjectEdit extends Component
{
    public Project $project;
    public $name;
    public $description;
    public $status;
    public $due_date;

    protected $rules = [
        'name' => 'required|string|max:255',
        'description' => 'nullable|string',
        'status' => 'required|in:planning,in_progress,completed,on_hold',
        'due_date' => 'nullable|date',
    ];

    public function mount(Project $project)
    {
        $this->project = $project;
        $this->name = $project->name;
        $this->description = $project->description;
        $this->status = $project->status;
        $this->due_date = $project->due_date;
    }

    public function updateProject()
    {
        $validatedData = $this->validate();

        $this->project->update($validatedData);

        // Dispatch notification when project is updated
        \App\Events\ProjectUpdatedNotification::dispatch($this->project, Auth::user());

        session()->flash('message', 'Project updated successfully.');

        return redirect()->route('projects');
    }

    public function render()
    {
        return view('livewire.projects.project-edit');
    }
}
