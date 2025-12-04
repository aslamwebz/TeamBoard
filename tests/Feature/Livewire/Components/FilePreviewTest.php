<?php

use Livewire\Livewire;

test('can instantiate file preview component', function () {
    $this->actingAs($this->user);
    Livewire::test(\App\Livewire\Components\FilePreview::class)
        ->assertStatus(200);
});