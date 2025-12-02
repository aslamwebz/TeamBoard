<?php

declare(strict_types=1);

namespace Database\Seeders\webz;

use Illuminate\Database\Seeder;

final class PurchaseRequestSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $this->command->info('Purchase requests are typically handled similarly to purchase orders. Using existing PurchaseOrderSeeder data.');
    }
}
