<?php

declare(strict_types=1);

namespace App\Policies;

use App\Models\Report;
use App\Models\User;

final class ReportPolicy
{
    public function viewAny(User $user): bool
    {
        return $user->hasRole(['admin', 'manager', 'accountant']);
    }

    public function view(User $user, Report $report): bool
    {
        return $user->hasRole(['admin', 'manager', 'accountant']);
    }

    public function create(User $user): bool
    {
        return $user->hasRole(['admin', 'manager', 'accountant']);
    }

    public function delete(User $user, Report $report): bool
    {
        return $user->hasRole('admin');
    }
}
