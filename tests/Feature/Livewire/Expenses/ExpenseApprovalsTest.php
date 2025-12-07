<?php

declare(strict_types=1);

use Livewire\Livewire;

test('can instantiate expense approvals component', function () {
    $this->actingAs($this->user);
    Livewire::test(App\Livewire\Expenses\ExpenseApprovals::class)
        ->assertStatus(200);
});
