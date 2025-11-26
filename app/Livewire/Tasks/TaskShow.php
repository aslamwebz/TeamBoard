<?php

namespace App\Livewire\Tasks;

use App\Models\Task;
use Illuminate\Contracts\View\View;
use Livewire\Component;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;

#[Layout('components.layouts.app')]
#[Title('Task Details')]
class TaskShow extends Component
{
    public Task $task;

    public function mount(Task $task) : void
    {
        $this->task = $task->load(['project', 'user', 'phase']);
    }

    public function render() : View
    {
        return view('livewire.tasks.task-show');
    }
}