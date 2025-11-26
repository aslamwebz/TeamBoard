<?php

namespace App\Livewire\Tasks;

use App\Models\Project;
use App\Models\ProjectPhase;
use App\Models\Task;
use App\Models\User;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;

#[Layout('components.layouts.app')]
#[Title('Edit Task')]
class TaskEdit extends Component
{
    public Task $task;
    public $title;
    public $description;
    public $status;
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

    public function mount(Task $task) : void
    {
        $this->task = $task->load('project');
        $this->title = $task->title;
        $this->description = $task->description;
        $this->status = $task->status;
        $this->due_date = $task->due_date;
        $this->project_id = $task->project_id;
        $this->project_phase_id = $task->project_phase_id;
        $this->user_id = $task->user_id;

        $this->projects = Project::all();
        $this->phases = ProjectPhase::where('project_id', $task->project_id)->get();
        $this->users = User::all();
    }

    public function updatedProjectId() : void
    {
        // When project changes, reload the phases
        $this->phases = ProjectPhase::where('project_id', $this->project_id)->get();
        $this->project_phase_id = null; // Reset phase selection
    }

    public function updateTask() : RedirectResponse
    {
        $oldUserId = $this->task->user_id;
        $validatedData = $this->validate();

        $this->task->update($validatedData);

        // If the task assignment changed (different user from before), send a notification
        if ($this->user_id && $this->user_id != $oldUserId) {
            $assignedUser = User::find($this->user_id);
            $assigner = Auth::user();

            \App\Events\TaskAssignedNotification::dispatch($this->task, $assignedUser, $assigner);
        }

        session()->flash('message', 'Task updated successfully.');

        return redirect()->route('tasks');
    }

    public function render() : View
    {
        return view('livewire.tasks.task-edit');
    }
}