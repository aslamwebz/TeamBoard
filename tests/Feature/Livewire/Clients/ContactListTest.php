<?php declare(strict_types=1);

use App\Livewire\Clients\ContactList;
use Livewire\Livewire;

test('can instantiate contact list component', function () {
    $this->actingAs($this->user);
    Livewire::test(ContactList::class)
        ->assertStatus(200);
});
