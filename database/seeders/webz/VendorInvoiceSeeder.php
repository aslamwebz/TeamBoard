<?php

namespace Database\Seeders\webz;

use App\Models\VendorInvoice;
use Illuminate\Database\Seeder;

class VendorInvoiceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Create random vendor invoices using factory
        VendorInvoice::factory()->count(20)->create();
    }
}