<?php

declare(strict_types=1);

use App\Livewire\NotificationCenter;
use Livewire\Livewire;

test('can instantiate notification center component', function () {
    $this->actingAs($this->user);
    Livewire::test(NotificationCenter::class)
        ->assertStatus(200);
});
