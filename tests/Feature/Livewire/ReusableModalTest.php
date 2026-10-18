<?php

declare(strict_types=1);

use App\Livewire\ReusableModal;

test('reusable modal component class exists', function () {
    $componentClass = ReusableModal::class;
    expect(class_exists($componentClass))->toBeTrue();
});
