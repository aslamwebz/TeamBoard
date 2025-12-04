<?php

test('worker certifications component class exists', function () {
    $componentClass = \App\Livewire\Workers\WorkerCertifications::class;
    expect(class_exists($componentClass))->toBeTrue();
});