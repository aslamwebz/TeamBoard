<?php

use Livewire\Livewire;

test('can instantiate dashboard component', function () {
    $this->actingAs($this->user);
    Livewire::test(\App\Livewire\Dashboard::class)
        ->assertStatus(200);
});