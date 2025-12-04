<?php

use Livewire\Livewire;

test('can instantiate contact index component', function () {
    $this->actingAs($this->user);
    Livewire::test(\App\Livewire\Contacts\ContactIndex::class)
        ->assertStatus(200);
});