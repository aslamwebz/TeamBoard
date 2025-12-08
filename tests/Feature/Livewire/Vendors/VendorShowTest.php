<?php declare(strict_types=1);

use App\Livewire\Vendors\VendorShow;

test('vendor show component class exists', function () {
    $componentClass = VendorShow::class;
    expect(class_exists($componentClass))->toBeTrue();
});
