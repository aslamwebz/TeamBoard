<?php

test('invoice create component class exists', function () {
    $componentClass = \App\Livewire\Invoices\InvoiceCreate::class;
    expect(class_exists($componentClass))->toBeTrue();
});