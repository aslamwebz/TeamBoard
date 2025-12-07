<?php

declare(strict_types=1);

test('milestone index component class exists', function () {
    $componentClass = App\Livewire\Projects\Milestones\MilestoneIndex::class;
    expect(class_exists($componentClass))->toBeTrue();
});
