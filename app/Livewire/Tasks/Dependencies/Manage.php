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

    public function mount(Task $task)
    {
        $this->task = $task;
        $this->selectedDependencies = $task->dependencies ?? [];
        $this->availableTasks = $task->getPotentialDependencies();
    }

    public function updateDependencies()
    {
        $this->task->update(['dependencies' => $this->selectedDependencies]);
        $this->dispatch('dependenciesUpdated');
    }

    public function addDependency($taskId)
    {
        if (!in_array($taskId, $this->selectedDependencies)) {
            $this->selectedDependencies[] = $taskId;
            $this->updateDependencies();
        }
    }

    public function removeDependency($taskId)
    {
        $this->selectedDependencies = array_filter($this->selectedDependencies, function($id) use ($taskId) {
            return $id != $taskId;
        });
        $this->updateDependencies();
    }

    public function render()
    {
        $availableTasks = $this->availableTasks;
        $selectedDependencies = $this->selectedDependencies;
        return view('livewire.tasks.dependencies.manage', compact('availableTasks', 'selectedDependencies'));
    }
}