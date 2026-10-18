<?php

declare(strict_types=1);

use App\Livewire\Workers\Timesheets;

test('worker timesheets component class exists', function () {
    $componentClass = Timesheets::class;
    expect(class_exists($componentClass))->toBeTrue();
});
