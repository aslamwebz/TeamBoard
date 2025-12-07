<?php

declare(strict_types=1);

namespace Database\Seeders\webz;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

final class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        $user = User::create([
            'name' => 'Admin User',
            'email' => 'admin@webz.com',
            'password' => Hash::make('password'),
        ]);

        $user->assignRole('admin');

        // Create random users using factory
        User::factory()->count(10)->create();
    }
}
