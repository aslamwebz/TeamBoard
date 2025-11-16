<?php

namespace Database\Seeders;

use App\Models\Client;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ClientSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Client::create([
            'name' => 'John Smith',
            'email' => 'john@example.com',
            'phone' => '+1 234 567 8900',
            'address' => '123 Main St',
            'city' => 'New York',
            'state' => 'NY',
            'zip_code' => '10001',
            'country' => 'USA',
            'company_name' => 'ABC Corp',
            'vat_number' => 'US123456789'
        ]);

        Client::create([
            'name' => 'Emily Johnson',
            'email' => 'emily@example.com',
            'phone' => '+1 987 654 3210',
            'address' => '456 Park Ave',
            'city' => 'Los Angeles',
            'state' => 'CA',
            'zip_code' => '90001',
            'country' => 'USA',
            'company_name' => 'XYZ Ltd',
            'vat_number' => 'US987654321'
        ]);

        Client::create([
            'name' => 'Michael Brown',
            'email' => 'michael@example.com',
            'phone' => '+1 555 123 4567',
            'address' => '789 Broadway',
            'city' => 'Chicago',
            'state' => 'IL',
            'zip_code' => '60601',
            'country' => 'USA',
            'company_name' => 'Tech Solutions Inc',
            'vat_number' => 'US456789123'
        ]);
    }
}
