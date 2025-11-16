<?php

namespace App\Livewire\Projects;

use App\Models\Project;
use App\Models\Task;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;

#[Layout('components.layouts.app')]
#[Title('Project Details')]
class Show extends Component
{
    public Project $project;
    public $tasksByStatus;

    public $newTaskTitle = '';
    public $newTaskDescription = '';


    public function mount(Project $project)
    {
        $this->project = $project;
        $this->refreshTasks();
    }

    public function refreshTasks()
    {
        $this->tasksByStatus = $this->project->tasks()->orderBy('status')->orderBy('created_at')->get()->groupBy('status');
    }

    public function addTask()
    {
        $this->validate([
            'newTaskTitle' => 'required|string|max:255',
        ]);

        Task::create([
            'title' => $this->newTaskTitle,
            'description' => $this->newTaskDescription,
            'status' => 'todo', // Default to 'todo' status
            'project_id' => $this->project->id,
            'user_id' => Auth::id(),
        ]);

        $this->newTaskTitle = '';
        $this->newTaskDescription = '';
        $this->refreshTasks();
    }

    public function updateTaskStatus($taskId, $newStatus)
    {
        $task = Task::find($taskId);
        if ($task && $task->project_id === $this->project->id) {
            $task->update(['status' => $newStatus]);
        }
        $this->refreshTasks();
    }

    public function updateTaskOrder()
    {
        // This method will be called for reordering within the same column
        // For now, just refresh to ensure UI is consistent
        $this->refreshTasks();
    }

    public function deleteTask($taskId)
    {
        $task = Task::find($taskId);
        if ($task && $task->project_id === $this->project->id) {
            $task->delete();
        }
        $this->refreshTasks();
    }

    public function render()
    {
        return view('livewire.projects.show');
    }
}
