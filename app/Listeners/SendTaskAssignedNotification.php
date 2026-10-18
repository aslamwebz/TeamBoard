<?php

declare(strict_types=1);

namespace App\Listeners;

use App\Events\TaskAssignedNotification as TaskAssignedEvent;
use App\Services\NotificationService;

final readonly class SendTaskAssignedNotification
{
    public function __construct(private NotificationService $notificationService) {}

    public function handle(TaskAssignedEvent $event): void
    {
        $this->notificationService->notifyTaskAssigned(
            $event->task,
            $event->assignedUser,
            $event->assigner
        );
    }
}
