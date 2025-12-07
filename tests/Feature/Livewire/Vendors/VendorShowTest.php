<?php

declare(strict_types=1);

test('vendor show component class exists', function () {
    $componentClass = App\Livewire\Vendors\VendorShow::class;
    expect(class_exists($componentClass))->toBeTrue();
});
