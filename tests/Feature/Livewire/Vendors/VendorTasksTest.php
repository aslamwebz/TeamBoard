<?php

declare(strict_types=1);

use App\Livewire\Vendors\VendorTasks;

test('vendor tasks component class exists', function () {
    $componentClass = VendorTasks::class;
    expect(class_exists($componentClass))->toBeTrue();
});
