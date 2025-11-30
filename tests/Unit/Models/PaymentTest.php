<?php

use App\Models\Payment;
use App\Models\User;
use App\Models\Client;
use App\Models\Invoice;

it('to array', function () {
    $client = Client::create([
        'company_name' => 'Test Client',
        'name' => 'Test Client',
        'email' => 'client@example.com',
        'created_at' => now(),
        'updated_at' => now(),
    ]);

    $user = User::create([
        'name' => 'Test User',
        'email' => 'test@example.com',
        'password' => bcrypt('password'),
        'created_at' => now(),
        'updated_at' => now(),
    ]);

    $invoice = Invoice::create([
        'client_id' => $client->id,
        'invoice_number' => 'INV-1234',
        'issue_date' => now(),
        'due_date' => now()->addDays(30),
        'amount' => 500.00,
        'tax' => 40.00,
        'total' => 540.00,
        'status' => 'paid',
        'created_at' => now(),
        'updated_at' => now(),
    ]);

    $payment = Payment::create([
        'invoice_id' => $invoice->id,
        'expense_id' => null, // Will be set to valid expense ID if needed
        'user_id' => $user->id,
        'amount' => 100.00,
        'payment_method' => 'cash',
        'transaction_reference' => 'TEST-REF-123',
        'payment_date' => now(),
        'notes' => 'Test payment',
        'status' => 'completed',
        'currency' => 'USD',
        'custom_fields' => null,
        'created_at' => now(),
        'updated_at' => now(),
    ]);

    $expectedKeys = [
        'id',
        'invoice_id',
        'expense_id',
        'user_id',
        'amount',
        'payment_method',
        'transaction_reference',
        'payment_date',
        'notes',
        'status',
        'currency',
        'custom_fields',
        'created_at',
        'updated_at',
    ];

    $actualKeys = array_keys($payment->toArray());

    foreach ($expectedKeys as $key) {
        expect($actualKeys)->toContain($key);
    }
});