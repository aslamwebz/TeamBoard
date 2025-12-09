<?php

declare(strict_types=1);

namespace App\Listeners;

use App\Events\ClientAddedNotification as ClientAddedEvent;
use App\Services\NotificationService;

final readonly class SendClientAddedNotification
{
    public function __construct(private \App\Services\NotificationService $notificationService)
    {
    }

    public function handle(ClientAddedEvent $event): void
    {
        $this->notificationService->notifyClientAdded(
            $event->client,
            $event->user
        );
    }
}
