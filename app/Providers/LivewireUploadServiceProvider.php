<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class LivewireUploadServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        $this->app->booted(function () {
            // Configure the temporary file upload disk
            config([
                'filesystems.disks.livewire-tmp' => [
                    'driver' => 'local',
                    'root' => storage_path('app/livewire-tmp'),
                    'throw' => false,
                    'url' => null,
                    'visibility' => 'private',
                ],
            ]);
        });
    }
}
