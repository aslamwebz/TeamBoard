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

    public function createProject(): RedirectResponse
    {
        $validatedData = $this->validate();

        Project::create($validatedData);

        session()->flash('message', 'Project created successfully.');

        return redirect()->route('projects');
    }

    public function render(): View
    {
        return view('livewire.projects.project-create');
    }
}
