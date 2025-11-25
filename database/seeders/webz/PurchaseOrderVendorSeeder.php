<?php

namespace Database\Seeders\webz;

use App\Models\PurchaseOrder;
use App\Models\Vendor;
use Illuminate\Database\Seeder;

class PurchaseOrderVendorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // This is handled in PurchaseOrderSeeder as purchase orders already reference vendors
        $this->command->info('Purchase order-vendor relationships are handled in PurchaseOrderSeeder');
    }
}
