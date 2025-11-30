<?php

namespace Database\Seeders\webz;

use App\Models\Contact;
use Illuminate\Database\Seeder;

class ContactSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Create random contacts using factory
        Contact::factory()->count(50)->create();
    }
}