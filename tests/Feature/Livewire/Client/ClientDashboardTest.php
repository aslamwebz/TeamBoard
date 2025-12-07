<?php

declare(strict_types=1);

use App\Livewire\Client\ClientDashboard;
use Livewire\Livewire;

test('can instantiate client dashboard component', function () {

    $this->actingAs($this->user);

    Livewire::test(ClientDashboard::class)
        ->assertStatus(200);
});
