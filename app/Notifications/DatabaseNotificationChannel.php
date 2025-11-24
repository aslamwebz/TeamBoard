<?php

namespace App\Notifications;

use App\Models\Notification as ModelNotification;
use Illuminate\Notifications\Notification;

class DatabaseNotificationChannel extends Notification
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