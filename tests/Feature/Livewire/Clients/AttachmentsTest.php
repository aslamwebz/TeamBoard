<?php

declare(strict_types=1);

test('client attachments component class exists', function () {
    $componentClass = App\Livewire\Clients\Attachments::class;
    expect(class_exists($componentClass))->toBeTrue();
});
