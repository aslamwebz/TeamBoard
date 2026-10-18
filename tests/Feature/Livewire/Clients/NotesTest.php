<?php

declare(strict_types=1);

use App\Livewire\Clients\Notes;
use Livewire\Livewire;

test('can instantiate client notes component', function () {
    $this->actingAs($this->user);
    Livewire::test(Notes::class)
        ->assertStatus(200);
});
