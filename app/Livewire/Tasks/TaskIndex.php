<?php

namespace App\Livewire\Tasks;

use App\Models\Task;
use Illuminate\Contracts\View\View;
use Livewire\Component;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\WithPagination;

#[Layout('components.layouts.app')]
#[Title('Tasks')]
class TaskIndex extends Component
{
    use WithPagination;

    public $search = '';
    public $statusFilter = '';
    public $showDeleteModal = false;
    public $taskToDeleteId;
    public $viewMode = 'table'; // 'table' or 'board'

    public $showTaskModal = false;
    public $selectedTaskId = null;
    public $selectedTask = null;

    public $tasksByStatus;

    protected $queryString = ['search', 'statusFilter', 'viewMode'];

    public function mount() : void
    {
        $this->refreshTasksByStatus();
    }

    public function render() : View
    {
        // Always provide both datasets to the view to prevent issues
        if ($this->viewMode === 'board') {
            $this->refreshTasksByStatus();
            $tasks = collect(); // Not used in board view but provided to prevent issues
        } else {
            $tasks = Task::query()
                ->where('title', 'like', '%' . $this->search . '%')
                ->when($this->statusFilter, function ($query) {
                    $query->where('status', $this->statusFilter);
                })
                ->with(['project', 'users', 'phase']) // Eager load relationships
                ->paginate(10);
            // Only refresh for board when needed
            if ($this->search || $this->statusFilter) {
                $this->refreshTasksByStatus();
            }
        }

        return view('livewire.tasks.task-index', [
            'tasks' => $tasks,
            'tasksByStatus' => $this->tasksByStatus
        ]);
    }

    public function getTaskStatusBadgeClass(string $status): string
    {
        return match($status) {
            'todo' => 'bg-gray-100 text-gray-800',
            'in_progress' => 'bg-blue-100 text-blue-800',
            'completed' => 'bg-green-100 text-green-800',
            'on_hold' => 'bg-yellow-100 text-yellow-800',
            default => 'bg-gray-100 text-gray-800',
        };
    }

    public function refreshTasksByStatus(): void
    {
        $query = Task::query();

        if ($this->search) {
            $query->where('title', 'like', '%' . $this->search . '%');
        }

        if ($this->statusFilter) {
            $query->where('status', $this->statusFilter);
        }

        $tasks = $query->with(['project', 'users', 'phase'])
            ->orderBy('status')
            ->orderBy('created_at')
            ->get();

        // Create a simple array grouped by status to avoid morph class issues
        $groupedTasks = [
            'todo' => [],
            'in_progress' => [],
            'completed' => [],
            'on_hold' => []
        ];

        foreach ($tasks as $task) {
            $groupedTasks[$task->status][] = $task;
        }

        $this->tasksByStatus = $groupedTasks;
    }

    public function deleteTask($id): void
    {
        $this->taskToDeleteId = $id;
        $this->showDeleteModal = true;
    }

    public function confirmDelete(): void
    {
        $task = Task::find($this->taskToDeleteId);
        if ($task) {
            $task->delete();
        }

        $this->showDeleteModal = false;
        $this->taskToDeleteId = null;
        $this->refreshTasksByStatus();
    }

    public function cancelDelete(): void
    {
        $this->showDeleteModal = false;
        $this->taskToDeleteId = null;
    }

    public function updateStatusFilter($status): void
    {
        $this->statusFilter = $status;
        $this->resetPage();
    }

    public function switchViewMode($mode): void
    {
        $this->viewMode = $mode;
        $this->resetPage();
    }

    public function openTaskDetails($taskId): void
    {
        $this->selectedTaskId = $taskId;
        $this->selectedTask = Task::with(['project', 'users', 'phase'])->find($taskId);
        $this->showTaskModal = true;
    }

    public function updateTaskStatus($taskId, $newStatus): void
    {
        $task = Task::find($taskId);
        if ($task) {
            $task->update(['status' => $newStatus]);
        }
        $this->refreshTasksByStatus();
    }

    public function closeTaskModal(): void
    {
        $this->showTaskModal = false;
        $this->selectedTaskId = null;
        $this->selectedTask = null;
    }
}