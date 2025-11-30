<?php

namespace Database\Seeders\webz;

use App\Models\Payment;
use Illuminate\Database\Seeder;

class PaymentSeeder extends Seeder
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