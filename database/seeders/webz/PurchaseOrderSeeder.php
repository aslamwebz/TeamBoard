<?php

namespace Database\Seeders\webz;

use App\Models\PurchaseOrder;
use App\Models\Vendor;
use Illuminate\Database\Seeder;

class PurchaseOrderSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $vendors = Vendor::all();

        if ($vendors->isEmpty()) {
            $this->command->warn('No vendors found. Please run VendorSeeder first.');
            return;
        }

        $statuses = ['draft', 'pending', 'approved', 'sent', 'partially_received', 'received', 'closed', 'cancelled'];

        foreach ($vendors as $vendor) {
            // Create 1-3 purchase orders per vendor
            $poCount = rand(1, 3);

            for ($i = 1; $i <= $poCount; $i++) {
                $status = $statuses[array_rand($statuses)];

                PurchaseOrder::factory()->create();

            }
        }
    }
}
