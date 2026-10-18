<?php

declare(strict_types=1);

use App\Livewire\Discussions\ActivityFeed;
use Livewire\Livewire;

test('can instantiate discussion activity feed component', function () {
    $this->actingAs($this->user);
    Livewire::test(ActivityFeed::class)
        ->assertStatus(200);
});
