<?php

declare(strict_types=1);

namespace App\Policies;

use App\Models\User;

final class UserPolicy
{
    public function viewAny(User $user): bool
    {
        return $user->hasRole(['admin', 'manager']) || $user->hasPermissionTo('view users');
    }

    public function view(User $user, User $model): bool
    {
        return $user->id === $model->id || $user->hasRole(['admin', 'manager']);
    }

    public function create(User $user): bool
    {
        return $user->hasRole(['admin', 'manager']);
    }

    public function update(User $user, User $model): bool
    {
        return $user->hasRole('admin') || ($user->hasRole('manager') && ! $model->hasRole('admin'));
    }

    public function delete(User $user, User $model): bool
    {
        // Admin cannot delete themselves, and only admins can delete users
        return $user->hasRole('admin') && $user->id !== $model->id;
    }
}
