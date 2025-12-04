<?php

use Livewire\Livewire;

test('can instantiate expense approvals component', function () {
    $this->actingAs($this->user);
    Livewire::test(\App\Livewire\Expenses\ExpenseApprovals::class)
        ->assertStatus(200);
});