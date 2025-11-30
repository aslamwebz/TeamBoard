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
        // Create random clients using factory
        Client::factory()->count(10)->create();
    }
}