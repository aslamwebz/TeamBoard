<?php

declare(strict_types=1);

namespace App\Listeners;

use App\Events\ClientAddedNotification;
use App\Events\MentionedInCommentNotification;
use App\Events\NewInvoiceNotification;
use App\Events\PaymentFailedNotification;
use App\Events\ProjectUpdatedNotification;
use App\Events\TaskAssignedNotification;
use App\Services\NotificationService;

final class SendNotificationListener
{
    private $notificationService;

    /**
     * Create the event listener.
     */
    public function __construct(NotificationService $notificationService)
    {
        $this->notificationService = $notificationService;
    }

    /**
     * Handle the event.
     */
    public function handle($event): void
    {
        if ($event instanceof TaskAssignedNotification) {
            $this->handleTaskAssigned($event);
        } elseif ($event instanceof NewInvoiceNotification) {
            $this->handleNewInvoice($event);
        } elseif ($event instanceof ProjectUpdatedNotification) {
            $this->handleProjectUpdated($event);
        } elseif ($event instanceof MentionedInCommentNotification) {
            $this->handleMentionedInComment($event);
        } elseif ($event instanceof ClientAddedNotification) {
            $this->handleClientAdded($event);
        } elseif ($event instanceof PaymentFailedNotification) {
            $this->handlePaymentFailed($event);
        }
    }

    private function handleTaskAssigned(TaskAssignedNotification $event): void
    {
        $this->notificationService->notifyTaskAssigned(
            $event->task,
            $event->assignedUser,
            $event->assigner
        );
    }

    private function handleNewInvoice(NewInvoiceNotification $event): void
    {
        $this->notificationService->notifyNewInvoice(
            $event->invoice,
            $event->user
        );
    }

    private function handleProjectUpdated(ProjectUpdatedNotification $event): void
    {
        $this->notificationService->notifyProjectUpdated(
            $event->project,
            $event->user
        );
    }

    private function handleMentionedInComment(MentionedInCommentNotification $event): void
    {
        $this->notificationService->notifyMentionedInComment(
            $event->comment,
            $event->mentionedUser,
            $event->mentioningUser
        );
    }

    private function handleClientAdded(ClientAddedNotification $event): void
    {
        $this->notificationService->notifyClientAdded(
            $event->client,
            $event->user
        );
    }

    private function handlePaymentFailed(PaymentFailedNotification $event): void
    {
        $this->notificationService->notifyPaymentFailed(
            $event->user,
            $event->paymentDetails ?? null
        );
    }
}
