<?php

test('phase index component class exists', function () {
    $componentClass = \App\Livewire\Projects\Phases\PhaseIndex::class;
    expect(class_exists($componentClass))->toBeTrue();
});