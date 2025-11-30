<?php

use App\Models\ProjectPhase;
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

    $projectPhase = ProjectPhase::create([
        'name' => 'Test Phase',
        'description' => 'Test phase description',
        'project_id' => $project->id,
        'start_date' => '2024-01-01',
        'end_date' => '2024-06-30',
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
        'start_date',
        'end_date',
        'status',
        'order',
        'created_at',
        'updated_at',
    ];

    $actualKeys = array_keys($projectPhase->toArray());

    foreach ($expectedKeys as $key) {
        expect($actualKeys)->toContain($key);
    }
});