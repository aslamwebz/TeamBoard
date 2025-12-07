<?php

declare(strict_types=1);

use Livewire\Livewire;

test('can instantiate discussion activity feed component', function () {
    $this->actingAs($this->user);
    Livewire::test(App\Livewire\Discussions\ActivityFeed::class)
        ->assertStatus(200);
});
