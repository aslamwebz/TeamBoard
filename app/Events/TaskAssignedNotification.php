<?php

declare(strict_types=1);

namespace App\Events;

use App\Models\Task;
use App\Models\User;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

final class TaskAssignedNotification
{
    use Dispatchable;
    use SerializesModels;

    /**
     * Create a new event instance.
     */
    public function __construct(public Task $task, public User $assignedUser, public User $assigner) {}
}
