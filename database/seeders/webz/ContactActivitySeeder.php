<?php

declare(strict_types=1);

namespace Database\Seeders\webz;

use App\Models\ContactActivity;
use Illuminate\Database\Seeder;

final class ContactActivitySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Create random contact activities using factory
        ContactActivity::factory()->count(30)->create();
    }
}
