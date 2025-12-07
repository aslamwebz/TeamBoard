<?php

declare(strict_types=1);

test('vendor projects component class exists', function () {
    $componentClass = App\Livewire\Vendors\VendorProjects::class;
    expect(class_exists($componentClass))->toBeTrue();
});
