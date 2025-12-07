<?php

declare(strict_types=1);

namespace App\Livewire\Clients;

use App\Enums\ProjectStatus;
use App\Enums\TaskStatus;
use App\Models\Client;
use App\Models\Project;
use App\Models\Task;
use Illuminate\Contracts\View\View;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Component;

#[Layout('components.layouts.app')]
#[Title('View Client')]
final class ClientShow extends Component
{
    public Client $client;

    public $showAssignProjectModal = false;

    public $selectedProjectId = null;

    public $availableProjects = [];

    public int $projectCount = 0;

    public int $activeProjects = 0;

    public int $completedProjects = 0;

    public int $totalTasks = 0;

    public int $completedTasks = 0;

    public int $inProgressTasks = 0;

    public $recentTasks = [];

    public $projects = [];

    public function mount(Client $client): void
    {
        $this->authorize('view', $client);
        $this->client = $client;

        // Calculate client statistics
        $clientProjectIds = $this->client->projects()->pluck('id');
        $this->projectCount = $this->client->projects()->count();
        $this->activeProjects = $this->client->projects()
            ->whereIn('status', ['planning', 'in_progress'])
            ->count();
        $this->completedProjects = $this->client->projects()
            ->where('status', 'completed')
            ->count();

        // Calculate task statistics
        $this->totalTasks = Task::whereIn('project_id', $clientProjectIds)->count();
        $this->completedTasks = Task::whereIn('project_id', $clientProjectIds)
            ->where('status', 'completed')
            ->count();
        $this->inProgressTasks = Task::whereIn('project_id', $clientProjectIds)
            ->where('status', 'in_progress')
            ->count();

        // Get projects for this client
        $this->projects = $this->client->projects()->latest()->get();

        // Get recent tasks from projects belonging to this client
        $this->recentTasks = $this
            ->client
            ->projects()
            ->with([
                'tasks' => function ($query) {
                    $query->latest()->take(5);
                },
            ])
            ->get()
            ->pluck('tasks')
            ->flatten();

        $this->loadAvailableProjects();
    }

    public function loadAvailableProjects(): void
    {
        // Load projects that are not already assigned to this client
        $projects = Project::where(function ($query) {
            $query
                ->whereNull('client_id')
                ->orWhere('client_id', '!=', $this->client->id);
        })
            ->orderBy('name')
            ->get();

        $this->availableProjects = $projects->map(function ($project) {
            return [
                'id' => $project->id,
                'name' => $project->name,
            ];
        })->toArray();
    }

    public function assignProject(): void
    {
        if ($this->selectedProjectId) {
            $project = Project::find($this->selectedProjectId);
            if ($project) {
                $project->update(['client_id' => $this->client->id]);

                // Refresh the projects list
                $this->projects = $this->client->projects()->latest()->get();

                // Refresh the available projects list
                $this->loadAvailableProjects();

                $this->showAssignProjectModal = false;
                $this->selectedProjectId = null;

                // Refresh the component to update the UI
                $this->dispatch('$refresh');
            }
        }
    }

    public function unassignProject(int $projectId): void
    {
        $project = Project::find($projectId);
        if ($project && $project->client_id === $this->client->id) {
            $project->update(['client_id' => null]);

            // Refresh the projects list
            $this->projects = $this->client
                ->projects()
                ->latest()
                ->get();

            // Refresh the available projects list
            $this->loadAvailableProjects();

            // Refresh the component to update the UI
            $this->dispatch('$refresh');
        }
    }

    public function getProjectStatusBadgeClass(string $status): string
    {
        $projectStatus = ProjectStatus::tryFrom($status);
        if ($projectStatus) {
            return $projectStatus->getColorClass();
        }

        return 'bg-zinc-500/10 text-zinc-700 dark:text-zinc-400';
    }

    public function getTaskStatusBadgeClass(string $status): string
    {
        $taskStatus = TaskStatus::tryFrom($status);
        if ($taskStatus) {
            return $taskStatus->getDarkColorClass();
        }

        return 'bg-zinc-500/10 text-zinc-700 dark:text-zinc-400';
    }

