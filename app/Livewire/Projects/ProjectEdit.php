<?php

declare(strict_types=1);

namespace App\Livewire\Projects;

use App\Models\Project;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Component;

#[Layout('components.layouts.app')]
#[Title('Edit Project')]
final class ProjectEdit extends Component
{
    public Project $project;

    public $name;

    public $description;

    public $status;

    public $due_date;

    public function mount(Project $project): void
    {
        $this->project = $project;
        $this->name = $project->name;
        $this->description = $project->description;
        $this->status = $project->status;
        $this->due_date = $project->due_date;
    }

    public function updateProject(): RedirectResponse
    {
        $validatedData = $this->validate();

        $this->project->update($validatedData);

        // Dispatch notification when project is updated
        \App\Events\ProjectUpdatedNotification::dispatch($this->project, Auth::user());

        session()->flash('message', 'Project updated successfully.');

        return redirect()->route('projects');
    }

    public function render(): View
    {
        return view('livewire.projects.project-edit');
    }
}
