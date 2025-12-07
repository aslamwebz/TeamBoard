<?php

declare(strict_types=1);

namespace App\Livewire\Clients;

use App\Models\Client;
use App\Models\Project;
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
        $this->client = $client;

        // Calculate client statistics
        $clientProjectIds = $this->client->projects()->pluck('id');
        $this->projectCount = $this->client->projects()->count();
        $this->activeProjects = $this->client->projects()->whereIn('status', ['planning', 'in_progress'])->count();
        $this->completedProjects = $this->client->projects()->where('status', 'completed')->count();

        // Calculate task statistics
        $this->totalTasks = \App\Models\Task::whereIn('project_id', $clientProjectIds)->count();
        $this->completedTasks = \App\Models\Task::whereIn('project_id', $clientProjectIds)->where('status', 'completed')->count();
        $this->inProgressTasks = \App\Models\Task::whereIn('project_id', $clientProjectIds)->where('status', 'in_progress')->count();

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

    public function unassignProject($projectId): void
    {
        $project = Project::find($projectId);
        if ($project && $project->client_id === $this->client->id) {
            $project->update(['client_id' => null]);

            // Refresh the projects list
            $this->projects = $this->client->projects()->latest()->get();

            // Refresh the available projects list
            $this->loadAvailableProjects();

            // Refresh the component to update the UI
            $this->dispatch('$refresh');
        }
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

    public function getProjectStatusBadgeClass(string $status): string
    {
        $projectStatus = \App\Enums\ProjectStatus::tryFrom($status);
        if ($projectStatus) {
            return $projectStatus->getColorClass();
        }

        return 'bg-zinc-500/10 text-zinc-700 dark:text-zinc-400';
    }

    public function getTaskStatusBadgeClass(string $status): string
    {
        $taskStatus = \App\Enums\TaskStatus::tryFrom($status);
        if ($taskStatus) {
            return $taskStatus->getDarkColorClass();
        }

        return 'bg-zinc-500/10 text-zinc-700 dark:text-zinc-400';
    }

    public function getProjectTaskCounts($project)
    {
        $taskCount = $project->tasks()->count();
        $completedTaskCount = $project->tasks()->where('status', 'completed')->count();

        return [
            'taskCount' => $taskCount,
            'completedTaskCount' => $completedTaskCount,
        ];
    }

    public function getClientStats($client)
    {
        // Execute all related queries efficiently in one go
        $projects = $client->projects()->withCount('tasks')->get();

        $projectCount = $projects->count();
        $activeProjects = $projects->whereIn('status', ['planning', 'in_progress'])->count();
        $completedProjects = $projects->where('status', 'completed')->count();
        $totalTasks = $projects->sum('tasks_count');

        // For completed and in-progress tasks counts, count projects that have such tasks
        $completedTaskProjects = $projects->filter(function ($project) {
            return $project->tasks()->where('status', 'completed')->exists();
        })->count();

        $inProgressTaskProjects = $projects->filter(function ($project) {
            return $project->tasks()->where('status', 'in_progress')->exists();
        })->count();

        return [
            'projectCount' => $projectCount,
            'activeProjects' => $activeProjects,
            'completedProjects' => $completedProjects,
            'totalTasks' => $totalTasks,
            'completedTasks' => $completedTaskProjects,  // Note: This logic might be different based on requirement
            'inProgressTasks' => $inProgressTaskProjects,  // Note: This logic might be different based on requirement
        ];
    }

    public function getClientProjectCount($client)
    {
        return $client->projects()->count();
    }

    public function getClientActiveProjectsCount($client)
    {
        return $client->projects()->whereIn('status', ['planning', 'in_progress'])->count();
    }

    public function getClientCompletedProjectsCount($client)
    {
        return $client->projects()->where('status', 'completed')->count();
    }

    public function getClientTotalTasksCount($client)
    {
        return $client->projects()->withCount('tasks')->get()->sum('tasks_count');
    }

    public function getClientCompletedTasksCount($client)
    {
        return $client
            ->projects()
            ->whereHas('tasks', function ($query) {
                $query->where('status', 'completed');
            })
            ->count();
    }

    public function getClientInProgressTasksCount($client)
    {
        return $client
            ->projects()
            ->whereHas('tasks', function ($query) {
                $query->where('status', 'in_progress');
            })
            ->count();
    }
}
