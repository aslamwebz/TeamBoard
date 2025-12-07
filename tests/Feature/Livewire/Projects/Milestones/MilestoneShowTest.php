<?php

declare(strict_types=1);

test('authenticated user can access milestone show', function () {
    $this->actingAs($this->user);
    $this->get('/milestones/1')->assertStatus(404);
});
