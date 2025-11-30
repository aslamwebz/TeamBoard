<?php

use App\Models\Comment;
use App\Models\Discussion;
use App\Models\User;
use App\Models\Project;
use App\Models\Client;

it('to array', function () {
    // Create related records first to satisfy foreign key constraints
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

    $user = User::create([
        'name' => 'Test User',
        'email' => 'test@example.com',
        'password' => bcrypt('password'),
        'created_at' => now(),
        'updated_at' => now(),
    ]);

    $discussion = Discussion::create([
        'title' => 'Test Discussion',
        'content' => 'Test discussion content',
        'type' => 'project',
        'type_id' => 1,
        'user_id' => $user->id,
        'project_id' => $project->id,
        'created_at' => now(),
        'updated_at' => now(),
    ]);

    $comment = Comment::create([
        'content' => 'Test comment content',
        'discussion_id' => $discussion->id,
        'user_id' => $user->id,
        'parent_id' => null,
        'created_at' => now(),
        'updated_at' => now(),
    ]);

    $expectedKeys = [
        'id',
        'discussion_id',
        'user_id',
        'content',
        'parent_id',
        'created_at',
        'updated_at',
    ];

    $actualKeys = array_keys($comment->toArray());

    foreach ($expectedKeys as $key) {
        expect($actualKeys)->toContain($key);
    }
});
