<?php

namespace App\Listeners;

use App\Events\ProjectUpdatedNotification as ProjectUpdatedEvent;
use App\Services\NotificationService;

class SendProjectUpdatedNotification
{
    protected $notificationService;

    public function __construct(NotificationService $notificationService)
    {
        $this->notificationService = $notificationService;
    }

    public function handle(ProjectUpdatedEvent $event): void
    {
        $this->notificationService->notifyProjectUpdated(
            $event->project,
            $event->user
        );
    }
}