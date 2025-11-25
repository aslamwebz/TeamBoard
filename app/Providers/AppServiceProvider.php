<?php

declare(strict_types=1);

namespace App\Providers;

use App\Events\TaskAssignedNotification;
use App\Listeners\SendNotificationListener;
use App\Models\Task;
use App\Models\Tenant;
use App\Observers\TaskObserver;
use App\Services\NotificationService;
use Carbon\CarbonImmutable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Event;
use Illuminate\Support\Facades\Date;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Facades\Vite;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;

final class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        // Bind the NotificationService
        $this->app->singleton(NotificationService::class, function ($app) {
            return new NotificationService();
        });
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        $this->configureCommands();
        $this->configureModels();
        $this->configureDates();
        $this->configureUrls();
        $this->configureVite();
        $this->shareCompanySettings();

        // Register model observers
        Task::observe(TaskObserver::class);

        // Register event listeners for notifications
        Event::listen([
            \App\Events\TaskAssignedNotification::class,
            \App\Events\NewInvoiceNotification::class,
            \App\Events\ProjectUpdatedNotification::class,
            \App\Events\MentionedInCommentNotification::class,
            \App\Events\ClientAddedNotification::class,
            \App\Events\PaymentFailedNotification::class,
        ], \App\Listeners\SendNotificationListener::class);
    }

    /**
     * Configure the application commands, prevent destructive commands in production.
     */
    private function configureCommands(): void
    {
        DB::prohibitDestructiveCommands(
            $this->app->isProduction()
        );
    }

    /**
     * Configure the application models.
     */
    private function configureModels(): void
    {
        Model::unguard();
        Model::shouldBeStrict();
    }

    /**
     * Configure the application dates.
     */
    private function configureDates(): void
    {
        Date::use(CarbonImmutable::class);
    }

    /**
     * Configure the application urls.
     */
    private function configureUrls(): void
    {
        URL::forceScheme('https');
    }

    /**
     * Configure the Vite instance.
     */
    private function configureVite(): void
    {
        Vite::useAggressivePrefetching();
    }

    /**
     * Share company settings with all views when in a tenant context.
     */
    private function shareCompanySettings(): void
    {
        View::composer('*', function ($view) {
            try {
                // Only share company settings in a tenant context
                if (app()->bound('stancl.tenancy.currentTenant')) {
                    $tenant = Tenant::current();
                    if ($tenant) {
                        $view->with([
                            'companyName' => $tenant->getCompanyName(),
                            'companyLogo' => $tenant->logo_url,
                            'companyEmail' => $tenant->getContactEmail(),
                            'companyPhone' => $tenant->getCompanyPhone(),
                            'companyAddress' => $tenant->getCompanyAddress(),
                            'defaultCurrency' => $tenant->getDefaultCurrency(),
                            'defaultTimezone' => $tenant->getDefaultTimezone(),
                            'brandingConfig' => $tenant->getBrandingConfig(),
                        ]);
                    }
                }
            } catch (\Exception $e) {
                // Silently fail if tenant context isn't available
            }
        });
    }
}
