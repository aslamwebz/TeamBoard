<?php declare(strict_types=1);

use App\Livewire\PurchaseOrders\PurchaseOrderCreate;

test('purchase order create component class exists', function () {
    $componentClass = PurchaseOrderCreate::class;
    expect(class_exists($componentClass))->toBeTrue();
});
