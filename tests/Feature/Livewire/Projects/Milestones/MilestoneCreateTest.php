<?php

test('milestone create component class exists', function () {
    $componentClass = \App\Livewire\Projects\Milestones\MilestoneCreate::class;
    expect(class_exists($componentClass))->toBeTrue();
});