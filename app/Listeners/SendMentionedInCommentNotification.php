<?php

declare(strict_types=1);

namespace App\Listeners;

use App\Events\MentionedInCommentNotification as MentionedInCommentEvent;
use App\Services\NotificationService;

final readonly class SendMentionedInCommentNotification
{
    public function __construct(private \App\Services\NotificationService $notificationService)
    {
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
