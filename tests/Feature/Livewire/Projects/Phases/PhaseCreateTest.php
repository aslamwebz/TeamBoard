<?php

test('phase create component class exists', function () {
    $componentClass = \App\Livewire\Projects\Phases\PhaseCreate::class;
    expect(class_exists($componentClass))->toBeTrue();
});