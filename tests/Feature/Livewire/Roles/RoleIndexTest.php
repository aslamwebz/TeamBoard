<?php

declare(strict_types=1);

test('authenticated user can access role index', function () {
    $this->actingAs($this->user);
    $this->get('/roles')->assertStatus(200);
});
