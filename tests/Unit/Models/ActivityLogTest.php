<?php

use App\Models\ActivityLog;

it('to array', function () {
    $activityLog = ActivityLog::factory()->create()->refresh();

    expect(array_keys($activityLog->toArray()))->toBe([
        'id',
        'action',
        'description',
        'type',
        'type_id',
        'user_id',
        'metadata',
        'created_at',
        'updated_at',
    ]);
});
