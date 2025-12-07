<?php

declare(strict_types=1);

test('phase index component class exists', function () {
    $componentClass = App\Livewire\Projects\Phases\PhaseIndex::class;
    expect(class_exists($componentClass))->toBeTrue();
});
