<?php

declare(strict_types=1);

namespace App\Actions\Notifications;

use App\Models\Notification;
use App\Models\User;
use App\Notifications\GenericNotification;
use Exception;
use Illuminate\Support\Facades\Log;

final class SendEmailNotification
{
    public function execute(User $user, Notification $notification): void
    {
        try {
            $user->notify(new GenericNotification($notification));
            $notification->update(['email_sent_at' => now()]);
        } catch (Exception $exception) {
            Log::error('Failed to send email notification: '.$exception->getMessage());
        }
    }
}
