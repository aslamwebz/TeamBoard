<?php

use Livewire\Livewire;

test('can instantiate navigation handler component', function () {
    $this->actingAs($this->user);
    Livewire::test(\App\Livewire\NavigationHandler::class)
        ->assertStatus(200);
});