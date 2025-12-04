<?php

use Livewire\Livewire;

test('can instantiate notification center component', function () {
    $this->actingAs($this->user);
    Livewire::test(\App\Livewire\NotificationCenter::class)
        ->assertStatus(200);
});