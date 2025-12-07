<?php

declare(strict_types=1);

use Livewire\Livewire;

test('can instantiate notification list component', function () {
    $this->actingAs($this->user);
    Livewire::test(App\Livewire\NotificationList\NotificationList::class)
        ->assertStatus(200);
});
