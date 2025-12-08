<?php declare(strict_types=1);

use App\Livewire\Projects\Phases\PhaseCreate;

test('phase create component class exists', function () {
    $componentClass = PhaseCreate::class;
    expect(class_exists($componentClass))->toBeTrue();
});
