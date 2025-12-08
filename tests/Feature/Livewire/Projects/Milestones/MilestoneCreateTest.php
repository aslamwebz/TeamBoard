<?php declare(strict_types=1);

use App\Livewire\Projects\Milestones\MilestoneCreate;

test('milestone create component class exists', function () {
    $componentClass = MilestoneCreate::class;
    expect(class_exists($componentClass))->toBeTrue();
});
