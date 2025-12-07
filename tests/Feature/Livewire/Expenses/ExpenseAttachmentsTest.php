<?php

declare(strict_types=1);

test('expense attachments component class exists', function () {
    $componentClass = App\Livewire\Expenses\ExpenseAttachments::class;
    expect(class_exists($componentClass))->toBeTrue();
});
