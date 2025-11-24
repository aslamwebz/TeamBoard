<?php declare(strict_types=1);

use App\Livewire\Billing\Index as Billing;
use App\Livewire\Clients\Create as ClientCreate;
use App\Livewire\Clients\Edit as ClientEdit;
use App\Livewire\Clients\Index as ClientIndex;
use App\Livewire\Clients\Show as ClientShow;
use App\Livewire\Features\Index as Features;
use App\Livewire\Invoices\Create as InvoiceCreate;
use App\Livewire\Invoices\Edit as InvoiceEdit;
use App\Livewire\Invoices\Index as InvoiceIndex;
use App\Livewire\Invoices\Show as InvoiceShow;
use App\Livewire\Pricing\Index as Pricing;
use App\Livewire\Projects\Index as Projects;
use App\Livewire\Reports\Create as ReportCreate;
use App\Livewire\Reports\Edit as ReportEdit;
use App\Livewire\Reports\Index as ReportIndex;
use App\Livewire\Reports\Show as ReportShow;
use App\Livewire\Settings\Appearance;
use App\Livewire\Settings\Password;
use App\Livewire\Settings\Profile;
use App\Livewire\Tasks\Index as Tasks;
use App\Livewire\Users\Create;
use App\Livewire\Users\Edit;
use App\Livewire\Users\Index;
use App\Livewire\Users\Index as Users;
use App\Livewire\Dashboard;
use Illuminate\Support\Facades\Route;
use Stancl\Tenancy\Middleware\InitializeTenancyBySubdomain;
use Stancl\Tenancy\Middleware\PreventAccessFromCentralDomains;
use App\Livewire\Teams\Index as TeamIndex;
use App\Livewire\Teams\Create as TeamCreate;
use App\Livewire\Teams\Edit as TeamEdit;
use App\Livewire\Teams\Show as TeamShow;

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
    Route::middleware(['auth', 'verified'])->group(function () {
        Route::get('/', Dashboard::class)->name('dashboard');
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
        Route::get('/users/{user}', \App\Livewire\Users\Show::class)->name('users.show');

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

        // Teams routes
        Route::get('/teams', TeamIndex::class)->name('teams.index');
        Route::get('/teams/create', TeamCreate::class)->name('teams.create');
        Route::get('/teams/{team}/edit', TeamEdit::class)->name('teams.edit');
        Route::get('/teams/{team}', TeamShow::class)->name('teams.show');

        // Roles management routes
        Route::get('/roles', \App\Livewire\Roles\Index::class)->name('roles.index');
        Route::get('/roles/create', \App\Livewire\Roles\Form::class)->name('roles.create');
        Route::get('/roles/{role}/edit', \App\Livewire\Roles\Form::class)->name('roles.edit')->where('role', '[0-9]+');

        // Permissions management routes
        Route::get('/permissions', \App\Livewire\Permissions\Index::class)->name('permissions.index');
        Route::get('/permissions/create', \App\Livewire\Permissions\Create::class)->name('permissions.create');
        Route::get('/permissions/{permission}/edit', \App\Livewire\Permissions\Edit::class)->name('permissions.edit');

        // Phases routes
        Route::get('/projects/{project}/phases', \App\Livewire\Projects\Phases\Index::class)->name('phases.index');
        Route::get('/projects/{project}/phases/create', \App\Livewire\Projects\Phases\Create::class)->name('phases.create');
        Route::get('/projects/{project}/phases/{phase}', \App\Livewire\Projects\Phases\Show::class)->name('phases.show');
        Route::get('/projects/{project}/phases/{phase}/edit', \App\Livewire\Projects\Phases\Edit::class)->name('phases.edit');

        // Milestones routes
        Route::get('/projects/{project}/milestones', \App\Livewire\Projects\Milestones\Index::class)->name('milestones.index');
        Route::get('/projects/{project}/milestones/create', \App\Livewire\Projects\Milestones\Create::class)->name('milestones.create');
        Route::get('/projects/{project}/milestones/{milestone}', \App\Livewire\Projects\Milestones\Show::class)->name('milestones.show');
        Route::get('/projects/{project}/milestones/{milestone}/edit', \App\Livewire\Projects\Milestones\Edit::class)->name('milestones.edit');

        // Discussions routes
        Route::get('/discussions', \App\Livewire\Discussions\Index::class)->name('discussions.index');
        Route::get('/discussions/create', \App\Livewire\Discussions\Create::class)->name('discussions.create');
        Route::get('/discussions/{discussion}', \App\Livewire\Discussions\Show::class)->name('discussions.show');
        Route::get('/discussions/{discussion}/edit', \App\Livewire\Discussions\Edit::class)->name('discussions.edit');

        // Files routes
        Route::get('/files', \App\Livewire\Files\Index::class)->name('files.index');
        Route::get('/files/upload', \App\Livewire\Files\Upload::class)->name('files.upload');
    });

    Route::middleware(['auth'])->group(function () {
        Route::get('settings/profile', Profile::class)->name('settings.profile');
        Route::get('settings/password', Password::class)->name('settings.password');
        Route::get('settings/appearance', Appearance::class)->name('settings.appearance');
        Route::get('settings/company-profile', \App\Livewire\Settings\CompanyProfile::class)->name('settings.company-profile');
    });

    // File serving route for tenant - needs to be inside the tenant group with proper middleware
    Route::get('/files/discussions/{filename}', [\App\Http\Controllers\TenantFileController::class, 'download'])
         ->name('tenant.file.download')
         ->middleware(['auth']);

    // File preview route - shows the file with preview and download tools
    Route::get('/files/preview/{filename}', [\App\Http\Controllers\FilePreviewController::class, 'preview'])
         ->name('tenant.file.preview')
         ->middleware(['auth']);

    // File preview page route - separate page for preview
    Route::get('/files/preview-page/{filename}', [\App\Http\Controllers\FilePreviewPageController::class, 'show'])
         ->name('tenant.file.preview.page')
         ->middleware(['auth']);

    // Notifications route - separate page for all notifications
    Route::get('/notifications', [\App\Livewire\Notifications\Index::class, '__invoke'])
         ->name('notifications.index')
         ->middleware(['auth']);

    require __DIR__ . '/auth.php';
});
