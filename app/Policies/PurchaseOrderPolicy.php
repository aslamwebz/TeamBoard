<?php

declare(strict_types=1);

namespace App\Policies;

use App\Models\PurchaseOrder;
use App\Models\User;

final class PurchaseOrderPolicy
{
    public function viewAny(User $user): bool
    {
        return $user->hasRole(['admin', 'manager', 'procurement']);
    }

    public function view(User $user, PurchaseOrder $purchaseOrder): bool
    {
        return $user->hasRole(['admin', 'manager', 'procurement']);
    }

    public function create(User $user): bool
    {
        return $user->hasRole(['admin', 'manager', 'procurement']);
    }

    public function update(User $user, PurchaseOrder $purchaseOrder): bool
    {
        return $user->hasRole(['admin', 'manager', 'procurement']);
    }

    public function delete(User $user, PurchaseOrder $purchaseOrder): bool
    {
        return $user->hasRole('admin');
    }
}
