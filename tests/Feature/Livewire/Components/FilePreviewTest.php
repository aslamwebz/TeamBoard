<?php

declare(strict_types=1);

use Livewire\Livewire;

test('can instantiate file preview component', function () {
    $this->actingAs($this->user);
    Livewire::test(App\Livewire\Components\FilePreview::class)
        ->assertStatus(200);
});
