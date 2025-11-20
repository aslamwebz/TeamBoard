<?php

namespace App\Livewire\Tasks;

use App\Models\Project;
use App\Models\ProjectPhase;
use App\Models\Task;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;

#[Layout('components.layouts.app')]
#[Title('Create Task')]
class Create extends Component
{
    public $title;
    public $description;
    public $status = 'todo';
    public $due_date;
    public $project_id;
    public $project_phase_id;
    public $user_id;

    public $projects = [];
    public $phases = [];
    public $users = [];

    protected $rules = [
        'title' => 'required|string|max:255',
        'description' => 'nullable|string',
        'status' => 'required|in:todo,in_progress,completed,on_hold',
        'due_date' => 'nullable|date',
        'project_id' => 'nullable|exists:projects,id',
        'project_phase_id' => 'nullable|exists:project_phases,id',
        'user_id' => 'nullable|exists:users,id',
    ];

    public function mount()
    {
        $this->projects = Project::all();
        $this->phases = collect(); // Empty initially
        $this->users = User::all();
    }

    public function createTask()
    {
        $validatedData = $this->validate();
        $validatedData['user_id'] = Auth::id();

        Task::create($validatedData);

        session()->flash('message', 'Task created successfully.');

        return redirect()->route('tasks');
    }

    public function updatedProjectId()
    {
        // When project changes, reload the phases
        if ($this->project_id) {
            $this->phases = ProjectPhase::where('project_id', $this->project_id)->get();
            $this->project_phase_id = null; // Reset phase selection
        } else {
            $this->phases = collect(); // Empty collection
            $this->project_phase_id = null;
        }
    }

    public function render()
    {
        return view('livewire.tasks.create');
    }
}