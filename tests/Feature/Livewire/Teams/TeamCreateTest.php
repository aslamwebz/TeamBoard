<?php

declare(strict_types=1);

test('authenticated user can access team create', function () {
    $this->actingAs($this->user);
    $this->get('/teams/create')->assertStatus(200);
});
