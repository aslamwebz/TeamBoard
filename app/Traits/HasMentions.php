<?php

namespace App\Traits;

use App\Models\User;
use Illuminate\Support\Facades\Notification;
use Illuminate\Support\Str;

trait HasMentions
{
    /**
     * Parse mentions from content and return the mentioned users
     */
    public function parseMentions(string $content): array
    {
        $pattern = '/@(\w+)/';
        preg_match_all($pattern, $content, $matches);
        
        if (empty($matches[1])) {
            return [];
        }

        $mentionedUsernames = array_unique($matches[1]);
        $mentionedUsers = User::whereIn('name', $mentionedUsernames)->get();

        return $mentionedUsers->toArray();
    }

    /**
     * Replace mentions in content with links to user profiles
     */
    public function formatContentWithMentions(string $content): string
    {
        $pattern = '/@(\w+)/';
        
        return preg_replace_callback($pattern, function ($matches) {
            $username = $matches[1];
            $user = User::where('name', $username)->first();
            
            if ($user) {
                return "<a href='/users/{$user->id}' class='text-blue-600 hover:underline'>@{$username}</a>";
            }
            
            return $matches[0]; // Return original if user not found
        }, $content);
    }

    /**
     * Notify mentioned users
     */
    public function notifyMentionedUsers(string $content, User $author, string $type = 'comment', $relatedModel = null)
    {
        $mentionedUsers = collect($this->parseMentions($content));
        $mentionedUsers = $mentionedUsers->filter(function ($user) use ($author) {
            // Don't notify the author of the comment if they mentioned themselves
            return $user['id'] != $author->id;
        });

        foreach ($mentionedUsers as $user) {
            $userModel = User::find($user['id']);

            if ($userModel) {
                $this->createMentionNotification($userModel, $author, $content, $type, $relatedModel);
            }
        }
    }

    /**
     * Create notification for mentions
     */
    private function createMentionNotification(User $mentionedUser, User $author, string $content, string $type, $relatedModel = null)
    {
        // Create a notification for the mentioned user
        $notification = new \App\Models\Notification();
        $notification->user_id = $mentionedUser->id;
        $notification->type = 'mentioned_in_comment';
        $notification->message = "You were mentioned by {$author->name} in a {$type}";
        $notification->data = [
            'mentioned_by' => $author->id,
            'mentioned_by_name' => $author->name,
            'content' => $content,
            'type' => $type,
            'related_model_type' => $relatedModel ? class_basename($relatedModel) : null,
            'related_model_id' => $relatedModel?->id,
            'url' => $this->getMentionNotificationUrl($relatedModel, $type),
        ];
        $notification->save();

        // Also dispatch the event for real-time notifications
        \App\Events\MentionedInCommentNotification::dispatch($relatedModel, $mentionedUser, $author);
    }

    /**
     * Get URL for mention notification
     */
    private function getMentionNotificationUrl($relatedModel, string $type): string
    {
        if (!$relatedModel) {
            return '/';
        }

        $modelType = class_basename($relatedModel);

        switch ($modelType) {
            case 'Comment':
                // If comment, try to get the discussion it belongs to
                if (isset($relatedModel->discussion_id)) {
                    return route('discussions.show', ['discussion' => $relatedModel->discussion_id]);
                }
                break;
            case 'Task':
                return route('tasks.show', ['task' => $relatedModel->id]);
            case 'Project':
                return route('projects.show', ['project' => $relatedModel->id]);
            case 'Discussion':
                return route('discussions.show', ['discussion' => $relatedModel->id]);
        }

        return '/';
    }
}