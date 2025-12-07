<?php

declare(strict_types=1);

test('reusable modal component class exists', function () {
    $componentClass = App\Livewire\ReusableModal::class;
    expect(class_exists($componentClass))->toBeTrue();
});
