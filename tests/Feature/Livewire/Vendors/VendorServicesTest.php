<?php declare(strict_types=1);

use App\Livewire\Vendors\VendorServices;

test('vendor services component class exists', function () {
    $componentClass = VendorServices::class;
    expect(class_exists($componentClass))->toBeTrue();
});
