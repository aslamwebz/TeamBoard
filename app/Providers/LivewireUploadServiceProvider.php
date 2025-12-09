<?php

declare(strict_types=1);

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

final class LivewireUploadServiceProvider extends ServiceProvider
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
        $this->app->booted(function (): void {
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
