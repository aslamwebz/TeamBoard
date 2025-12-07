<?php

declare(strict_types=1);

test('vendor invoices component class exists', function () {
    $componentClass = App\Livewire\Vendors\VendorInvoices::class;
    expect(class_exists($componentClass))->toBeTrue();
});
