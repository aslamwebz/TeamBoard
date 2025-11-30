<?php

use App\Models\PurchaseOrderItem;

it('to array', function () {
    $purchaseOrderItem = PurchaseOrderItem::factory()->create()->refresh();

    expect(array_keys($purchaseOrderItem->toArray()))->toBe([
        'id',
        'purchase_order_id',
        'name',
        'description',
        'unit_price',
        'quantity',
        'total_price',
        'unit_of_measure',
        'received_quantity',
        'service_code',
        'created_at',
        'updated_at',
    ]);
});