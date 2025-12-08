<?php declare(strict_types=1);

use App\Livewire\Workers\WorkerCertifications;

test('worker certifications component class exists', function () {
    $componentClass = WorkerCertifications::class;
    expect(class_exists($componentClass))->toBeTrue();
});
