<?php declare(strict_types=1);

namespace App\Livewire\Tasks;

use App\Models\Project;
use App\Models\Task;
use Illuminate\Contracts\View\View;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Component;
use Livewire\WithPagination;

#[Layout('components.layouts.app')]
#[Title('Tasks')]
final class TaskIndex extends Component
{
    use WithPagination;

    public $search = '';

    public $statusFilter = '';

    public $projectFilter = '';

    public $showDeleteModal = false;

    public $taskToDeleteId;

    public $viewMode = 'table';  // 'table' or 'board'

    public $showTaskModal = false;

    public $selectedTaskId = null;

    public $selectedTask = null;

    public $tasksByStatus;

    public array $statusColors = [];

    public $projects = [];

    protected $queryString = ['search', 'statusFilter', 'projectFilter', 'viewMode'];

    public function mount(): void
    {
        $this->refreshTasksByStatus();
        $this->loadProjects();
    }

    public function loadProjects(): void
    {
        $this->projects = Project::orderBy('name')->get();
    }

    public function getTaskStatusBadgeClass(string $status): string
    {
        $taskStatus = \App\Enums\TaskStatus::tryFrom($status);
        if ($taskStatus) {
            return $taskStatus->getLightColorClass();
        }

        return 'bg-gray-100 text-gray-800';
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

        if ($this->projectFilter) {
            $query->where('project_id', $this->projectFilter);
        }

        $tasks = $query
            ->with(['project', 'users', 'phase', 'user'])
            ->orderBy('status')
            ->orderBy('created_at')
            ->get();

        // Create a simple array grouped by status to avoid morph class issues
        $groupedTasks = [
            'todo' => [],
            'in_progress' => [],
            'completed' => [],
            'on_hold' => [],
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
        $this->selectedTask = Task::with(['project', 'users', 'phase', 'user'])->find($taskId);
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

    public function getStatusColumns()
    {
        return [
            'todo' => ['title' => __('To Do'), 'color' => 'bg-zinc-100 dark:bg-zinc-700'],
            'in_progress' => ['title' => __('In Progress'), 'color' => 'bg-blue-100 dark:bg-blue-900/30'],
            'completed' => ['title' => __('Completed'), 'color' => 'bg-green-100 dark:bg-green-900/30'],
            'on_hold' => ['title' => __('On Hold'), 'color' => 'bg-red-100 dark:bg-red-900/30'],
        ];
    }

    public function render(): View
    {
        $statusColumns = $this->getStatusColumns();

        // Original render logic with statusColumns added
        $query = Task::query();

        if ($this->search) {
            $query->where('title', 'like', '%' . $this->search . '%');
        }

        if ($this->statusFilter) {
            $query->where('status', $this->statusFilter);
        }

        $tasks = $query->with(['user', 'project', 'users', 'phase'])->orderBy('created_at', 'desc')->paginate(10);

        return view('livewire.tasks.task-index', [
            'tasks' => $tasks,
            'statusColumns' => $statusColumns,
        ]);
    }
}
