<?php

declare(strict_types=1);

use App\Livewire\Payments\PaymentReminders;
use Livewire\Livewire;

test('can instantiate payment reminders component', function () {
    $this->actingAs($this->user);
    Livewire::test(PaymentReminders::class)
        ->assertStatus(200);
});
