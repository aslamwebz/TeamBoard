<?php declare(strict_types=1);

use App\Livewire\Worker\WorkerDashboard;

test('worker dashboard component class exists', function () {
    $componentClass = WorkerDashboard::class;
    expect(class_exists($componentClass))->toBeTrue();
});
