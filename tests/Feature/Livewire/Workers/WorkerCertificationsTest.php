<?php

declare(strict_types=1);

test('worker certifications component class exists', function () {
    $componentClass = App\Livewire\Workers\WorkerCertifications::class;
    expect(class_exists($componentClass))->toBeTrue();
});
