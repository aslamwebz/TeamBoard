<?php declare(strict_types=1);

namespace App\Livewire\Tasks;

use App\Models\Task;
use Illuminate\Contracts\View\View;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Component;

#[Layout('components.layouts.app')]
#[Title('Task Details')]
final class TaskShow extends Component
{
    public Task $task;
    public $taskDiscussions = [];

    public function mount(Task $task): void
    {
        $this->task = $task->load(['project', 'user', 'phase']);

        // Load related discussions for this task
        $this->taskDiscussions = \App\Models\Discussion::where('type', 'task')
            ->where('type_id', $task->id)
            ->latest()
            ->limit(5)
            ->get();
    }

    public function render(): View
    {
        return view('livewire.tasks.task-show', [
            'dependents' => $this->getTaskDependents(),
        ]);
    }

    public function getTaskDependents()
    {
        return $this->task->getTaskDependents();
    }

    public function getTaskStatusBadgeClass(string $status): string
    {
        $taskStatus = \App\Enums\TaskStatus::tryFrom($status);
        if ($taskStatus) {
            return $taskStatus->getSimpleColorClass() ?: $taskStatus->getColorClass();
        }

        return 'text-zinc-800 dark:text-zinc-300';
    }
}
