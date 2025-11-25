<?php

namespace Database\Seeders\webz;

use App\Models\Vendor;
use App\Models\VendorService;
use Illuminate\Database\Seeder;

class VendorServiceSeeder extends Seeder
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

        // Sample services to assign to vendors
        $services = [
            ['Software Development', 'technology', 'Custom software development services'],
            ['Consulting Services', 'professional', 'Strategic consulting and advisory services'],
            ['Cloud Hosting', 'technology', 'Cloud infrastructure and hosting solutions'],
            ['Marketing Services', 'marketing', 'Digital marketing and advertising'],
            ['Security Services', 'security', 'Cybersecurity and physical security'],
            ['Training Programs', 'education', 'Corporate training and development'],
            ['Design Services', 'creative', 'Graphic design and creative services'],
            ['Equipment Rental', 'rental', 'Machinery and equipment rental'],
            ['Maintenance Services', 'maintenance', 'Equipment maintenance and repair'],
            ['Data Analysis', 'analytics', 'Data analysis and reporting'],
            ['Network Solutions', 'technology', 'Network infrastructure and support'],
            ['Logistics', 'transportation', 'Supply chain and logistics management'],
        ];

        foreach ($vendors as $vendor) {
            // Assign 2-5 random services to each vendor
            $selectedServices = collect($services)->random(rand(2, 5));

            foreach ($selectedServices as $service) {
                VendorService::factory()->create([
                    'vendor_id' => $vendor->id,
                    'name' => $service[0],
                    'category' => $service[1],
                    'description' => $service[2],
                    'unit_price' => fake()->randomFloat(2, 20, 500),
                    'unit_of_measure' => ['per hour', 'per month', 'per item', 'per project'][array_rand(['per hour', 'per month', 'per item', 'per project'])],
                ]);
            }
        }
    }
}
