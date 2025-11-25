<?php

namespace Database\Seeders\webz;

use App\Models\PurchaseOrder;
use App\Models\PurchaseOrderItem;
use Illuminate\Database\Seeder;

class PurchaseOrderItemSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $purchaseOrders = PurchaseOrder::all();

        if ($purchaseOrders->isEmpty()) {
            $this->command->warn('No purchase orders found. Please run PurchaseOrderSeeder first.');
            return;
        }

        // Sample items for purchase orders
        $items = [
            ['Laptop Computer', 'High-performance laptop for development work', 'each', 1200.0],
            ['Desk Chair', 'Ergonomic office chair', 'each', 250.0],
            ['Monitor', '4K Ultra HD Monitor', 'each', 450.0],
            ['Server Hardware', 'Enterprise server for hosting', 'each', 3500.0],
            ['Network Switch', 'Managed network switch', 'each', 650.0],
            ['Software License', 'Annual software license', 'year', 999.0],
            ['Security Camera', 'HD Security Camera', 'each', 180.0],
            ['Printer', 'Multifunction laser printer', 'each', 320.0],
            ['Office Supplies', 'Basic office supplies bundle', 'bundle', 75.0],
            ['Training Session', 'Technical training session', 'session', 800.0],
        ];

        foreach ($purchaseOrders as $purchaseOrder) {
            // Add 2-5 items to each purchase order
            $itemCount = rand(2, 5);

            for ($i = 0; $i < $itemCount; $i++) {
                $item = $items[array_rand($items)];

                $quantity = rand(1, 10);
                $unitPrice = $item[3];
                $totalPrice = $quantity * $unitPrice;

                PurchaseOrderItem::factory()->create([
                    'purchase_order_id' => $purchaseOrder->id,
                    'name' => $item[0],
                    'description' => $item[1],
                    'unit_price' => $unitPrice,
                    'quantity' => $quantity,
                    'total_price' => $totalPrice,
                    'unit_of_measure' => $item[2],
                    'received_quantity' => $purchaseOrder->status === 'received' ? $quantity : ($purchaseOrder->status === 'partially_received' ? rand(1, $quantity) : 0),
                    'service_code' => 'CODE-' . strtoupper(substr(md5($item[0]), 0, 6)),
                ]);
            }
        }
    }
}
