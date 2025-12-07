<?php

declare(strict_types=1);

use Livewire\Livewire;

test('can instantiate navigation handler component', function () {
    $this->actingAs($this->user);
    Livewire::test(App\Livewire\NavigationHandler::class)
        ->assertStatus(200);
});
