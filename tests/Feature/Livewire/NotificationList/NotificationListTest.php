<?php declare(strict_types=1);

use App\Livewire\NotificationList\NotificationList;
use Livewire\Livewire;

test('can instantiate notification list component', function () {
    $this->actingAs($this->user);
    Livewire::test(NotificationList::class)
        ->assertStatus(200);
});
