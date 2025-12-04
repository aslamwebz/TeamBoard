<?php

test('vendor services component class exists', function () {
    $componentClass = \App\Livewire\Vendors\VendorServices::class;
    expect(class_exists($componentClass))->toBeTrue();
});