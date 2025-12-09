<?php

declare(strict_types=1);

namespace App\Events;

use App\Models\Invoice;
use App\Models\User;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

final class NewInvoiceNotification
{
    use Dispatchable;
    use SerializesModels;
    /**
     * Create a new event instance.
     */
    public function __construct(public Invoice $invoice, public User $user)
    {
        // This should be the user receiving the notification
    }
}
