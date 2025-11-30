<?php

use App\Models\ClientAttachment;

it('to array', function () {
    $clientAttachment = ClientAttachment::factory()->create()->refresh();

    expect(array_keys($clientAttachment->toArray()))->toBe([
        'id',
        'client_id',
        'name',
        'path',
        'mime_type',
        'size',
        'type',
        'description',
        'uploaded_by',
        'uploaded_at',
        'created_at',
        'updated_at',
    ]);
});