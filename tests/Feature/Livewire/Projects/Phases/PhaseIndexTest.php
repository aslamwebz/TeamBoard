<?php

declare(strict_types=1);

use App\Livewire\Projects\Phases\PhaseIndex;

test('phase index component class exists', function () {
    $componentClass = PhaseIndex::class;
    expect(class_exists($componentClass))->toBeTrue();
});
