<?php

namespace App\Livewire\Teams;

use App\Models\Client;
use App\Models\Project;
use App\Models\Task;
use App\Models\Team;
use App\Models\User;
use App\Traits\ModalTrait;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Component;

#[Layout('components.layouts.app')]
#[Title('Team Details')]
class TeamShow extends Component
{
    use ModalTrait;

    public Team $team;
    public $showAssignMemberModal = false;
    public $showAssignClientModal = false;
    public $showAssignProjectModal = false;
    public $showAssignTaskModal = false;
    public $selectedUsers = [];
    public $selectedClients = [];
    public $selectedProjects = [];
    public $selectedTasks = [];
    public $availableUsers = [];
    public $availableClients = [];
    public $availableProjects = [];
    public $availableTasks = [];
    public $allClients = [];
    public $allTasks = [];
    public $allProjects = [];
    public $allUsers = [];

    public function mount(Team $team)
    {
        $this->team = $team->load(['users.projects.client', 'users.projects.tasks', 'users.projects.tasks.project', 'projects.client', 'projects.tasks', 'projects.tasks.project', 'clients']);
        $this->allClients = Client::all();
        $this->allTasks = Task::all();
        $this->allProjects = Project::all();
        $this->allUsers = User::all();
    }

    public function getAvailableUsersProperty()
    {
        return User::whereNotIn('id', $this->team->users->pluck('id'))->get();
    }

    public function getAvailableClientsProperty()
    {
        return Client::whereNotIn('id', $this->team->clients->pluck('id'))->get();
    }

    public function getAvailableProjectsProperty()
    {
        return Project::whereNotIn('id', $this->team->projects->pluck('id'))->get();
    }

    public function getAvailableTasksProperty()
    {
        // Get tasks from all team projects that aren't already assigned to the team
        $teamProjectIds = $this->team->projects->pluck('id');
        return Task::whereIn('project_id', $teamProjectIds)->get();
    }

    public function assignMembers()
    {
        if (empty($this->selectedUsers)) {
            return;
        }

        $this->team->users()->attach($this->selectedUsers);
        $this->team->load(['users.projects.client', 'users.projects.tasks.project', 'projects.client', 'projects.tasks.project', 'clients']);
        $this->selectedUsers = [];
        $this->showAssignMemberModal = false;

        session()->flash('success', 'Team members assigned successfully!');
    }

    public function assignClients()
    {
        if (empty($this->selectedClients)) {
            return;
        }

        $this->team->clients()->attach($this->selectedClients);
        $this->team->load(['users.projects.client', 'users.projects.tasks.project', 'projects.client', 'projects.tasks.project', 'clients']);
        $this->selectedClients = [];
        $this->showAssignClientModal = false;

        session()->flash('success', 'Clients assigned successfully!');
    }

    public function assignProjects()
    {
        if (empty($this->selectedProjects)) {
            return;
        }

        $this->team->projects()->attach($this->selectedProjects);
        $this->team->load(['users.projects.client', 'users.projects.tasks.project', 'projects.client', 'projects.tasks.project', 'clients']);
        $this->selectedProjects = [];
        $this->showAssignProjectModal = false;

        session()->flash('success', 'Projects assigned successfully!');
    }

    public function assignTasks()
    {
        if (empty($this->selectedTasks)) {
            return;
        }

        // Assign selected tasks to team users - this means assigning tasks to users who are in this team
        $teamUserIds = $this->team->users->pluck('id')->toArray();

        foreach ($this->selectedTasks as $taskId) {
            $task = Task::find($taskId);
            if ($task) {
                // Attach users in the team to this task
                $task->users()->syncWithoutDetaching($teamUserIds);
            }
        }

        $this->selectedTasks = [];
        $this->showAssignTaskModal = false;

        session()->flash('success', 'Tasks assigned successfully!');
    }

    public function removeMember($userId)
    {
        $this->team->users()->detach($userId);
        $this->team->load(['users.projects.client', 'users.projects.tasks.project', 'projects.client', 'projects.tasks.project', 'clients']);

        session()->flash('success', 'Team member removed successfully!');
    }

    public function removeClient($clientId)
    {
        $this->team->clients()->detach($clientId);
        $this->team->load(['users.projects.client', 'users.projects.tasks.project', 'projects.client', 'projects.tasks.project', 'clients']);

        session()->flash('success', 'Client removed successfully!');
    }

    public function removeProject($projectId)
    {
        $this->team->projects()->detach($projectId);
        $this->team->load(['users.projects.client', 'users.projects.tasks.project', 'projects.client', 'projects.tasks.project', 'clients']);

        session()->flash('success', 'Project removed successfully!');
    }

    public function cancelAssignMember()
    {
        $this->selectedUsers = [];
        $this->showAssignMemberModal = false;
    }

    public function cancelAssignClient()
    {
        $this->selectedClients = [];
        $this->showAssignClientModal = false;
    }

    public function cancelAssignProject()
    {
        $this->selectedProjects = [];
        $this->showAssignProjectModal = false;
    }

    public function cancelAssignTask()
    {
        $this->selectedTasks = [];
        $this->showAssignTaskModal = false;
    }

    public function updatedShowAssignMemberModal($value)
    {
        if (!$value) {
            $this->selectedUsers = [];
        }
    }

    public function updatedShowAssignClientModal($value)
    {
        if (!$value) {
            $this->selectedClients = [];
        }
    }

    public function updatedShowAssignProjectModal($value)
    {
        if (!$value) {
            $this->selectedProjects = [];
        }
    }

    public function updatedShowAssignTaskModal($value)
    {
        if (!$value) {
            $this->selectedTasks = [];
        }
    }

    public function render()
    {
        // Ensure all relationships are properly loaded with nested relationships
        $this->team->loadMissing([
            'users.projects.client',
            'users.projects.tasks.project',
            'projects.client',
            'projects.tasks.project',
            'clients'
        ]);

        return view('livewire.teams.team-show', [
            'team' => $this->team
        ]);
    }
}
