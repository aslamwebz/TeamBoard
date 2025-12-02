<?php

declare(strict_types=1);

namespace App\Events;

use App\Models\Client;
use App\Models\User;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

final class ClientAddedNotification
{
    use Dispatchable, SerializesModels;

    public $client;

    public $user;

    /**
     * Create a new event instance.
     */
    public function __construct(Client $client, User $user)
    {
        $this->client = $client;
        $this->user = $user;
    }
}
