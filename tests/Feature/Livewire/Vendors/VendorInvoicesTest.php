<?php

declare(strict_types=1);

use App\Livewire\Vendors\VendorInvoices;

test('vendor invoices component class exists', function () {
    $componentClass = VendorInvoices::class;
    expect(class_exists($componentClass))->toBeTrue();
});
