<?php

namespace App\Observers;

use App\Models\Task;

class TaskObserver
{
    /**
     * Handle the Task "updated" event.
     */
    public function updated(Task $task): void
    {
        // If the task has a phase, update the phase's status based on its tasks
        if ($task->project_phase_id) {
            $phase = $task->phase;
            if ($phase) {
                $phase->updateStatusFromTasks();
            }
        }
    }

    /**
     * Handle the Task "created" event.
     */
    public function created(Task $task): void
    {
        // If the task has a phase, update the phase's status based on its tasks
        if ($task->project_phase_id) {
            $phase = $task->phase;
            if ($phase) {
                $phase->updateStatusFromTasks();
            }
        }
    }

    /**
     * Handle the Task "deleted" event.
     */
    public function deleted(Task $task): void
    {
        // If the task had a phase, update the phase's status based on its remaining tasks
        if ($task->project_phase_id) {
            $phase = $task->phase;
            if ($phase) {
                $phase->updateStatusFromTasks();
            }
        }
    }
}