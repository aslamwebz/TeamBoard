<?php

use App\Models\Expense;
use App\Models\ExpenseCategory;
use App\Models\Project;
use App\Models\Client;
use App\Models\Vendor;
use App\Models\User;

it('to array', function () {
    // Create related records in proper order to satisfy foreign key constraints
    $category = ExpenseCategory::create([
        'name' => 'Travel Expenses',
        'description' => 'Travel related expenses',
        'color' => '#FF0000',
        'is_active' => true,
        'created_at' => now(),
        'updated_at' => now(),
    ]);

    $client = Client::create([
        'company_name' => 'Test Client',
        'name' => 'Test Client',
        'email' => 'client@example.com',
        'created_at' => now(),
        'updated_at' => now(),
    ]);

    $project = Project::create([
        'name' => 'Test Project',
        'description' => 'Test project description',
        'status' => 'in_progress',
        'due_date' => now()->addMonth(),
        'client_id' => $client->id,
        'created_at' => now(),
        'updated_at' => now(),
    ]);

    $vendor = Vendor::create([
        'name' => 'Test Vendor',
        'email' => 'vendor@example.com',
        'phone' => '123-456-7890',
        'address' => '123 Main St',
        'city' => 'Anytown',
        'state' => 'ST',
        'zip_code' => '12345',
        'country' => 'USA',
        'tax_id' => 'TAX123456',
        'description' => 'Test vendor description',
        'rating' => 4.5,
        'website' => 'https://example.com',
        'status' => 'active',
        'payment_terms' => 'NET30',
        'credit_limit' => 50000,
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

    $expense = Expense::create([
        'name' => 'Test Expense',
        'expense_category_id' => $category->id,
        'project_id' => $project->id,
        'vendor_id' => $vendor->id,
        'user_id' => $user->id,
        'title' => 'Expense Title',
        'description' => 'Expense description',
        'amount' => 100.00,
        'currency' => 'USD',
        'expense_date' => '2024-01-01',
        'status' => 'pending',
        'payment_method' => 'cash',
        'notes' => 'Test notes',
        'receipt_path' => null,
        'approver_id' => null,
        'approved_at' => null,
        'custom_fields' => null,
        'created_at' => now(),
        'updated_at' => now(),
    ]);

    $expectedKeys = [
        'id',
        'name',
        'expense_category_id',
        'project_id',
        'vendor_id',
        'user_id',
        'title',
        'description',
        'amount',
        'currency',
        'expense_date',
        'status',
        'payment_method',
        'notes',
        'receipt_path',
        'approver_id',
        'approved_at',
        'custom_fields',
        'created_at',
        'updated_at',
    ];

    $actualKeys = array_keys($expense->toArray());

    foreach ($expectedKeys as $key) {
        expect($actualKeys)->toContain($key);
    }
});