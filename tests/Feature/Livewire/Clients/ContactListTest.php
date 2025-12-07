<?php

declare(strict_types=1);

use Livewire\Livewire;

test('can instantiate contact list component', function () {
    $this->actingAs($this->user);
    Livewire::test(App\Livewire\Clients\ContactList::class)
        ->assertStatus(200);
});
