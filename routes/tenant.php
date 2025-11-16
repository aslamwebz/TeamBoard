<?php declare(strict_types=1);

use App\Livewire\Billing\Index as Billing;
use App\Livewire\Features\Index as Features;
use App\Livewire\Pricing\Index as Pricing;
use App\Livewire\Projects\Index as Projects;
use App\Livewire\Settings\Appearance;
use App\Livewire\Settings\Password;
use App\Livewire\Settings\Profile;
use App\Livewire\Tasks\Index as Tasks;
use App\Livewire\Users\Create;
use App\Livewire\Users\Edit;
use App\Livewire\Users\Index;
use App\Livewire\Users\Index as Users;
use App\Livewire\Dashboard;
use App\Livewire\Clients\Create as ClientCreate;
use App\Livewire\Clients\Edit as ClientEdit;
use App\Livewire\Clients\Index as ClientIndex;
use App\Livewire\Clients\Show as ClientShow;
use App\Livewire\Invoices\Create as InvoiceCreate;
use App\Livewire\Invoices\Edit as InvoiceEdit;
use App\Livewire\Invoices\Index as InvoiceIndex;
use App\Livewire\Invoices\Show as InvoiceShow;
use App\Livewire\Reports\Create as ReportCreate;
use App\Livewire\Reports\Edit as ReportEdit;
use App\Livewire\Reports\Index as ReportIndex;
use App\Livewire\Reports\Show as ReportShow;
use Illuminate\Support\Facades\Route;
use Stancl\Tenancy\Middleware\InitializeTenancyBySubdomain;
use Stancl\Tenancy\Middleware\PreventAccessFromCentralDomains;

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

        // User CRUD routes
        Route::get('/users', Index::class)->name('users');
        Route::get('/users/create', Create::class)->name('users.create');
        Route::get('/users/{user}/edit', Edit::class)->name('users.edit');

        // Project CRUD routes
        Route::get('/projects', \App\Livewire\Projects\Index::class)->name('projects');
        Route::get('/projects/create', \App\Livewire\Projects\Create::class)->name('projects.create');
        Route::get('/projects/{project}/edit', \App\Livewire\Projects\Edit::class)->name('projects.edit');
        Route::get('/projects/{project}', \App\Livewire\Projects\Show::class)->name('projects.show');

        // Task CRUD routes
        Route::get('/tasks', \App\Livewire\Tasks\Index::class)->name('tasks');
        Route::get('/tasks/create', \App\Livewire\Tasks\Create::class)->name('tasks.create');
        Route::get('/tasks/{task}/edit', \App\Livewire\Tasks\Edit::class)->name('tasks.edit');
        Route::get('/tasks/{task}', \App\Livewire\Tasks\Show::class)->name('tasks.show');

         // Clients routes
        Route::get('/clients', ClientIndex::class)->name('clients.index');
        Route::get('/clients/create', ClientCreate::class)->name('clients.create');
        Route::get('/clients/{client}/edit', ClientEdit::class)->name('clients.edit');
        Route::get('/clients/{client}', ClientShow::class)->name('clients.show');

        // Invoices routes
        Route::get('/invoices', InvoiceIndex::class)->name('invoices.index');
        Route::get('/invoices/create', InvoiceCreate::class)->name('invoices.create');
        Route::get('/invoices/{invoice}/edit', InvoiceEdit::class)->name('invoices.edit');
        Route::get('/invoices/{invoice}', InvoiceShow::class)->name('invoices.show');

        // Reports routes
        Route::get('/reports', ReportIndex::class)->name('reports.index');
        Route::get('/reports/create', ReportCreate::class)->name('reports.create');
        Route::get('/reports/{report}/edit', ReportEdit::class)->name('reports.edit');
        Route::get('/reports/{report}', ReportShow::class)->name('reports.show');
    });

    Route::middleware(['auth'])->group(function () {
        Route::get('settings/profile', Profile::class)->name('settings.profile');
        Route::get('settings/password', Password::class)->name('settings.password');
        Route::get('settings/appearance', Appearance::class)->name('settings.appearance');
    });

    require __DIR__ . '/auth.php';
});
