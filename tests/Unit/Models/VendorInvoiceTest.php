<?php

use App\Models\VendorInvoice;

it('to array', function () {
    $vendorInvoice = VendorInvoice::factory()->create()->refresh();

    $expectedKeys = [
        'id',
        'vendor_id',
        'invoice_number',
        'invoice_date',
        'due_date',
        'amount',
        'tax_amount',
        'total_amount',
        'status',
        'notes',
        'file_path',
        'paid_at',
        'payment_method',
        'project_id',
        'created_at',
        'updated_at',
    ];

    $actualKeys = array_keys($vendorInvoice->toArray());

    foreach ($expectedKeys as $key) {
        expect($actualKeys)->toContain($key);
    }
});