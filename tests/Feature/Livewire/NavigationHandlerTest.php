<?php declare(strict_types=1);

use App\Livewire\NavigationHandler;
use Livewire\Livewire;

test('can instantiate navigation handler component', function () {
    $this->actingAs($this->user);
    Livewire::test(NavigationHandler::class)
        ->assertStatus(200);
});
