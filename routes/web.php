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
use App\Livewire\Home;
use Illuminate\Support\Facades\Route;

foreach (config('tenancy.central_domains') as $domain) {
    Route::domain($domain)->group(function () {
        require __DIR__ . '/auth.php';
        Route::get('/', Home::class)->name('home');

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
    });
}
