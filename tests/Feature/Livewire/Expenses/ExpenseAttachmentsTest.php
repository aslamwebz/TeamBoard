<?php

test('expense attachments component class exists', function () {
    $componentClass = \App\Livewire\Expenses\ExpenseAttachments::class;
    expect(class_exists($componentClass))->toBeTrue();
});