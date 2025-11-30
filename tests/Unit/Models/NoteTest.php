<?php

use App\Models\Note;
use App\Models\Client;
use App\Models\User;

it('to array', function () {
    $client = Client::create([
        'company_name' => 'Test Client',
        'name' => 'Test Client',
        'email' => 'client@example.com',
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

    $note = Note::create([
        'noteable_type' => 'App\Models\Client',
        'noteable_id' => $client->id,
        'title' => 'Test Note',
        'content' => 'Test note content',
        'type' => 'general',
        'is_public' => true,
        'created_by' => $user->id,
        'created_at' => now(),
        'updated_at' => now(),
    ]);

    $expectedKeys = [
        'id',
        'noteable_type',
        'noteable_id',
        'title',
        'content',
        'type',
        'is_public',
        'created_by',
        'created_at',
        'updated_at',
    ];

    $actualKeys = array_keys($note->toArray());

    foreach ($expectedKeys as $key) {
        expect($actualKeys)->toContain($key);
    }
});