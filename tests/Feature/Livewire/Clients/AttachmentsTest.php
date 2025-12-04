<?php

test('client attachments component class exists', function () {
    $componentClass = \App\Livewire\Clients\Attachments::class;
    expect(class_exists($componentClass))->toBeTrue();
});