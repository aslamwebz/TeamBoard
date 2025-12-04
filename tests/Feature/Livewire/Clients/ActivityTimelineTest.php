<?php

use Livewire\Livewire;

test('can instantiate activity timeline component', function () {
    $this->actingAs($this->user);
    Livewire::test(\App\Livewire\Clients\ActivityTimeline::class)
        ->assertStatus(200);
});