<?php

declare(strict_types=1);

use App\Livewire\Vendors\VendorProjects;

test('vendor projects component class exists', function () {
    $componentClass = VendorProjects::class;
    expect(class_exists($componentClass))->toBeTrue();
});
