<?php

declare(strict_types=1);

namespace App\Policies;

use App\Models\Timesheet;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class TimesheetPolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): bool
    {
        return $user->hasRole(['admin', 'manager']) || $user->hasWorkerProfile();
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, Timesheet $timesheet): bool
    {
        if ($user->hasRole(['admin', 'manager'])) {
            return true;
        }

        return $user->workerProfile?->id === $timesheet->worker_profile_id;
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        return $user->hasRole(['admin', 'manager']) || $user->hasWorkerProfile();
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, Timesheet $timesheet): bool
    {
        if ($user->hasRole(['admin', 'manager'])) {
            return true;
        }

        // Users can only edit their own timesheets if they are not approved yet
        return $user->workerProfile?->id === $timesheet->worker_profile_id 
            && $timesheet->status !== 'approved';
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, Timesheet $timesheet): bool
    {
        if ($user->hasRole(['admin', 'manager'])) {
            return true;
        }

        return $user->workerProfile?->id === $timesheet->worker_profile_id
            && $timesheet->status !== 'approved';
    }
}
