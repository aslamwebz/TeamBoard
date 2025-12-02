<?php

declare(strict_types=1);

namespace App\Listeners;

use App\Events\ClientAddedNotification as ClientAddedEvent;
use App\Services\NotificationService;

final class SendClientAddedNotification
{
    private $notificationService;

    public function __construct(NotificationService $notificationService)
    {
        $this->notificationService = $notificationService;
    }

    public function handle(ClientAddedEvent $event): void
    {
        $this->notificationService->notifyClientAdded(
            $event->client,
            $event->user
        );
    }
}
