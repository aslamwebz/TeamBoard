<?php

declare(strict_types=1);

test('authenticated user can access user edit when exists', function () {
    $this->actingAs($this->user);
    $this->get('/users/1/edit')->assertStatus(200);
});
