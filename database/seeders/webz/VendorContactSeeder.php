<?php

namespace Database\Seeders\webz;

use App\Models\Vendor;
use App\Models\VendorContact;
use Illuminate\Database\Seeder;

class VendorContactSeeder extends Seeder
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

        foreach ($vendors as $vendor) {
            // Create 1-3 contacts per vendor
            $contactCount = rand(1, 3);

            for ($i = 0; $i < $contactCount; $i++) {
                VendorContact::factory()->create([
                    'vendor_id' => $vendor->id,
                    'first_name' => fake()->firstName(),
                    'last_name' => fake()->lastName(),
                    'email' => fake()->unique()->safeEmail(),
                    'phone' => fake()->phoneNumber(),
                    'position' => fake()->jobTitle(),
                    'is_primary' => $i === 0,  // First contact is primary
                ]);
            }
        }
    }
}
