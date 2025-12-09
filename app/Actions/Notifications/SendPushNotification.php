<?php

declare(strict_types=1);

namespace App\Actions\Notifications;

use App\Jobs\SendPushNotification as SendPushJob;
use App\Models\Notification;
use App\Models\User;
use Exception;
use Illuminate\Support\Facades\Bus;
use Illuminate\Support\Facades\Log;

final class SendPushNotification
{
    public function execute(User $user, Notification $notification): void
    {
        try {
            Bus::dispatch(new SendPushJob($user, $notification));
            $notification->update(['push_sent_at' => now()]);
        } catch (Exception $exception) {
            Log::error('Failed to send push notification: '.$exception->getMessage());
        }
    }
}
