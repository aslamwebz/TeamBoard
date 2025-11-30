<?php

use App\Models\Team;

it('to array', function () {
    $team = Team::create([
        'name' => 'Test Team',
        'description' => 'Test team description',
    ]);

    $expectedKeys = [
        'id',
        'name',
        'description',
        'created_at',
        'updated_at',
    ];

    $actualKeys = array_keys($team->toArray());

    foreach ($expectedKeys as $key) {
        expect($actualKeys)->toContain($key);
    }
});