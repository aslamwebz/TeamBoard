<?php

declare(strict_types=1);

test('authenticated user can access team show', function () {
    $this->actingAs($this->user);
    $this->get('/teams/1')->assertStatus(404);
});
