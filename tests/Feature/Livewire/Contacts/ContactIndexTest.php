<?php declare(strict_types=1);

use App\Livewire\Contacts\ContactIndex;
use Livewire\Livewire;

test('can instantiate contact index component', function () {
    $this->actingAs($this->user);
    Livewire::test(ContactIndex::class)
        ->assertStatus(200);
});
