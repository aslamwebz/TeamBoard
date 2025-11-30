<?php

use App\Models\ExpenseCategory;

it('to array', function () {
    $expenseCategory = ExpenseCategory::factory()->create()->refresh();

    expect(array_keys($expenseCategory->toArray()))->toBe([
        'id',
        'name',
        'description',
        'color',
        'is_active',
        'created_at',
        'updated_at',
    ]);
});