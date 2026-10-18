<?php

declare(strict_types=1);

namespace App\Notifications;

use Illuminate\Notifications\Notification;

final class DatabaseNotificationChannel extends Notification
{
    public $type;

    public $message;

    public $data;

    public function via($notifiable): array
    {
        return ['database'];
    }

    public function toDatabase($notifiable): array
    {
        return [
            'type' => $this->type,
            'message' => $this->message,
            'data' => $this->data ?? [],
        ];
    }
}
