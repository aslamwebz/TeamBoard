<?php

declare(strict_types=1);

test('invoice create component class exists', function () {
    $componentClass = App\Livewire\Invoices\InvoiceCreate::class;
    expect(class_exists($componentClass))->toBeTrue();
});
