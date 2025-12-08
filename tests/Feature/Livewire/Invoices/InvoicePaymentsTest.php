<?php declare(strict_types=1);

use App\Livewire\Invoices\InvoicePayments;

test('invoice payments component class exists', function () {
    $componentClass = InvoicePayments::class;
    expect(class_exists($componentClass))->toBeTrue();
});
