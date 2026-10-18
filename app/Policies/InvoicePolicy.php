<?php

declare(strict_types=1);

namespace App\Policies;

use App\Models\Invoice;
use App\Models\User;

final class InvoicePolicy
{
    public function viewAny(User $user): bool
    {
        return $user->hasRole(['admin', 'manager', 'sales', 'accountant']);
    }

    public function view(User $user, Invoice $invoice): bool
    {
        if ($user->hasRole(['admin', 'manager', 'sales', 'accountant'])) {
            return true;
        }

        if ($user->hasRole('client') && $invoice->client_id) {
            return $user->clients->contains('id', $invoice->client_id);
        }

        return false;
    }

    public function create(User $user): bool
    {
        return $user->hasRole(['admin', 'manager', 'accountant']);
    }

    public function update(User $user, Invoice $invoice): bool
    {
        return $user->hasRole(['admin', 'manager', 'accountant']);
    }

    public function delete(User $user, Invoice $invoice): bool
    {
        return $user->hasRole('admin');
    }
}
