<?php

declare(strict_types=1);

namespace App\Actions\Notifications;

use App\Models\Notification;
use App\Models\User;

final class CreateNotification
{
    public function execute(User $user, string $type, string $message, array $data = []): Notification
    {
        return Notification::create([
            'user_id' => $user->id,
            'type' => $type,
            'message' => $message,
            'data' => $data,
        ]);
    }
}
