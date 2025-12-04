<?php

use Livewire\Livewire;

test('can instantiate task dependencies component', function () {
    $this->actingAs($this->user);
    Livewire::test(\App\Livewire\Tasks\Dependencies\Manage::class)
        ->assertStatus(200);
});