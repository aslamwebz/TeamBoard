<?php

namespace Database\Factories;

use App\Models\WorkerProfile;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class WorkerProfileFactory extends Factory
{
    protected $model = WorkerProfile::class;

    public function definition(): array
    {
        return [
            'user_id' => User::factory(),
            'employee_id' => 'EMP' . str_pad(fake()->unique()->numberBetween(1, 9999), 4, '0', STR_PAD_LEFT),
            'job_title' => fake()->jobTitle(),
            'bio' => fake()->optional()->paragraph(),
            'hourly_rate' => fake()->randomFloat(2, 15, 100),
            'department' => fake()->randomElement(['Technology', 'Sales', 'Marketing', 'Finance', 'HR', 'Operations', 'Support']),
            'manager_id' => fake()->optional()->numberBetween(1, 20),
            'hire_date' => fake()->dateTimeBetween('-5 years', 'now'),
            'employment_type' => fake()->randomElement(['full_time', 'part_time', 'contract', 'freelance', 'intern']),
            'status' => fake()->randomElement(['active', 'inactive', 'on_leave', 'terminated']),
            'availability' => json_encode([
                'monday' => fake()->optional()->time('H:i') . '-17:00',
                'tuesday' => fake()->optional()->time('H:i') . '-17:00',
                'wednesday' => fake()->optional()->time('H:i') . '-17:00',
                'thursday' => fake()->optional()->time('H:i') . '-17:00',
                'friday' => fake()->optional()->time('H:i') . '-17:00',
            ]),
            'emergency_contact' => fake()->name(),
            'emergency_contact_phone' => fake()->phoneNumber(),
            'address' => fake()->optional()->streetAddress(),
            'city' => fake()->optional()->city(),
            'state' => fake()->optional()->stateAbbr(),
            'zip_code' => fake()->optional()->postcode(),
            'country' => fake()->optional()->country(),
            'phone' => fake()->optional()->phoneNumber(),
        ];
    }
}