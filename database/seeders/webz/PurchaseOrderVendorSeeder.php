<?php

declare(strict_types=1);

namespace Database\Seeders\webz;

use Illuminate\Database\Seeder;

final class PurchaseOrderVendorSeeder extends Seeder
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
