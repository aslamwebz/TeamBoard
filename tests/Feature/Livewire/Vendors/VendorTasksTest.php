<?php

declare(strict_types=1);

test('vendor tasks component class exists', function () {
    $componentClass = App\Livewire\Vendors\VendorTasks::class;
    expect(class_exists($componentClass))->toBeTrue();
});
