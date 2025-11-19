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
        $this->availableProjects = Project::where(function($query) {
                $query->whereNull('client_id')
                      ->orWhere('client_id', '!=', $this->client->id);
            })
            ->orderBy('name')
            ->get()
            ->toArray();
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

                // This should trigger a re-render with updated data
                $this->dispatch('$refresh');
            }
        }
    }

    public function render()
    {
        return view('livewire.clients.show');
    }
}