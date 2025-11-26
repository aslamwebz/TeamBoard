<?php

namespace App\Livewire\Tasks\Dependencies;

use App\Models\Task;
use Livewire\Component;

class Manage extends Component
{
    public Task $task;
    public $selectedDependencies = [];
    public $availableTasks = [];

    protected $listeners = ['refreshDependencies' => '$refresh'];

    public function mount(Task $task): void
    {
        $this->task = $task;
        $this->selectedDependencies = $task->dependencies ?? [];
        $this->availableTasks = $task->getPotentialDependencies();
    }

    public function updateDependencies(): void
    {
        $this->task->update(['dependencies' => $this->selectedDependencies]);
        $this->dispatch('dependenciesUpdated');
    }

    public function addDependency($taskId): void
    {
        if (!in_array($taskId, $this->selectedDependencies)) {
            $this->selectedDependencies[] = $taskId;
            $this->updateDependencies();
        }
    }

    public function removeDependency($taskId): void
    {
        $this->selectedDependencies = array_filter($this->selectedDependencies, function($id) use ($taskId) {
            return $id != $taskId;
        });
        $this->updateDependencies();
    }

    public function render(): \Illuminate\Contracts\View\View
    {
        $availableTasks = $this->availableTasks;
        $selectedDependencies = $this->selectedDependencies;
        return view('livewire.tasks.dependencies.manage', compact('availableTasks', 'selectedDependencies'));
    }
}