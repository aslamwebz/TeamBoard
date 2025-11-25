<?php

namespace Database\Seeders\webz;

use App\Models\Invoice;
use App\Models\Client;
use Illuminate\Database\Seeder;

class InvoiceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $clients = Client::all();
        
        if ($clients->isEmpty()) {
            $this->command->warn('No clients found. Please run ClientSeeder first.');
            return;
        }

        $invoices = [
            [
                'invoice_number' => 'INV-001',
                'issue_date' => now()->subDays(30),
                'due_date' => now()->subDays(15),
                'amount' => 5400.00,
                'tax' => 432.00,
                'total' => 5832.00,
                'status' => 'paid',
                'description' => 'Website development services',
            ],
            [
                'invoice_number' => 'INV-002',
                'issue_date' => now()->subDays(25),
                'due_date' => now()->subDays(10),
                'amount' => 8950.00,
                'tax' => 716.00,
                'total' => 9666.00,
                'status' => 'paid',
                'description' => 'Mobile app development',
            ],
            [
                'invoice_number' => 'INV-003',
                'issue_date' => now()->subDays(20),
                'due_date' => now()->subDays(5),
                'amount' => 12500.00,
                'tax' => 1000.00,
                'total' => 13500.00,
                'status' => 'paid',
                'description' => 'Cloud migration services',
            ],
            [
                'invoice_number' => 'INV-004',
                'issue_date' => now()->subDays(15),
                'due_date' => now()->addDays(15),
                'amount' => 7200.00,
                'tax' => 576.00,
                'total' => 7776.00,
                'status' => 'sent',
                'description' => 'Inventory management system',
            ],
            [
                'invoice_number' => 'INV-005',
                'issue_date' => now()->subDays(10),
                'due_date' => now()->addDays(20),
                'amount' => 3800.00,
                'tax' => 304.00,
                'total' => 4104.00,
                'status' => 'sent',
                'description' => 'Data analytics platform',
            ],
            [
                'invoice_number' => 'INV-006',
                'issue_date' => now()->subDays(5),
                'due_date' => now()->addDays(25),
                'amount' => 9750.00,
                'tax' => 780.00,
                'total' => 10530.00,
                'status' => 'draft',
                'description' => 'Cybersecurity enhancement',
            ],
            [
                'invoice_number' => 'INV-007',
                'issue_date' => now(),
                'due_date' => now()->addDays(30),
                'amount' => 4200.00,
                'tax' => 336.00,
                'total' => 4536.00,
                'status' => 'draft',
                'description' => 'Customer portal development',
            ],
            [
                'invoice_number' => 'INV-008',
                'issue_date' => now()->addDays(3),
                'due_date' => now()->addDays(33),
                'amount' => 15600.00,
                'tax' => 1248.00,
                'total' => 16848.00,
                'status' => 'draft',
                'description' => 'HR management system implementation',
            ],
            [
                'invoice_number' => 'INV-009',
                'issue_date' => now()->addDays(5),
                'due_date' => now()->addDays(35),
                'amount' => 6800.00,
                'tax' => 544.00,
                'total' => 7344.00,
                'status' => 'draft',
                'description' => 'E-commerce platform upgrade',
            ],
            [
                'invoice_number' => 'INV-010',
                'issue_date' => now()->addDays(7),
                'due_date' => now()->addDays(37),
                'amount' => 3200.00,
                'tax' => 256.00,
                'total' => 3456.00,
                'status' => 'draft',
                'description' => 'AI-powered chatbot development',
            ],
        ];

        foreach ($invoices as $index => $invoiceData) {
            $client = $clients->random();
            Invoice::factory()->create(array_merge($invoiceData, ['client_id' => $client->id]));
        }
    }
}