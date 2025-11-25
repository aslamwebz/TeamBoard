<?php

namespace App\Listeners;

use App\Events\TaskAssignedNotification;
use App\Events\NewInvoiceNotification;
use App\Events\ProjectUpdatedNotification;
use App\Events\MentionedInCommentNotification;
use App\Events\ClientAddedNotification;
use App\Events\PaymentFailedNotification;
use App\Services\NotificationService;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class SendNotificationListener
{
    protected $notificationService;

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

    protected function handleTaskAssigned(TaskAssignedNotification $event): void
    {
        $this->notificationService->notifyTaskAssigned(
            $event->task,
            $event->assignedUser,
            $event->assigner
        );
    }

    protected function handleNewInvoice(NewInvoiceNotification $event): void
    {
        $this->notificationService->notifyNewInvoice(
            $event->invoice,
            $event->user
        );
    }

    protected function handleProjectUpdated(ProjectUpdatedNotification $event): void
    {
        $this->notificationService->notifyProjectUpdated(
            $event->project,
            $event->user
        );
    }

    protected function handleMentionedInComment(MentionedInCommentNotification $event): void
    {
        $this->notificationService->notifyMentionedInComment(
            $event->comment,
            $event->mentionedUser,
            $event->mentioningUser
        );
    }

    protected function handleClientAdded(ClientAddedNotification $event): void
    {
        $this->notificationService->notifyClientAdded(
            $event->client,
            $event->user
        );
    }

    protected function handlePaymentFailed(PaymentFailedNotification $event): void
    {
        $this->notificationService->notifyPaymentFailed(
            $event->user,
            $event->paymentDetails ?? null
        );
    }
}
