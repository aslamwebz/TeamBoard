<?php

test('vendor show component class exists', function () {
    $componentClass = \App\Livewire\Vendors\VendorShow::class;
    expect(class_exists($componentClass))->toBeTrue();
});