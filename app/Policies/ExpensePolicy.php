<?php

declare(strict_types=1);

namespace App\Policies;

use App\Models\Expense;
use App\Models\User;

final class ExpensePolicy
{
    public function viewAny(User $user): bool
    {
        return $user->hasRole(['admin', 'manager', 'accountant', 'employee']);
    }

    public function view(User $user, Expense $expense): bool
    {
        if ($user->hasRole(['admin', 'manager', 'accountant'])) {
            return true;
        }

        return $expense->user_id === $user->id;
    }

    public function create(User $user): bool
    {
        return $user->hasRole(['admin', 'manager', 'employee', 'worker', 'accountant']);
    }

    public function update(User $user, Expense $expense): bool
    {
        if ($user->hasRole(['admin', 'manager'])) {
            return true;
        }

        return $expense->user_id === $user->id && $expense->status === 'pending';
    }

    public function delete(User $user, Expense $expense): bool
    {
        if ($user->hasRole('admin')) {
            return true;
        }

        return $expense->user_id === $user->id && $expense->status === 'pending';
    }

    public function approve(User $user, Expense $expense): bool
    {
        return $user->hasRole(['admin', 'manager']);
    }
}
