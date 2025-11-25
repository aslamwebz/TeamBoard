<?php

return [
    App\Providers\AppServiceProvider::class,
    App\Providers\AuthServiceProvider::class,
    App\Providers\Filament\YPanelProvider::class,
    App\Providers\TenancyServiceProvider::class,
    App\Providers\LivewireUploadServiceProvider::class,  // Handles Livewire file uploads with tenancy
];
