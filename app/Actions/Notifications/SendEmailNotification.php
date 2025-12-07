<?php

declare(strict_types=1);

namespace App\Actions\Notifications;

use App\Models\Notification;
use App\Models\User;
use App\Notifications\GenericNotification;
use Exception;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;

final class SendEmailNotification
{
    public function execute(User $user, Notification $notification): void
    {
        try {
            Mail::to($user)->send(new GenericNotification($notification));
            $notification->update(['email_sent_at' => now()]);
        } catch (Exception $e) {
            Log::error('Failed to send email notification: '.$e->getMessage());
        }
    }
}
