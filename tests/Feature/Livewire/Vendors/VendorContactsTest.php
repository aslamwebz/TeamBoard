<?php

declare(strict_types=1);

test('vendor contacts component class exists', function () {
    $componentClass = App\Livewire\Vendors\VendorContacts::class;
    expect(class_exists($componentClass))->toBeTrue();
});
