<?php

namespace Database\Seeders\webz;

use App\Models\Invoice;
use Illuminate\Database\Seeder;

class InvoiceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Create random invoices using factory
        Invoice::factory()->count(10)->create();
    }
}