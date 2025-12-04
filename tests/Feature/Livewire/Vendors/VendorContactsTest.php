<?php

test('vendor contacts component class exists', function () {
    $componentClass = \App\Livewire\Vendors\VendorContacts::class;
    expect(class_exists($componentClass))->toBeTrue();
});