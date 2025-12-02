<?php

declare(strict_types=1);

namespace Database\Seeders\webz;

use App\Models\Vendor;
use Illuminate\Database\Seeder;

final class VendorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Create random vendors using factory
        Vendor::factory()->count(10)->create();
    }
}
