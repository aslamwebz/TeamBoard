<?php

use App\Models\VendorService;

it('to array', function () {
    $vendorService = VendorService::factory()->create()->refresh();

    expect(array_keys($vendorService->toArray()))->toBe([
        'id',
        'vendor_id',
        'name',
        'category',
        'description',
        'unit_price',
        'unit_of_measure',
        'is_active',
        'created_at',
        'updated_at',
    ]);
});