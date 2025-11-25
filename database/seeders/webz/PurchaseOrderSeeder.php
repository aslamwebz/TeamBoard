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

                PurchaseOrder::factory()->create([
                    'vendor_id' => $vendor->id,
                    'subtotal' => fake()->randomFloat(2, 500, 10000),
                    'tax_amount' => 0.0,  // Will be calculated later
                    'total_amount' => 0.0,  // Will be calculated later
                    'status' => $status,
                    'notes' => fake()->sentence(),
                    'delivery_address' => fake()->address(),
                    'shipping_method' => ['Standard', 'Express', 'Priority'][array_rand(['Standard', 'Express', 'Priority'])],
                    'payment_terms' => ['NET30', 'NET60', '2% Discount NET10'][array_rand(['NET30', 'NET60', '2% Discount NET10'])],
                    'created_by' => 1,  // Assuming first user is the creator
                ]);

            }
        }
    }
}
