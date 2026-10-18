<?php

declare(strict_types=1);

namespace App\Events;

use App\Models\Client;
use App\Models\User;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

final class ClientAddedNotification
{
    use Dispatchable;
    use SerializesModels;

    /**
     * Create a new event instance.
     */
    public function __construct(public Client $client, public User $user) {}
}
