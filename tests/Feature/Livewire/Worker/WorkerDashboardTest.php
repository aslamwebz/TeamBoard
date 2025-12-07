<?php

declare(strict_types=1);

test('worker dashboard component class exists', function () {
    $componentClass = App\Livewire\Worker\WorkerDashboard::class;
    expect(class_exists($componentClass))->toBeTrue();
});
