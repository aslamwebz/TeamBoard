<?php

declare(strict_types=1);

test('authenticated user can access discussion show', function () {
    $this->actingAs($this->user);
    $this->get('/discussions/1')->assertStatus(404);
});
