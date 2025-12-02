<?php

declare(strict_types=1);

namespace App\Listeners;

use App\Events\ProjectUpdatedNotification as ProjectUpdatedEvent;
use App\Services\NotificationService;

final class SendProjectUpdatedNotification
{
    private $notificationService;

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
