<?php

declare(strict_types=1);

use App\Livewire\Dashboard;
use Livewire\Livewire;

test('can instantiate dashboard component', function () {
    $this->actingAs($this->user);
    Livewire::test(Dashboard::class)
        ->assertStatus(200);
});
