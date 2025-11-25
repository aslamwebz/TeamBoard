<?php

namespace Database\Seeders\webz;

use App\Models\PurchaseOrder;
use Illuminate\Database\Seeder;

class PurchaseRequestSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $this->command->info('Purchase requests are typically handled similarly to purchase orders. Using existing PurchaseOrderSeeder data.');
    }
}
