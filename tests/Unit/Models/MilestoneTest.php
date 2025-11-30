<?php

use App\Models\Milestone;
use App\Models\Project;
use App\Models\Client;

it('to array', function () {
    // Create required related records first
    $client = Client::create([
        'company_name' => 'Test Client',
        'name' => 'Test Client',
        'email' => 'client@example.com',
        'created_at' => now(),
        'updated_at' => now(),
    ]);

    $project = Project::create([
        'name' => 'Test Project',
        'description' => 'Test project description',
        'status' => 'in_progress',
        'due_date' => now()->addMonth(),
        'client_id' => $client->id,
        'created_at' => now(),
        'updated_at' => now(),
    ]);

    $milestone = Milestone::create([
        'name' => 'Test Milestone',
        'description' => 'Test milestone description',
        'project_id' => $project->id,
        'project_phase_id' => null,
        'due_date' => '2024-12-31',
        'status' => 'not_started',
        'order' => 1,
        'created_at' => now(),
        'updated_at' => now(),
    ]);

    $expectedKeys = [
        'id',
        'name',
        'description',
        'project_id',
        'project_phase_id',
        'due_date',
        'status',
        'order',
        'created_at',
        'updated_at',
    ];

    $actualKeys = array_keys($milestone->toArray());

    foreach ($expectedKeys as $key) {
        expect($actualKeys)->toContain($key);
    }
});