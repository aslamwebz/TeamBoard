<?php

declare(strict_types=1);

namespace App\Livewire\Projects;

use App\Models\Project;
use App\Models\Team;
use App\Models\User;
use App\Traits\ModalTrait;
use Illuminate\Contracts\View\View;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Component;

#[Layout('components.layouts.app')]
#[Title('Project Details')]
final class ProjectShow extends Component
{
    use ModalTrait;

    public Project $project;
    public $projectDiscussions = [];

    public $showAssignUserModal = false;

    public $showAssignTeamModal = false;

    public $showAssignPhaseModal = false;

    public $showAssignMilestoneModal = false;

    public $selectedUsers = [];

    public $selectedTeams = [];

    public $selectedPhases = [];

    public $selectedMilestones = [];

    public $availableUsers = [];

    public $availableTeams = [];

    public $availablePhases = [];

    public $availableMilestones = [];

    public function mount(Project $project): void
    {
        $this->project = $project->load([
            'client',
            'invoices',
            'tasks' => function ($query) {
                $query->with('phase', 'users');
            },
            'users' => function ($query) {
                $query->with('tasks');
            },
            'teams' => function ($query) {
                $query->with('users');
            },
            'phases',
            'milestones',
            'discussions', // Load discussions for the project
            'phases.tasks', // Load tasks for each phase
        ]);

        // Load recent project discussions
        $this->projectDiscussions = $this->project->discussions()->latest()->limit(5)->get();
    }

    public function getAvailableUsersProperty()
    {
        return User::whereNotIn('id', $this->project->users->pluck('id'))->get();
    }

    public function getAvailableTeamsProperty()
    {
        return Team::whereNotIn('id', $this->project->teams->pluck('id'))->get();
    }

    public function assignUsers(): void
    {
        if (empty($this->selectedUsers)) {
            return;
        }

        $this->project->users()->attach($this->selectedUsers);
        $this->project->load('users');
        $this->selectedUsers = [];
        $this->showAssignUserModal = false;

        session()->flash('success', 'Users assigned successfully!');
    }

    public function assignTeams(): void
    {
        if (empty($this->selectedTeams)) {
            return;
        }

        $this->project->teams()->attach($this->selectedTeams);
        $this->project->load('teams');
        $this->selectedTeams = [];
        $this->showAssignTeamModal = false;

        session()->flash('success', 'Teams assigned successfully!');
    }

    public function cancelAssignUser(): void
    {
        $this->selectedUsers = [];
        $this->showAssignUserModal = false;
    }

    public function cancelAssignTeam(): void
    {
        $this->selectedTeams = [];
        $this->showAssignTeamModal = false;
    }

    public function updatedShowAssignUserModal($value): void
    {
        if (! $value) {
            $this->selectedUsers = [];
        }
    }

    public function updatedShowAssignTeamModal($value): void
    {
        if (! $value) {
            $this->selectedTeams = [];
        }
    }

    public function removeUser($userId): void
    {
        $this->project->users()->detach($userId);
        $this->project->load('users');

        session()->flash('success', 'User removed successfully!');
    }

    public function removeTeam($teamId): void
    {
        $this->project->teams()->detach($teamId);
        $this->project->load('teams');

        session()->flash('success', 'Team removed successfully!');
    }

    public function render(): View
    {
        return view('livewire.projects.project-show', [
            'project' => $this->project,
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

    public function getPhaseStatusBadgeClass(string $status): string
    {
        $phaseStatus = \App\Enums\PhaseStatus::tryFrom($status);
        if ($phaseStatus) {
            return $phaseStatus->getDarkColorClass();
        }

        return 'bg-zinc-500/10 text-zinc-700 dark:text-zinc-400';
    }

    public function getMilestoneStatusBadgeClass(string $status): string
    {
        $milestoneStatus = \App\Enums\PhaseStatus::tryFrom($status); // Milestones use the same statuses as phases
        if ($milestoneStatus) {
            return $milestoneStatus->getDarkColorClass();
        }

        return 'bg-zinc-500/10 text-zinc-700 dark:text-zinc-400';
    }

    public function getInvoiceStatusBadgeClass(string $status): string
    {
        $invoiceStatus = \App\Enums\InvoiceStatus::tryFrom($status);
        if ($invoiceStatus) {
            return $invoiceStatus->getDarkColorClass();
        }

        return 'bg-zinc-500/10 text-zinc-700 dark:text-zinc-400';
    }
}
