<?php

declare(strict_types=1);

use Livewire\Livewire;

test('can instantiate payment reminders component', function () {
    $this->actingAs($this->user);
    Livewire::test(App\Livewire\Payments\PaymentReminders::class)
        ->assertStatus(200);
});
