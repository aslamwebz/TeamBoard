<?php

namespace App\Livewire\Projects;

use App\Models\Project;
use App\Models\Team;
use App\Models\User;
use App\Traits\ModalTrait;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Component;

#[Layout('components.layouts.app')]
#[Title('Project Details')]
class Show extends Component
{
    use ModalTrait;

    public Project $project;
    public $showAssignUserModal = false;
    public $showAssignTeamModal = false;
    public $selectedUsers = [];
    public $selectedTeams = [];
    public $availableUsers = [];
    public $availableTeams = [];
    
    

    public function mount(Project $project)
    {
        $this->project = $project->load(['client', 'invoices', 'tasks', 'users', 'teams']);
    }

    public function getAvailableUsersProperty()
    {
        return User::whereNotIn('id', $this->project->users->pluck('id'))->get();
    }

    public function getAvailableTeamsProperty()
    {
        return Team::whereNotIn('id', $this->project->teams->pluck('id'))->get();
    }

    public function assignUsers()
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

    public function assignTeams()
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

    public function cancelAssignUser()
    {
        $this->selectedUsers = [];
        $this->showAssignUserModal = false;
    }

    public function cancelAssignTeam()
    {
        $this->selectedTeams = [];
        $this->showAssignTeamModal = false;
    }

    public function updatedShowAssignUserModal($value)
    {
        if (!$value) {
            $this->selectedUsers = [];
        }
    }

    public function updatedShowAssignTeamModal($value)
    {
        if (!$value) {
            $this->selectedTeams = [];
        }
    }

    public function removeUser($userId)
    {
        $this->project->users()->detach($userId);
        $this->project->load('users');

        session()->flash('success', 'User removed successfully!');
    }

    public function removeTeam($teamId)
    {
        $this->project->teams()->detach($teamId);
        $this->project->load('teams');

        session()->flash('success', 'Team removed successfully!');
    }

    public function render()
    {
        return view('livewire.projects.show', [
            'project' => $this->project,
        ]);
    }
}
