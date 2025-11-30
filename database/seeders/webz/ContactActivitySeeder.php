<?php

namespace Database\Seeders\webz;

use App\Models\ContactActivity;
use Illuminate\Database\Seeder;

class ContactActivitySeeder extends Seeder
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