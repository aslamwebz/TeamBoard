<?php

use App\Models\VendorContact;

it('to array', function () {
    $vendorContact = VendorContact::factory()->create()->refresh();

    expect(array_keys($vendorContact->toArray()))->toBe([
        'id',
        'vendor_id',
        'first_name',
        'last_name',
        'email',
        'phone',
        'position',
        'is_primary',
        'created_at',
        'updated_at',
    ]);
});