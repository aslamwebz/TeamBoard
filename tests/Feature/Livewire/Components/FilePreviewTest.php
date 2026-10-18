<?php

declare(strict_types=1);

use App\Livewire\Components\FilePreview;
use Livewire\Livewire;

test('can instantiate file preview component', function () {
    $this->actingAs($this->user);
    Livewire::test(FilePreview::class)
        ->assertStatus(200);
});
