<?php

declare(strict_types=1);

namespace App\Livewire\Projects;

use App\Models\Project;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Component;

#[Layout('components.layouts.app')]
#[Title('Create Project')]
final class ProjectCreate extends Component
{
    public $name;

    public $description;

    public $status = 'planning';

    public $due_date;

    public function mount(): void
    {
        $this->authorize('create', Project::class);
    }

    public function createProject(): RedirectResponse
    {
        $this->authorize('create', Project::class);

        $validatedData = $this->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'status' => 'required|string|in:planning,in_progress,completed,on_hold',
            'due_date' => 'nullable|date',
        ]);

        Project::create($validatedData);

        session()->flash('message', 'Project created successfully.');

        return redirect()->route('projects');
    }

    public function render(): View
    {
        return view('livewire.projects.project-create');
    }
}
