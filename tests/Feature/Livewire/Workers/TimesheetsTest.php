<?php

declare(strict_types=1);

test('worker timesheets component class exists', function () {
    $componentClass = App\Livewire\Workers\Timesheets::class;
    expect(class_exists($componentClass))->toBeTrue();
});
