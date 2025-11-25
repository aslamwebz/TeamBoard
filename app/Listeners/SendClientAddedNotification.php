<?php

namespace App\Listeners;

use App\Events\ClientAddedNotification as ClientAddedEvent;
use App\Services\NotificationService;

class SendClientAddedNotification
{
    protected $notificationService;

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