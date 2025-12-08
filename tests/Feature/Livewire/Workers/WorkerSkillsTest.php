<?php declare(strict_types=1);

use App\Livewire\Workers\WorkerSkills;

test('worker skills component class exists', function () {
    $componentClass = WorkerSkills::class;
    expect(class_exists($componentClass))->toBeTrue();
});
