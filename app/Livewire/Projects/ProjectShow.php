<?php

namespace App\Livewire\Projects;

use App\Models\Project;
use App\Models\ProjectPhase;
use App\Models\Team;
use App\Models\User;
use App\Traits\ModalTrait;
use Illuminate\Contracts\View\View;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Component;

#[Layout('components.layouts.app')]
#[Title('Project Details')]
class ProjectShow extends Component
{
    use ModalTrait;

    public Project $project;
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

    public function mount(Project $project) : void
    {
        $this->project = $project->load([
            'client',
            'invoices',
            'tasks',
            'users',
            'teams',
            'phases',
            'milestones',
            'discussions', // Load discussions for the project
            'phases.tasks' // Load tasks for each phase
        ]);
    }

    public function getAvailableUsersProperty()
    {
        return User::whereNotIn('id', $this->project->users->pluck('id'))->get();
    }

    public function getAvailableTeamsProperty()
    {
        return Team::whereNotIn('id', $this->project->teams->pluck('id'))->get();
    }

    public function assignUsers() : void
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

    public function assignTeams() : void
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

    public function cancelAssignUser() : void
    {
        $this->selectedUsers = [];
        $this->showAssignUserModal = false;
    }

    public function cancelAssignTeam() : void
    {
        $this->selectedTeams = [];
        $this->showAssignTeamModal = false;
    }

    public function updatedShowAssignUserModal($value) : void
    {
        if (!$value) {
            $this->selectedUsers = [];
        }
    }

    public function updatedShowAssignTeamModal($value) : void
    {
        if (!$value) {
            $this->selectedTeams = [];
        }
    }

    public function removeUser($userId) : void
    {
        $this->project->users()->detach($userId);
        $this->project->load('users');

        session()->flash('success', 'User removed successfully!');
    }

    public function removeTeam($teamId) : void
    {
        $this->project->teams()->detach($teamId);
        $this->project->load('teams');

        session()->flash('success', 'Team removed successfully!');
    }

    public function render() : View
    {
        return view('livewire.projects.project-show', [
            'project' => $this->project,
        ]);
    }
}
