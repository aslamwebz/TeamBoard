<?php

declare(strict_types=1);

test('invoice payments component class exists', function () {
    $componentClass = App\Livewire\Invoices\InvoicePayments::class;
    expect(class_exists($componentClass))->toBeTrue();
});
