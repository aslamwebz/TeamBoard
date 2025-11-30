<?php

use App\Models\Contact;

it('to array', function () {
    $contact = Contact::factory()->create()->refresh();

    $expectedKeys = [
        'id',
        'first_name',
        'last_name',
        'email',
        'phone',
        'position',
        'job_title',
        'department',
        'work_phone',
        'mobile_phone',
        'linkedin_url',
        'twitter_handle',
        'notes',
        'is_primary',
        'is_billing_contact',
        'is_technical_contact',
        'communication_preferences',
        'client_id',
        'created_at',
        'updated_at',
    ];

    $actualKeys = array_keys($contact->toArray());

    foreach ($expectedKeys as $key) {
        expect($actualKeys)->toContain($key);
    }
});