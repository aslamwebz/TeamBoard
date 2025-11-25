<?php

namespace Database\Seeders\webz;

use App\Models\Certification;
use Illuminate\Database\Seeder;

class CertificationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $certifications = [
            ['name' => 'Project Management Professional', 'issuing_organization' => 'PMI', 'description' => 'Certified in project management methodologies'],
            ['name' => 'Certified ScrumMaster', 'issuing_organization' => 'Scrum Alliance', 'description' => 'Certified in Scrum framework and methodology'],
            ['name' => 'AWS Certified Solutions Architect', 'issuing_organization' => 'Amazon Web Services', 'description' => 'Certified in AWS cloud architecture'],
            ['name' => 'Google Analytics Certified', 'issuing_organization' => 'Google', 'description' => 'Certified in Google Analytics platform'],
            ['name' => 'CompTIA Security+', 'issuing_organization' => 'CompTIA', 'description' => 'Certified in cybersecurity fundamentals'],
            ['name' => 'Certified Public Accountant', 'issuing_organization' => 'AICPA', 'description' => 'Certified in accounting and finance'],
            ['name' => 'Six Sigma Green Belt', 'issuing_organization' => 'ASQ', 'description' => 'Certified in process improvement methodologies'],
            ['name' => 'Microsoft Certified: Azure Fundamentals', 'issuing_organization' => 'Microsoft', 'description' => 'Certified in Microsoft Azure cloud services'],
            ['name' => 'Certified Kubernetes Administrator', 'issuing_organization' => 'CNCF', 'description' => 'Certified in Kubernetes container orchestration'],
            ['name' => 'Google Cloud Professional', 'issuing_organization' => 'Google', 'description' => 'Certified in Google Cloud Platform'],
            ['name' => 'Salesforce Administrator', 'issuing_organization' => 'Salesforce', 'description' => 'Certified in Salesforce administration'],
            ['name' => 'Certified Information Systems Security Professional', 'issuing_organization' => 'ISC2', 'description' => 'Certified in information systems security'],
            ['name' => 'Adobe Certified Expert', 'issuing_organization' => 'Adobe', 'description' => 'Certified in Adobe creative suite'],
            ['name' => 'HubSpot Content Marketing', 'issuing_organization' => 'HubSpot', 'description' => 'Certified in content marketing strategies'],
            ['name' => 'Oracle Database SQL Certified Associate', 'issuing_organization' => 'Oracle', 'description' => 'Certified in database SQL skills'],
        ];

        foreach ($certifications as $cert) {
            Certification::factory()->create([
                'name' => $cert['name'],
                'issuing_organization' => $cert['issuing_organization'],
                'description' => $cert['description'],
                'license_number' => strtoupper(fake()->bothify('?????-#####')),
                'issue_date' => fake()->dateTimeBetween('-3 years', 'now'),
                'expiry_date' => fake()->dateTimeBetween('+1 year', '+3 years'),
                'credential_id' => fake()->uuid(),
                'credential_url' => fake()->url(),
            ]);
        }
    }
}
