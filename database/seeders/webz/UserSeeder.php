<?php

namespace Database\Seeders\webz;

use App\Models\User;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Create random users using factory
        User::factory()->count(10)->create();
    }
}