<?php

namespace App\Livewire\Tasks;

use App\Models\Project;
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
    public $user_id;

    public $projects = [];
    public $users = [];

    protected $rules = [
        'title' => 'required|string|max:255',
        'description' => 'nullable|string',
        'status' => 'required|in:todo,in_progress,completed,on_hold',
        'due_date' => 'nullable|date',
        'project_id' => 'nullable|exists:projects,id',
        'user_id' => 'nullable|exists:users,id',
    ];

    public function mount()
    {
        $this->projects = Project::all();
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

    public function render()
    {
        return view('livewire.tasks.create');
    }
}