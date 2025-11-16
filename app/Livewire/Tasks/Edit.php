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
#[Title('Edit Task')]
class Edit extends Component
{
    public Task $task;
    public $title;
    public $description;
    public $status;
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

    public function mount(Task $task)
    {
        $this->task = $task;
        $this->title = $task->title;
        $this->description = $task->description;
        $this->status = $task->status;
        $this->due_date = $task->due_date;
        $this->project_id = $task->project_id;
        $this->user_id = $task->user_id;
        
        $this->projects = Project::all();
        $this->users = User::all();
    }

    public function updateTask()
    {
        $validatedData = $this->validate();
        
        $this->task->update($validatedData);

        session()->flash('message', 'Task updated successfully.');

        return redirect()->route('tasks');
    }

    public function render()
    {
        return view('livewire.tasks.edit');
    }
}