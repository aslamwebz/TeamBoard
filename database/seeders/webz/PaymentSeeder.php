<?php

declare(strict_types=1);

namespace Database\Seeders\webz;

use App\Models\Payment;
use Illuminate\Database\Seeder;

final class PaymentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Create random payments using factory
        Payment::factory()->count(25)->create();
    }
}
