<?php

declare(strict_types=1);

namespace App\Livewire\Worker;

use App\Models\Task;
use Illuminate\Contracts\View\View;
use Livewire\Component;

final class WorkerDashboard extends Component
{
    public $myTasks;

    public $myProjects;

    public $upcomingDeadlines;

    public $teamActivity;

    public $importantAnnouncements;

    public $notifications;

    public $quickActions;

    public $myTasksCount = 0;

    public $completedTasksCount = 0;

    public $myProjectsCount = 0;

    public $avgProjectCompletion = 0;

    public $upcomingDeadlinesCount = 0;

    public $overdueDeadlinesCount = 0;

    public function mount(): void
    {
        $this->loadDashboardData();
    }

    public function loadDashboardData(): void
    {
        // Get the authenticated user
        $user = auth()->user();

        // Get the worker profile for this user
        $workerProfile = $user->workerProfile;

        if ($workerProfile) {
            // Load "My Tasks" - tasks assigned to this user
            $this->myTasks = Task::whereHas('users', function ($query) use ($user): void {
                $query->where('user_id', $user->id);
            })
                ->with(['project', 'users'])
                ->latest()
                ->take(5)
                ->get();

            // Calculate task statistics
            $this->myTasksCount = $this->myTasks->count();
            $this->completedTasksCount = $this->myTasks->where('status', 'completed')->count();

            // Load "My Projects" - projects this user is assigned to
            $this->myProjects = $user->projects()
                ->with(['tasks' => function ($query) use ($user): void {
                    $query->whereHas('users', function ($q) use ($user): void {
                        $q->where('user_id', $user->id);
                    })->with('users');
                }, 'milestones', 'phases'])
                ->latest()
                ->take(5)
                ->get();

            // Calculate project statistics
            $this->myProjectsCount = $this->myProjects->count();
            if ($this->myProjectsCount > 0) {
                $totalCompletion = 0;
                foreach ($this->myProjects as $project) {
                    $totalCompletion += $project->getCompletionPercentage();
                }

                $this->avgProjectCompletion = $totalCompletion / $this->myProjectsCount;
            }

            // Load "Upcoming Deadlines" - tasks assigned to the user with due dates (including overdue)
            $this->upcomingDeadlines = Task::whereHas('users', function ($query) use ($user): void {
                $query->where('user_id', $user->id);
            })
                ->whereNotNull('due_date')
                ->with('project')
                ->orderByRaw('CASE WHEN due_date < ? THEN 0 ELSE 1 END, due_date ASC', [now()->startOfDay()])
                ->take(10)
                ->get();

            // Calculate deadline statistics
            $this->upcomingDeadlinesCount = $this->upcomingDeadlines->count();
            $this->overdueDeadlinesCount = $this->upcomingDeadlines->where('due_date', '<', now()->addDays(1))->count();

            // Load notifications for the user
            $this->notifications = $user->notifications()
                ->latest()
                ->take(5)
                ->get();
        }

        // Load team activity related to user's tasks and projects
        $this->teamActivity = collect();

        // Get recent activities related to user's tasks and projects
        $userTasks = Task::whereHas('users', function ($query) use ($user): void {
            $query->where('user_id', $user->id);
        })->pluck('id');

        // This is a simplified example - in a real app, you'd have a proper activity/feed system
        // For now, we'll construct some example activities based on recent task changes
        if ($userTasks->count() > 0) {
            // In a real application, you would have a proper activity system that logs
            // changes to tasks, comments, mentions, etc.
            $this->teamActivity = collect([
                ['type' => 'task_assigned', 'message' => 'You were assigned to a new task', 'time' => now()->subHours(2), 'user' => 'John Doe'],
                ['type' => 'comment', 'message' => 'Sarah Miller commented on your task', 'time' => now()->subHours(4), 'user' => 'Sarah Miller'],
                ['type' => 'milestone', 'message' => "A project you're working on reached a milestone", 'time' => now()->subDay(), 'user' => 'System'],
            ]);
        }

        // Load important announcements
        // In a real application, these would come from an announcements table
        $this->importantAnnouncements = collect([
            ['title' => 'System Maintenance', 'message' => 'Scheduled for Saturday at 2 AM EST', 'type' => 'info', 'date' => now()->addDays(2)],
            ['title' => 'New Safety Protocols', 'message' => 'Please review the updated guidelines', 'type' => 'warning', 'date' => now()->subWeek()],
            ['title' => 'Company Holiday', 'message' => 'Office closed on December 25th', 'type' => 'holiday', 'date' => now()->addDays(30)],
            ['title' => 'Policy Update', 'message' => 'Updated remote work policy now in effect', 'type' => 'info', 'date' => now()->subDays(3)],
        ]);

        // Define quick actions for workers
        $this->quickActions = [
            [
                'title' => 'View My Tasks',
                'description' => 'Check and update your assigned tasks',
                'icon' => 'list-bullet',
                'route' => 'tasks',
                'color' => 'blue',
            ],
            [
                'title' => 'View My Projects',
                'description' => 'See projects you are assigned to',
                'icon' => 'folder',
                'route' => 'projects',
                'color' => 'emerald',
            ],
            [
                'title' => 'Update Profile',
                'description' => 'Edit your worker profile information',
                'icon' => 'user',
                'route' => 'workers.show',
                'color' => 'amber',
                'params' => $user->workerProfile->id ?? null,
            ],
            [
                'title' => 'Log Hours',
                'description' => 'Track your time and activities',
                'icon' => 'clock',
                'route' => 'my.timesheets',
                'color' => 'violet',
            ],
            [
                'title' => 'Skills & Certs',
                'description' => 'Manage your skills and certifications',
                'icon' => 'academic-cap',
                'route' => 'my.skills',
                'color' => 'purple',
            ],
            [
                'title' => 'Report Issue',
                'description' => 'Submit a support ticket',
                'icon' => 'exclamation-circle',
                'route' => 'discussions.index',
                'color' => 'red',
            ],
        ];
    }

