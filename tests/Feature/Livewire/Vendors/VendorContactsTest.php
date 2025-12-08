<?php declare(strict_types=1);

use App\Livewire\Vendors\VendorContacts;

test('vendor contacts component class exists', function () {
    $componentClass = VendorContacts::class;
    expect(class_exists($componentClass))->toBeTrue();
});
