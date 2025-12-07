<?php

declare(strict_types=1);

test('worker skills component class exists', function () {
    $componentClass = App\Livewire\Workers\WorkerSkills::class;
    expect(class_exists($componentClass))->toBeTrue();
});
