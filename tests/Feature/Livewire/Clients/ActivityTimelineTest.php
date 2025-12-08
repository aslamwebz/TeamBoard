<?php declare(strict_types=1);

use App\Livewire\Clients\ActivityTimeline;
use Livewire\Livewire;

test('can instantiate activity timeline component', function () {
    $this->actingAs($this->user);
    Livewire::test(ActivityTimeline::class)
        ->assertStatus(200);
});
