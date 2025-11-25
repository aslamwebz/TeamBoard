<?php

namespace Database\Seeders\webz;

use App\Models\Tenant;
use Illuminate\Database\Seeder;

class CompanyProfileSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $tenant = Tenant::first(); // Assuming tenant is already created
        
        if ($tenant) {
            $tenant->update([
                'legal_name' => 'Webz Technologies Inc.',
                'address' => '123 Business Street, Suite 100',
                'city' => 'Tech City',
                'state' => 'CA',
                'zip_code' => '94105',
                'country' => 'USA',
                'phone' => '+1-555-123-4567',
                'email' => 'info@webz.com',
                'tax_vat_number' => 'TX123456789',
                'industry' => 'Technology',
                'currency' => 'USD',
                'timezone' => 'America/Los_Angeles',
                'branding' => [
                    'primary_color' => '#3B82F6',
                    'secondary_color' => '#1E40AF',
                    'logo_url' => 'https://example.com/logo.png',
                    'favicon_url' => 'https://example.com/favicon.ico',
                ],
            ]);
        }
    }
}