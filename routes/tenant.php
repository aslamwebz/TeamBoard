<?php declare(strict_types=1);

use Illuminate\Support\Facades\Route;
use Stancl\Tenancy\Middleware\InitializeTenancyByDomain;
use Stancl\Tenancy\Middleware\PreventAccessFromCentralDomains;
use App\Livewire\Billing\Index as Billing;
use App\Livewire\Features\Index as Features;
use App\Livewire\Pricing\Index as Pricing;
use App\Livewire\Projects\Index as Projects;
use App\Livewire\Settings\Appearance;
use App\Livewire\Settings\Password;
use App\Livewire\Settings\Profile;
use App\Livewire\Tasks\Index as Tasks;
use App\Livewire\Users\Index as Users;
use App\Livewire\Dashboard;

/*
 * |--------------------------------------------------------------------------
 * | Tenant Routes
 * |--------------------------------------------------------------------------
 * |
 * | Here you can register the tenant routes for your application.
 * | These routes are loaded by the TenantRouteServiceProvider.
 * |
 * | Feel free to customize them however you want. Good luck!
 * |
 */

Route::middleware([
    'web',
    InitializeTenancyByDomain::class,
    PreventAccessFromCentralDomains::class,
])->group(function () {
    // Include authentication routes
    require __DIR__ . '/auth.php';

    // Public routes (accessible to guests)
    Route::middleware('guest')->group(function () {
        // Add any public tenant routes here
    });

    // Authenticated routes
    Route::middleware(['auth', 'verified'])->group(function () {
        Route::get('/', [Dashboard::class, '__invoke'])->name('tenant.dashboard');
        Route::get('projects', Projects::class)->name('tenant.projects');
        Route::get('tasks', Tasks::class)->name('tenant.tasks');
        Route::get('users', Users::class)->name('tenant.users');
        Route::get('billing', Billing::class)->name('tenant.billing');
        Route::get('features', Features::class)->name('tenant.features');
        Route::get('pricing', Pricing::class)->name('tenant.pricing');
    });

    // Settings routes (require auth but not necessarily email verification)
    Route::middleware(['auth'])->group(function () {
        Route::prefix('settings')->group(function () {
            Route::get('profile', Profile::class)->name('tenant.settings.profile');
            Route::get('password', Password::class)->name('tenant.settings.password');
            Route::get('appearance', Appearance::class)->name('tenant.settings.appearance');
        });
    });
});
