<?php

use Livewire\Livewire;

test('can instantiate files index component', function () {
    $this->actingAs($this->user);
    Livewire::test(\App\Livewire\Files\FilesIndex::class)
        ->assertStatus(200);
});