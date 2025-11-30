<?php

use App\Models\Skill;

it('to array', function () {
    $skill = Skill::factory()->create()->refresh();

    expect(array_keys($skill->toArray()))->toBe([
        'id',
        'name',
        'category',
        'description',
        'created_at',
        'updated_at',
    ]);
});