<?php

namespace App\Livewire\Projects;

use App\Models\Project;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;

#[Layout('components.layouts.app')]
#[Title('Create Project')]
class Create extends Component
{
    public $name;
    public $description;
    public $status = 'planning';
    public $due_date;

    protected $rules = [
        'name' => 'required|string|max:255',
        'description' => 'nullable|string',
        'status' => 'required|in:planning,in_progress,completed,on_hold',
        'due_date' => 'nullable|date',
    ];

    public function createProject()
    {
        $validatedData = $this->validate();

        Project::create($validatedData);

        session()->flash('message', 'Project created successfully.');

        return redirect()->route('projects');
    }

    public function render()
    {
        return view('livewire.projects.create');
    }
}