    public function getProjectTaskCounts(Project $project)
    {
        $taskCount = $project->tasks()->count();
        $completedTaskCount = $project
            ->tasks()
            ->where('status', 'completed')
            ->count();

        return [
            'taskCount' => $taskCount,
            'completedTaskCount' => $completedTaskCount,
        ];
    }

    public function getClientStats(Client $client)
    {
        // Execute all related queries efficiently in one go
        $projects = $client->projects()
            ->withCount(['tasks', 'tasks as completed_tasks_count' => function ($query) {
                $query->where('status', 'completed');
            }, 'tasks as in_progress_tasks_count' => function ($query) {
                $query->where('status', 'in_progress');
            }])
            ->get();

        $projectCount = $projects->count();
        $activeProjects = $projects->whereIn('status', [
            ProjectStatus::PLANNING->value,
            ProjectStatus::IN_PROGRESS->value
        ])->count();
        $completedProjects = $projects->where('status', ProjectStatus::COMPLETED->value)->count();
        $totalTasks = $projects->sum('tasks_count');
        
        $completedTaskProjects = $projects->filter(fn($p) => $p->completed_tasks_count > 0)->count();
        $inProgressTaskProjects = $projects->filter(fn($p) => $p->in_progress_tasks_count > 0)->count();

        return [
            'projectCount' => $projectCount,
            'activeProjects' => $activeProjects,
            'completedProjects' => $completedProjects,
            'totalTasks' => $totalTasks,
            'completedTasks' => $completedTaskProjects,
            'inProgressTasks' => $inProgressTaskProjects,
        ];
    }

    public function getClientProjectCount(Client $client)
    {
        return $client->projects()->count();
    }

    public function getClientActiveProjectsCount(Client $client)
    {
        return $client->projects()->whereIn('status', [
            ProjectStatus::PLANNING->value,
            ProjectStatus::IN_PROGRESS->value
        ])->count();
    }

    public function getClientCompletedProjectsCount(Client $client)
    {
        return $client->projects()->where('status', ProjectStatus::COMPLETED->value)->count();
    }

    public function getClientTotalTasksCount(Client $client)
    {
        return $client->projects()->withCount('tasks')->get()->sum('tasks_count');
    }

    public function getClientCompletedTasksCount(Client $client)
    {
        return $client
            ->projects()
            ->whereHas('tasks', function ($query) {
                $query->where('status', 'completed');
            })
            ->count();
    }

    public function getClientInProgressTasksCount(Client $client)
    {
        return $client
            ->projects()
            ->whereHas('tasks', function ($query) {
                $query->where('status', 'in_progress');
            })
            ->count();
    }

    public function render(): View
    {
        $clientStats = $this->getClientStats($this->client);

        // Get projects with their task counts
        $projects = $this->client->projects()->get();
        $projectTaskCounts = [];

        foreach ($projects as $project) {
            $taskCounts = $this->getProjectTaskCounts($project);
            $projectTaskCounts[$project->id] = $taskCounts;
        }

        // Load recent tasks for the client
        $recentTasks = $this
            ->client
            ->projects()
            ->with([
                'tasks' => function ($query) {
                    $query->latest()->take(5);
                },
            ])
            ->get()
            ->pluck('tasks')
            ->flatten();

        return view('livewire.clients.client-show', [
            'client' => $this->client,
            'projects' => $projects,
            'projectTaskCounts' => $projectTaskCounts,
            'recentTasks' => $recentTasks,
            'projectCount' => $clientStats['projectCount'],
            'activeProjects' => $clientStats['activeProjects'],
            'completedProjects' => $clientStats['completedProjects'],
            'totalTasks' => $clientStats['totalTasks'],
            'completedTasks' => $clientStats['completedTasks'],
            'inProgressTasks' => $clientStats['inProgressTasks'],
        ]);
    }
}
