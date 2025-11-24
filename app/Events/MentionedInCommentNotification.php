<?php

namespace App\Events;

use App\Models\Comment;
use App\Models\User;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class MentionedInCommentNotification
{
    use Dispatchable, SerializesModels;

    public $comment;
    public $mentionedUser;
    public $mentioningUser;

    /**
     * Create a new event instance.
     */
    public function __construct($comment, User $mentionedUser, User $mentioningUser)
    {
        $this->comment = $comment; // Could be any model type (not just Comment)
        $this->mentionedUser = $mentionedUser;
        $this->mentioningUser = $mentioningUser;
    }
}