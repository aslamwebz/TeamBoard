<?php

declare(strict_types=1);

test('authenticated user can access file upload', function () {
    $this->actingAs($this->user);
    $this->get('/files/upload')->assertStatus(200);
});
