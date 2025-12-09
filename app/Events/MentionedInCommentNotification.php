<?php

declare(strict_types=1);

namespace App\Events;

use App\Models\Comment;
use App\Models\User;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

final class MentionedInCommentNotification
{
    use Dispatchable;
    use SerializesModels;
    /**
     * Create a new event instance.
     */
    public function __construct(public $comment, public User $mentionedUser, public User $mentioningUser)
    {
    }
}
