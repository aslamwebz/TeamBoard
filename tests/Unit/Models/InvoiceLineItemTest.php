<?php

use App\Models\InvoiceLineItem;
use App\Models\Invoice;
use App\Models\Client;

it('to array', function () {
    // Create dependencies first to satisfy foreign key constraints
    $client = Client::create([
        'company_name' => 'Test Client',
        'name' => 'Test Client',
        'email' => 'client@example.com',
        'created_at' => now(),
        'updated_at' => now(),
    ]);

    $invoice = Invoice::create([
        'client_id' => $client->id,
        'invoice_number' => 'INV-1234',
        'issue_date' => now()->format('Y-m-d'),
        'due_date' => now()->addDays(30)->format('Y-m-d'),
        'amount' => 5000.00,
        'tax' => 400.00,
        'total' => 5400.00,
        'status' => 'paid',
        'created_at' => now(),
        'updated_at' => now(),
    ]);

    $invoiceLineItem = InvoiceLineItem::create([
        'invoice_id' => $invoice->id,
        'description' => 'Test description',
        'detail' => 'Test detail',
        'quantity' => 5,
        'unit_price' => 100.00,
        'total' => 500.00,
        'created_at' => now(),
        'updated_at' => now(),
    ]);

    $expectedKeys = [
        'id',
        'invoice_id',
        'description',
        'detail',
        'quantity',
        'unit_price',
        'total',
        'created_at',
        'updated_at',
    ];

    $actualKeys = array_keys($invoiceLineItem->toArray());

    foreach ($expectedKeys as $key) {
        expect($actualKeys)->toContain($key);
    }
});