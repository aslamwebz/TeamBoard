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
                $notificationData = [
                    'message' => "You were mentioned by {$author->name} in a {$type}",
                    'url' => $this->getMentionNotificationUrl($relatedModel, $type),
                    'author' => $author,
                    'type' => $type,
                ];

                // Create a notification record or send via your notification system
                // For now, we'll just create an activity log entry
                $this->createMentionActivityLog($userModel, $author, $content, $type, $relatedModel);
            }
        }
    }

    /**
     * Create activity log for mentions
     */
    private function createMentionActivityLog(User $mentionedUser, User $author, string $content, string $type, $relatedModel = null)
    {
        $activityData = [
            'action' => 'user_mentioned',
            'description' => "You were mentioned by {$author->name} in a {$type}",
            'user_id' => $mentionedUser->id,
            'metadata' => [
                'mentioned_by' => $author->id,
                'content' => $content,
                'type' => $type,
            ]
        ];

        if ($relatedModel) {
            $activityData['type'] = class_basename($relatedModel);
            $activityData['type_id'] = $relatedModel->id;
        }

        \App\Models\ActivityLog::create($activityData);
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
            case 'Task':
                return route('tasks.show', $relatedModel);
            case 'Project':
                return route('projects.show', $relatedModel);
            case 'Discussion':
                return route('discussions.show', $relatedModel);
            case 'Comment':
                // If comment, try to get the discussion it belongs to
                if (isset($relatedModel->discussion_id)) {
                    return route('discussions.show', $relatedModel->discussion_id);
                }
                break;
        }

        return '/';
    }
}