<?php

declare(strict_types=1);

namespace App\Listeners;

use App\Events\ProjectUpdatedNotification as ProjectUpdatedEvent;
use App\Services\NotificationService;

final readonly class SendProjectUpdatedNotification
{
    public function __construct(private \App\Services\NotificationService $notificationService)
    {
    }

    public function handle(ProjectUpdatedEvent $event): void
    {
        $this->notificationService->notifyProjectUpdated(
            $event->project,
            $event->user
        );
    }
}
