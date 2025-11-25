<?php

namespace Database\Seeders\webz;

use App\Models\User;
use App\Models\WorkerProfile;
use Illuminate\Database\Seeder;

class WorkerProfileSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $users = User::with('workerProfile')->get();

        if ($users->isEmpty()) {
            $this->command->warn('No users found. Please run UserSeeder first.');
            return;
        }

        foreach ($users as $user) {
            if (!$user->workerProfile) {
                WorkerProfile::factory()->create([
                    'user_id' => $user->id,
                    'employee_id' => 'EMP' . str_pad($user->id, 4, '0', STR_PAD_LEFT),
                    'job_title' => fake()->jobTitle(),
                    'department' => fake()->randomElement(['Technology', 'Sales', 'Marketing', 'Finance', 'HR', 'Operations', 'Support']),
                    'status' => fake()->randomElement(['active', 'on_leave', 'inactive']),
                    'hourly_rate' => fake()->randomFloat(2, 25, 150),
                    'hire_date' => fake()->dateTimeBetween('-5 years', 'now'),
                    'employment_type' => fake()->randomElement(['full_time', 'part_time', 'contract', 'freelance', 'intern']),
                    'manager_id' => fake()->numberBetween(1, 5),  // Random manager ID from first 5 users
                    'bio' => fake()->paragraph(),
                    'emergency_contact' => fake()->name(),
                    'emergency_contact_phone' => fake()->phoneNumber(),
                    'address' => fake()->streetAddress(),
                    'city' => fake()->city(),
                    'state' => fake()->stateAbbr(),
                    'zip_code' => fake()->postcode(),
                    'country' => fake()->country(),
                    'phone' => fake()->phoneNumber(),
                ]);
            }
        }
    }
}
