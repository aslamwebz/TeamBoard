<?php declare(strict_types=1);

namespace App\Livewire\Users;

use App\Models\Client;
use App\Models\Project;
use App\Models\Task;
use App\Models\User;
use Livewire\Component;

class UserEdit extends Component
{
    public $user;
    public $name;
    public $email;
    public $selectedProjects = [];
    public $selectedTasks = [];
    public $selectedClients = [];
    public $projects;
    public $tasks;
    public $clients;
    public $processing = false;

    protected function rules()
    {
        return [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users,email,' . $this->user->id],
        ];
    }

    public function mount(User $user)
    {
        $this->user = $user;
        $this->name = $user->name;
        $this->email = $user->email;

        // Load all available assignments
        $this->projects = Project::orderBy('name')->get();
        $this->tasks = Task::with('project')->orderBy('title')->get();
        $this->clients = Client::orderBy('name')->get();

        // Set currently selected assignments
        $this->selectedProjects = $user->projects()->pluck('project_id')->toArray();
        $this->selectedTasks = $user->tasks()->pluck('task_id')->toArray();
        $this->selectedClients = $user->clients()->pluck('client_id')->toArray();
    }

    public function updateUser()
    {
        $this->processing = true;

        $this->validate();

        // Update user info
        $this->user->update([
            'name' => $this->name,
            'email' => $this->email,
        ]);

        // Sync project assignments
        $this->user->projects()->sync($this->selectedProjects);

        // Sync task assignments
        $this->user->tasks()->sync($this->selectedTasks);

        // Sync client assignments
        $this->user->clients()->sync($this->selectedClients);

        session()->flash('message', 'User updated successfully.');

        return $this->redirect('/users', navigate: true);
    }

    public function render()
    {
        return view('livewire.users.user-edit');
    }
}
