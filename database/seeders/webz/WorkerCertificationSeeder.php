<?php

namespace Database\Seeders\webz;

use App\Models\Certification;
use App\Models\WorkerProfile;
use Illuminate\Database\Seeder;

class WorkerCertificationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $workers = WorkerProfile::all();
        $certifications = Certification::all();

        if ($workers->isEmpty() || $certifications->isEmpty()) {
            $this->command->warn('Workers or Certifications not found. Please run WorkerProfileSeeder and CertificationSeeder first.');
            return;
        }

        foreach ($workers as $worker) {
            // Assign 1-4 certifications to each worker
            $selectedCertifications = $certifications->random(rand(1, 4));

            foreach ($selectedCertifications as $certification) {
                $worker->certifications()->attach($certification->id, [
                    'date_obtained' => fake()->dateTimeBetween('-3 years', 'now'),
                    'expiry_date' => fake()->optional()->dateTimeBetween('+1 year', '+3 years'),
                    'status' => fake()->randomElement(['active', 'expired', 'suspended', 'pending_verification']),
                    'notes' => fake()->optional()->sentence(),
                    'attachment_path' => fake()->optional()->filePath(),
                ]);
            }
        }
    }
}
