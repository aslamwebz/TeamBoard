<?php

use App\Models\ContactActivity;

it('to array', function () {
    $contactActivity = ContactActivity::factory()->create()->refresh();

    expect(array_keys($contactActivity->toArray()))->toBe([
        'id',
        'contact_id',
        'type',
        'description',
        'details',
        'activity_date',
        'created_by',
        'created_at',
        'updated_at',
    ]);
});