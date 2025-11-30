<?php

use App\Models\FileAttachment;

it('to array', function () {
    $fileAttachment = FileAttachment::factory()->create()->refresh();

    expect(array_keys($fileAttachment->toArray()))->toBe([
        'id',
        'filename',
        'original_name',
        'mime_type',
        'size',
        'attachable_type',
        'attachable_id',
        'user_id',
        'created_at',
        'updated_at',
    ]);
});