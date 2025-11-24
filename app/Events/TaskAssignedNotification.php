<?php

namespace App\Events;

use App\Models\Task;
use App\Models\User;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class TaskAssignedNotification
{
    use Dispatchable, SerializesModels;

    public $task;
    public $assignedUser;
    public $assigner;

    /**
     * Create a new event instance.
     */
    public function __construct(Task $task, User $assignedUser, User $assigner)
    {
        $this->task = $task;
        $this->assignedUser = $assignedUser;
        $this->assigner = $assigner;
    }
}
