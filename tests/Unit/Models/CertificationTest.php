<?php

use App\Models\Certification;

it('to array', function () {
    $certification = Certification::factory()->create()->refresh();
    
    expect(array_keys($certification->toArray()))->toBe([
        'id',
        'name',
        'issuing_organization',
        'license_number',
        'issue_date',
        'expiry_date',
        'credential_id',
        'credential_url',
        'description',
        'created_at',
        'updated_at',
    ]);
});
