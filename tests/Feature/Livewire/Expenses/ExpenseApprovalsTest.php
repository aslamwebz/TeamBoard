<?php

declare(strict_types=1);

use App\Livewire\Expenses\ExpenseApprovals;
use Livewire\Livewire;

test('can instantiate expense approvals component', function () {
    $this->actingAs($this->user);
    Livewire::test(ExpenseApprovals::class)
        ->assertStatus(200);
});
