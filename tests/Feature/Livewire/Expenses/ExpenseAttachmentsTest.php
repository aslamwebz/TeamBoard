<?php declare(strict_types=1);

use App\Livewire\Expenses\ExpenseAttachments;

test('expense attachments component class exists', function () {
    $componentClass = ExpenseAttachments::class;
    expect(class_exists($componentClass))->toBeTrue();
});
