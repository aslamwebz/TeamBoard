<?php

namespace Database\Seeders\webz;

use App\Models\Client;
use Illuminate\Database\Seeder;

class ClientSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $clients = [
            [
                'name' => 'Acme Corporation',
                'company_name' => 'Acme Corporation',
                'email' => 'contact@acme.com',
                'phone' => '+1-555-0101',
                'address' => '456 Corporate Blvd',
                'city' => 'Business City',
                'state' => 'NY',
                'zip_code' => '10001',
                'country' => 'USA',
                'tax_vat_number' => 'ACME12345',
                'industry' => 'Manufacturing',
                'description' => 'Leading manufacturer of industrial equipment',
            ],
            [
                'name' => 'Global Solutions Ltd',
                'company_name' => 'Global Solutions Ltd',
                'email' => 'info@globalsolutions.io',
                'phone' => '+1-555-0102',
                'address' => '789 Tech Park Drive',
                'city' => 'Innovation Hub',
                'state' => 'CA',
                'zip_code' => '94043',
                'country' => 'USA',
                'tax_vat_number' => 'GLBSOL67890',
                'industry' => 'Technology',
                'description' => 'IT consulting and solutions provider',
            ],
            [
                'name' => 'Metro Health Partners',
                'company_name' => 'Metro Health Partners',
                'email' => 'partners@metrohealth.org',
                'phone' => '+1-555-0103',
                'address' => '321 Medical Center Dr',
                'city' => 'Healthville',
                'state' => 'TX',
                'zip_code' => '75001',
                'country' => 'USA',
                'tax_vat_number' => 'MHPRT45678',
                'industry' => 'Healthcare',
                'description' => 'Healthcare services and management',
            ],
            [
                'name' => 'FinanceFirst Group',
                'company_name' => 'FinanceFirst Group',
                'email' => 'support@financefirst.com',
                'phone' => '+1-555-0104',
                'address' => '987 Financial District',
                'city' => 'Banking Center',
                'state' => 'IL',
                'zip_code' => '60601',
                'country' => 'USA',
                'tax_vat_number' => 'FFGRP90123',
                'industry' => 'Finance',
                'description' => 'Financial services and investment',
            ],
            [
                'name' => 'Retail Giants Inc',
                'company_name' => 'Retail Giants Inc',
                'email' => 'orders@retailgiants.com',
                'phone' => '+1-555-0105',
                'address' => '654 Shopping Plaza',
                'city' => 'Retail Town',
                'state' => 'FL',
                'zip_code' => '33101',
                'country' => 'USA',
                'tax_vat_number' => 'RTGTS23456',
                'industry' => 'Retail',
                'description' => 'Multi-location retail operations',
            ],
            [
                'name' => 'Creative Media Studio',
                'company_name' => 'Creative Media Studio',
                'email' => 'hello@creativemedia.com',
                'phone' => '+1-555-0106',
                'address' => '147 Creative Ave',
                'city' => 'Arts District',
                'state' => 'CA',
                'zip_code' => '90001',
                'country' => 'USA',
                'tax_vat_number' => 'CMDIO78901',
                'industry' => 'Media',
                'description' => 'Digital marketing and creative services',
            ],
            [
                'name' => 'Energy Innovations Co',
                'company_name' => 'Energy Innovations Co',
                'email' => 'contact@energyinnovations.com',
                'phone' => '+1-555-0107',
                'address' => '258 Energy Sector',
                'city' => 'Green City',
                'state' => 'CO',
                'zip_code' => '80001',
                'country' => 'USA',
                'tax_vat_number' => 'ENGVN34567',
                'industry' => 'Energy',
                'description' => 'Renewable energy solutions',
            ],
            [
                'name' => 'Transport Solutions LLC',
                'company_name' => 'Transport Solutions LLC',
                'email' => 'booking@transportsolutions.com',
                'phone' => '+1-555-0108',
                'address' => '369 Logistics Hub',
                'city' => 'Transport Center',
                'state' => 'OH',
                'zip_code' => '44001',
                'country' => 'USA',
                'tax_vat_number' => 'TRSPN89012',
                'industry' => 'Transportation',
                'description' => 'Logistics and transportation services',
            ],
            [
                'name' => 'Food & Hospitality Group',
                'company_name' => 'Food & Hospitality Group',
                'email' => 'reservations@foodhospitality.com',
                'phone' => '+1-555-0109',
                'address' => '741 Restaurant Row',
                'city' => 'Foodie Town',
                'state' => 'NV',
                'zip_code' => '89101',
                'country' => 'USA',
                'tax_vat_number' => 'FTHGP45678',
                'industry' => 'Hospitality',
                'description' => 'Restaurant chain and hospitality services',
            ],
            [
                'name' => 'Education Services Inc',
                'company_name' => 'Education Services Inc',
                'email' => 'admin@educationservices.edu',
                'phone' => '+1-555-0110',
                'address' => '852 Learning Campus',
                'city' => 'Educational City',
                'state' => 'MA',
                'zip_code' => '01001',
                'country' => 'USA',
                'tax_vat_number' => 'EDUSV90123',
                'industry' => 'Education',
                'description' => 'Educational services and training',
            ],
        ];

        foreach ($clients as $client) {
            Client::factory()->create($client);
        }
    }
}