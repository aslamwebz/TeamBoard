<?php

declare(strict_types=1);

test('authenticated user can access phase show', function () {
    $this->actingAs($this->user);
    $this->get('/phases/1')->assertStatus(404);
});
