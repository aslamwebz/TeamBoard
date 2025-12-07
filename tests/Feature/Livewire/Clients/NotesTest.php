<?php

declare(strict_types=1);

use Livewire\Livewire;

test('can instantiate client notes component', function () {
    $this->actingAs($this->user);
    Livewire::test(App\Livewire\Clients\Notes::class)
        ->assertStatus(200);
});
