<?php

declare(strict_types=1);

test('milestone create component class exists', function () {
    $componentClass = App\Livewire\Projects\Milestones\MilestoneCreate::class;
    expect(class_exists($componentClass))->toBeTrue();
});
