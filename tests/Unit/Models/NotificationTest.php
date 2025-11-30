<?php

use App\Models\Notification;

it('to array', function () {
    $notification = Notification::factory()->create()->refresh();

    expect(array_keys($notification->toArray()))->toBe([
        'id',
        'user_id',
        'type',
        'message',
        'data',
        'read_at',
        'email_sent_at',
        'push_sent_at',
        'created_at',
        'updated_at',
    ]);
});