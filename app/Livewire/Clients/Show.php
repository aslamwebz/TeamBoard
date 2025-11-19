<?php

namespace App\Livewire\Clients;

use App\Models\Client;
use App\Models\Project;
use Livewire\Component;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;

#[Layout('components.layouts.app')]
#[Title('View Client')]
class Show extends Component
{
    public Client $client;
    public $showAssignProjectModal = false;
    public $selectedProjectId = null;
    public $availableProjects = [];

    public function mount(Client $client)
    {
        $this->client = $client;
        $this->loadAvailableProjects();
    }

    public function loadAvailableProjects()
    {
        // Load projects that are not already assigned to this client
        $projects = Project::where(function($query) {
                $query->whereNull('client_id')
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

    public function assignProject()
    {
        if ($this->selectedProjectId) {
            $project = Project::find($this->selectedProjectId);
            if ($project) {
                $project->update(['client_id' => $this->client->id]);

                // Refresh the available projects list
                $this->loadAvailableProjects();

                $this->showAssignProjectModal = false;
                $this->selectedProjectId = null;

                // Refresh the component to update the UI
                $this->dispatch('$refresh');
            }
        }
    }

    public function unassignProject($projectId)
    {
        $project = Project::find($projectId);
        if ($project && $project->client_id == $this->client->id) {
            $project->update(['client_id' => null]);

            // Refresh the available projects list
            $this->loadAvailableProjects();

            // Refresh the component to update the UI
            $this->dispatch('$refresh');
        }
    }

    public function render()
    {
        return view('livewire.clients.show');
    }
}