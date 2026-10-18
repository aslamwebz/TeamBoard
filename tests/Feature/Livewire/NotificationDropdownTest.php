<?php

declare(strict_types=1);

use App\Livewire\NotificationDropdown;
use Livewire\Livewire;

test('can instantiate notification dropdown component', function () {
    $this->actingAs($this->user);
    Livewire::test(NotificationDropdown::class)
        ->assertStatus(200);
});
