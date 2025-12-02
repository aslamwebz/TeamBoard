<?php

declare(strict_types=1);

namespace Database\Seeders\webz;

use Illuminate\Database\Seeder;

final class PurchaseRequestItemSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $this->command->info('Purchase request items are handled in PurchaseOrderItemSeeder as they follow similar structure.');
    }
}
