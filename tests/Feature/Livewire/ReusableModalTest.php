<?php

test('reusable modal component class exists', function () {
    $componentClass = \App\Livewire\ReusableModal::class;
    expect(class_exists($componentClass))->toBeTrue();
});