    public function updateTaskStatus($taskId, $status): void
    {
        /** @var \App\Models\User $user */
        $user = auth()->user();
        $task = Task::where('id', $taskId)
            ->whereHas('users', function ($query) use ($user): void {
                $query->where('user_id', $user->id);
            })
            ->first();

        if ($task) {
            $task->update(['status' => $status]);
            $this->loadDashboardData(); // Refresh the data
            session()->flash('message', 'Task status updated successfully.');
        }
    }

    public function getTaskDeadlineInfo($task): array
    {
        $isOverdue = $task->due_date->isBefore(now()->startOfDay());
        $dateClass = $isOverdue ? 'text-red-600 dark:text-red-400' : ($task->due_date->isToday() ? 'text-amber-600 dark:text-amber-400' : 'text-zinc-500 dark:text-zinc-400');
        $bgClass = $isOverdue ? 'bg-red-50 dark:bg-red-900/20' : ($task->due_date->isToday() ? 'bg-amber-50 dark:bg-amber-900/20' : 'bg-blue-50 dark:bg-blue-900/20');

        return [
            'isOverdue' => $isOverdue,
            'dateClass' => $dateClass,
            'bgClass' => $bgClass,
        ];
    }

    public function render(): View
    {
        $this->loadDashboardData();

        // Precompute task deadline info for upcoming deadlines
        $upcomingDeadlinesWithInfo = $this->upcomingDeadlines->map(function ($task) {
            $deadlineInfo = $this->getTaskDeadlineInfo($task);
            $task->deadlineInfo = $deadlineInfo;

            return $task;
        });

        return view('livewire.worker.worker-dashboard', [
            'myTasks' => $this->myTasks,
            'myProjects' => $this->myProjects,
            'upcomingDeadlines' => $upcomingDeadlinesWithInfo,
            'teamActivity' => $this->teamActivity,
            'importantAnnouncements' => $this->importantAnnouncements,
            'notifications' => $this->notifications,
            'quickActions' => $this->quickActions,
            'myTasksCount' => $this->myTasksCount,
            'completedTasksCount' => $this->completedTasksCount,
            'myProjectsCount' => $this->myProjectsCount,
            'avgProjectCompletion' => $this->avgProjectCompletion,
            'upcomingDeadlinesCount' => $this->upcomingDeadlinesCount,
            'overdueDeadlinesCount' => $this->overdueDeadlinesCount,
        ]);
    }
}
