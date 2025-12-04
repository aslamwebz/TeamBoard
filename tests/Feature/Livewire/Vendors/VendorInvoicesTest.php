<?php

test('vendor invoices component class exists', function () {
    $componentClass = \App\Livewire\Vendors\VendorInvoices::class;
    expect(class_exists($componentClass))->toBeTrue();
});