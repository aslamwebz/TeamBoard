<?php

test('authenticated user can access discussion edit', function () {
    $this->actingAs($this->user);
    $this->get('/discussions/1/edit')->assertStatus(404);
});