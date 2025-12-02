<?php

declare(strict_types=1);

namespace App\Listeners;

use App\Events\TaskAssignedNotification as TaskAssignedEvent;
use App\Services\NotificationService;

final class SendTaskAssignedNotification
{
    private $notificationService;

    public function __construct(NotificationService $notificationService)
    {
        $this->notificationService = $notificationService;
    }

    public function handle(TaskAssignedEvent $event): void
    {
        $this->notificationService->notifyTaskAssigned(
            $event->task,
            $event->assignedUser,
            $event->assigner
        );
    }
}
