<?php declare(strict_types=1);

use App\Livewire\Projects\Milestones\MilestoneIndex;

test('milestone index component class exists', function () {
    $componentClass = MilestoneIndex::class;
    expect(class_exists($componentClass))->toBeTrue();
});
