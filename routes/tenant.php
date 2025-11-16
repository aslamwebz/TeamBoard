<?php declare(strict_types=1);

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
use Illuminate\Support\Facades\Route;
use Stancl\Tenancy\Middleware\InitializeTenancyBySubdomain;
use Stancl\Tenancy\Middleware\PreventAccessFromCentralDomains;
use App\Livewire\Users\Index;
use App\Livewire\Users\Create;
use App\Livewire\Users\Edit;

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
    InitializeTenancyBySubdomain::class,
    PreventAccessFromCentralDomains::class,
])->group(function () {
    Route::get('/', function () {
        return 'This is your multi-tenant application. The id of the current tenant is ' . tenant('id');
    });

    Route::middleware(['auth', 'verified'])->group(function () {
        Route::get('dashboard', Dashboard::class)->name('dashboard');
        Route::get('projects', Projects::class)->name('projects');
        Route::get('tasks', Tasks::class)->name('tasks');
        Route::get('users', Users::class)->name('users');
        Route::get('billing', Billing::class)->name('billing');
        Route::get('features', Features::class)->name('features');
        Route::get('pricing', Pricing::class)->name('pricing');
    });

    Route::middleware(['auth'])->group(function () {
        Route::get('settings/profile', Profile::class)->name('settings.profile');
        Route::get('settings/password', Password::class)->name('settings.password');
        Route::get('settings/appearance', Appearance::class)->name('settings.appearance');
    });

         // User CRUD routes
        Route::get('/users', Index::class)->name('users');
        Route::get('/users/create', Create::class)->name('users.create');
        Route::get('/users/{user}/edit', Edit::class)->name('users.edit');

    require __DIR__ . '/auth.php';
});
