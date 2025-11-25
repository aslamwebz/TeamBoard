<?php

namespace App\Listeners;

use App\Events\MentionedInCommentNotification as MentionedInCommentEvent;
use App\Services\NotificationService;

class SendMentionedInCommentNotification
{
    protected $notificationService;

    public function __construct(NotificationService $notificationService)
    {
        $this->notificationService = $notificationService;
    }

    public function handle(MentionedInCommentEvent $event): void
    {
        $this->notificationService->notifyMentionedInComment(
            $event->comment,
            $event->mentionedUser,
            $event->mentioningUser
        );
    }
}