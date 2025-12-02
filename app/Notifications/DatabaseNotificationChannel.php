<?php

declare(strict_types=1);

namespace App\Notifications;

use Illuminate\Notifications\Notification;

final class DatabaseNotificationChannel extends Notification
{
    public function via($notifiable)
    {
        return ['database'];
    }

    public function toDatabase($notifiable)
    {
        return [
            'type' => $this->type,
            'message' => $this->message,
            'data' => $this->data ?? [],
        ];
    }
}
