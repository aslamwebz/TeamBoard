<?php

declare(strict_types=1);

use App\Livewire\Files\FilesIndex;
use Livewire\Livewire;

test('can instantiate files index component', function () {
    $this->actingAs($this->user);
    Livewire::test(FilesIndex::class)
        ->assertStatus(200);
});
