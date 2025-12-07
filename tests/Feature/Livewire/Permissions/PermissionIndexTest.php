<?php

declare(strict_types=1);

test('authenticated user can access permission index', function () {
    $this->actingAs($this->user);
    $this->get('/permissions')->assertStatus(200);
});
