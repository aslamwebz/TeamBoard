<?php

declare(strict_types=1);

namespace App\Services;

use App\Actions\Notifications\CreateNotification;
use App\Actions\Notifications\SendEmailNotification;
use App\Jobs\SendPushNotification;
use App\Models\Notification;
use App\Models\User;

final class NotificationService
{
    /**
     * Get unread notifications count for a user
     */
    public function getUnreadCount(User $user): int
    {
        return $user->notifications()->whereNull('read_at')->count();
    }

    /**
     * Get notifications for a user with pagination and filtering
     */
    public function getAllNotifications(User $user, int $limit = 15, string $filter = 'all')
    {
        $query = $user->notifications();

        if ($filter === 'unread') {
            $query = $query->whereNull('read_at');
        } elseif ($filter === 'read') {
            $query = $query->whereNotNull('read_at');
        }

        return $query->latest()->paginate($limit);
    }

    /**
     * Mark a notification as read
     */
    public function markAsRead(int $notificationId, int $userId): bool
    {
        $notification = Notification::where('id', $notificationId)
            ->where('user_id', $userId)
            ->first();

        if ($notification) {
            $notification->update(['read_at' => now()]);

            return true;
        }

        return false;
    }

    /**
     * Mark all notifications as read for a user
     */
    public function markAllAsRead(User $user): void
    {
        $user->notifications()
            ->whereNull('read_at')
            ->update(['read_at' => now()]);
    }

    /**
     * Create a notification
     */
    public function createNotification(
        User $user,
        string $type,
        string $message,
        array $data = [],
        bool $sendEmail = true,
        bool $sendPush = false
    ): Notification {
        $notification = (new CreateNotification())->execute($user, $type, $message, $data);

        // Optionally send email notification
        if ($sendEmail) {
            (new SendEmailNotification())->execute($user, $notification);
        }

        // Optionally send push notification
        if ($sendPush) {
            (new SendPushNotification())->execute($user, $notification);
        }

        return $notification;
    }

    /**
     * Send task assigned notification
     */
    public function notifyTaskAssigned($task, $assignedUser, $assigner): void
    {
        $this->createNotification(
            $assignedUser,
            'task_assigned',
            "You have been assigned to task: {$task->title}",
            [
                'task_id' => $task->id,
                'task_title' => $task->title,
                'assigner_name' => $assigner->name,
                'assigner_id' => $assigner->id,
                'project_id' => $task->project_id ?? null,
                'project_name' => $task->project->name ?? null,
            ]
        );
    }

    /**
     * Send new invoice notification
     */
    public function notifyNewInvoice($invoice, $user): void
    {
        $this->createNotification(
            $user,
            'new_invoice',
            "New invoice #{$invoice->id} has been created",
            [
                'invoice_id' => $invoice->id,
                'invoice_number' => $invoice->invoice_number ?? $invoice->id,
                'client_name' => $invoice->client->name ?? 'Unknown Client',
                'amount' => $invoice->total ?? $invoice->amount,
                'due_date' => $invoice->due_date?->format('M j, Y'),
            ]
        );
    }

    /**
     * Send project updated notification
     */
    public function notifyProjectUpdated($project, $user): void
    {
        $this->createNotification(
            $user,
            'project_updated',
            "Project '{$project->name}' has been updated",
            [
                'project_id' => $project->id,
                'project_name' => $project->name,
                'updated_by' => $user->name,
            ]
        );
    }

    /**
     * Send mentioned in comment notification
     */
    public function notifyMentionedInComment($comment, $mentionedUser, $mentioningUser): void
    {
        $this->createNotification(
            $mentionedUser,
            'mentioned_in_comment',
            "{$mentioningUser->name} mentioned you in a comment",
            [
                'comment_id' => $comment->id,
                'comment_content' => $comment->content,
                'commenter_name' => $mentioningUser->name,
                'discussion_id' => $comment->discussion_id,
                'discussion_title' => $comment->discussion?->title ?? 'Unknown Discussion',
            ]
        );
    }

    /**
     * Send client added notification
     */
    public function notifyClientAdded($client, $user): void
    {
        $this->createNotification(
            $user,
            'client_added',
            "New client '{$client->name}' has been added",
            [
                'client_id' => $client->id,
                'client_name' => $client->name,
                'added_by' => $user->name,
            ]
        );
    }

    /**
     * Send payment failed notification
     */
    public function notifyPaymentFailed($user, $details = null): void
    {
        $this->createNotification(
            $user,
            'payment_failed',
            'A payment has failed. Please check your billing information.',
            [
                'details' => $details,
            ]
        );
    }
}


