<?php

namespace App\Listeners;

use App\Events\TaskAssignedNotification as TaskAssignedEvent;
use App\Models\Notification as NotificationModel;
use App\Services\NotificationService;

class SendTaskAssignedNotification
{
    protected $notificationService;

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