<?php

namespace Database\Seeders\webz;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $users = [
            [
                'name' => 'John Doe',
                'email' => 'admin@webz.com',
                'password' => Hash::make('password'),
            ],
            [
                'name' => 'Jane Smith',
                'email' => 'jane.smith@webz.com',
                'password' => Hash::make('password'),
            ],
            [
                'name' => 'Robert Johnson',
                'email' => 'robert.johnson@webz.com',
                'password' => Hash::make('password'),
            ],
            [
                'name' => 'Emily Davis',
                'email' => 'emily.davis@webz.com',
                'password' => Hash::make('password'),
            ],
            [
                'name' => 'Michael Wilson',
                'email' => 'michael.wilson@webz.com',
                'password' => Hash::make('password'),
            ],
            [
                'name' => 'Sarah Brown',
                'email' => 'sarah.brown@webz.com',
                'password' => Hash::make('password'),
            ],
            [
                'name' => 'David Miller',
                'email' => 'david.miller@webz.com',
                'password' => Hash::make('password'),
            ],
            [
                'name' => 'Lisa Taylor',
                'email' => 'lisa.taylor@webz.com',
                'password' => Hash::make('password'),
            ],
            [
                'name' => 'James Anderson',
                'email' => 'james.anderson@webz.com',
                'password' => Hash::make('password'),
            ],
            [
                'name' => 'Jennifer Thomas',
                'email' => 'jennifer.thomas@webz.com',
                'password' => Hash::make('password'),
            ],
        ];

        foreach ($users as $userData) {
            User::factory()->create($userData);
        }

        $user = User::first();
        $user->assignRole('admin');
    }
}