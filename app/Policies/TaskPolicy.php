<?php

declare(strict_types=1);

namespace App\Policies;

use App\Models\Task;
use App\Models\User;

final class TaskPolicy
{
    public function viewAny(User $user): bool
    {
        return true;
    }

    public function view(User $user, Task $task): bool
    {
        if ($user->hasRole(['admin', 'manager'])) {
            return true;
        }

        if ($task->user_id === $user->id || $task->users->contains($user)) {
            return true;
        }

        return $task->project && ($task->project->users->contains($user) || $task->project->teams->intersect($user->teams)->isNotEmpty());
    }

    public function create(User $user): bool
    {
        return $user->hasRole(['admin', 'manager']);
    }

    public function update(User $user, Task $task): bool
    {
        if ($user->hasRole(['admin', 'manager'])) {
            return true;
        }

        return $task->user_id === $user->id || $task->users->contains($user);
    }

    public function delete(User $user, Task $task): bool
    {
        return $user->hasRole(['admin', 'manager']);
    }
}
