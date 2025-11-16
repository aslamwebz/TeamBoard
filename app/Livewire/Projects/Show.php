<?php

namespace App\Livewire\Projects;

use App\Models\Project;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Component;

#[Layout('components.layouts.app')]
#[Title('Project Details')]
class Show extends Component
{
    public Project $project;

    public function mount(Project $project)
    {
        $this->project = $project->load(['client', 'invoices', 'tasks', 'users', 'teams']);
    }

    public function render()
    {
        return view('livewire.projects.show', [
            'project' => $this->project,
        ]);
    }
}
