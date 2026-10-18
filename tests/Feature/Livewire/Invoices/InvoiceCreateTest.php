<?php

declare(strict_types=1);

use App\Livewire\Invoices\InvoiceCreate;

test('invoice create component class exists', function () {
    $componentClass = InvoiceCreate::class;
    expect(class_exists($componentClass))->toBeTrue();
});
