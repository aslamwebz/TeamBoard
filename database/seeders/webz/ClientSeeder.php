<?php

declare(strict_types=1);

namespace Database\Seeders\webz;

use App\Models\Client;
use Illuminate\Database\Seeder;

final class ClientSeeder extends Seeder
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
