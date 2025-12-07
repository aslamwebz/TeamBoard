<?php

declare(strict_types=1);

test('purchase order create component class exists', function () {
    $componentClass = App\Livewire\PurchaseOrders\PurchaseOrderCreate::class;
    expect(class_exists($componentClass))->toBeTrue();
});
