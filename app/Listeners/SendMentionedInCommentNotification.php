<?php

declare(strict_types=1);

namespace App\Listeners;

use App\Events\MentionedInCommentNotification as MentionedInCommentEvent;
use App\Services\NotificationService;

final class SendMentionedInCommentNotification
{
    private $notificationService;

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
