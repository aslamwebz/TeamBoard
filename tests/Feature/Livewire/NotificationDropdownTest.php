<?php

use Livewire\Livewire;

test('can instantiate notification dropdown component', function () {
    $this->actingAs($this->user);
    Livewire::test(\App\Livewire\NotificationDropdown::class)
        ->assertStatus(200);
});