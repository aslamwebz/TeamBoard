<?php

use Livewire\Livewire;

test('can instantiate contact list component', function () {
    $this->actingAs($this->user);
    Livewire::test(\App\Livewire\Clients\ContactList::class)
        ->assertStatus(200);
});