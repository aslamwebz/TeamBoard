<?php declare(strict_types=1);

use App\Livewire\Billing\BillingIndex;
use App\Livewire\Clients\ClientCreate;
use App\Livewire\Clients\ClientEdit;
use App\Livewire\Clients\ClientIndex;
use App\Livewire\Clients\ClientShow;
use App\Livewire\Expenses\ExpenseApprovals;
use App\Livewire\Expenses\ExpenseAttachments;
use App\Livewire\Expenses\ExpenseCreate;
use App\Livewire\Expenses\ExpenseEdit;
use App\Livewire\Expenses\ExpenseIndex;
use App\Livewire\Expenses\ExpenseShow;
use App\Livewire\Features\FeatureIndex;
use App\Livewire\Invoices\InvoiceCreate;
use App\Livewire\Invoices\InvoiceEdit;
use App\Livewire\Invoices\InvoiceIndex;
use App\Livewire\Invoices\InvoicePayments;
use App\Livewire\Invoices\InvoiceShow;
use App\Livewire\NotificationList\NotificationList;
use App\Livewire\Payments\PaymentCreate;
use App\Livewire\Payments\PaymentEdit;
use App\Livewire\Payments\PaymentIndex;
use App\Livewire\Payments\PaymentReminders;
use App\Livewire\Payments\PaymentShow;
use App\Livewire\Pricing\PricingIndex;
use App\Livewire\Projects\ProjectCreate;
use App\Livewire\Projects\ProjectEdit;
use App\Livewire\Projects\ProjectIndex;
use App\Livewire\Projects\ProjectShow;
use App\Livewire\PurchaseOrders\PurchaseOrderCreate;
use App\Livewire\PurchaseOrders\PurchaseOrderEdit;
use App\Livewire\PurchaseOrders\PurchaseOrderIndex;
use App\Livewire\PurchaseOrders\PurchaseOrderShow;
use App\Livewire\Reports\ReportCreate;
use App\Livewire\Reports\ReportEdit;
use App\Livewire\Reports\ReportIndex;
use App\Livewire\Reports\ReportShow;
use App\Livewire\Settings\Appearance;
use App\Livewire\Settings\Password;
use App\Livewire\Settings\Profile;
use App\Livewire\Tasks\TaskCreate;
use App\Livewire\Tasks\TaskEdit;
use App\Livewire\Tasks\TaskIndex;
use App\Livewire\Tasks\TaskShow;
use App\Livewire\Teams\TeamCreate;
use App\Livewire\Teams\TeamEdit;
use App\Livewire\Teams\TeamIndex;
use App\Livewire\Teams\TeamShow;
use App\Livewire\Users\UserCreate;
use App\Livewire\Users\UserEdit;
use App\Livewire\Users\UserIndex;
use App\Livewire\Users\UserShow;
use App\Livewire\Vendors\VendorContacts;
use App\Livewire\Vendors\VendorCreate;
use App\Livewire\Vendors\VendorEdit;
use App\Livewire\Vendors\VendorIndex;
use App\Livewire\Vendors\VendorInvoices;
use App\Livewire\Vendors\VendorProjects;
use App\Livewire\Vendors\VendorServices;
use App\Livewire\Vendors\VendorShow;
use App\Livewire\Vendors\VendorTasks;
use App\Livewire\Worker\WorkerDashboard;
use App\Livewire\Client\ClientDashboard;
use App\Livewire\Workers\Timesheets;
use App\Livewire\Workers\WorkerCertifications;
use App\Livewire\Workers\WorkerEdit;
use App\Livewire\Workers\WorkerIndex;
use App\Livewire\Workers\WorkerShow;
use App\Livewire\Workers\WorkerSkills;
use App\Livewire\Dashboard;
use Illuminate\Support\Facades\Auth;
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
    Route::middleware(['auth', 'verified'])->group(function () {
        Route::get('/', Dashboard::class)->name('dashboard');
        Route::get('/client', ClientDashboard::class)->name('client.dashboard')->middleware('client');
        Route::get('/my', WorkerDashboard::class)->name('worker.dashboard');

        Route::get('tasks', TaskIndex::class)->name('tasks');
        Route::get('users', UserIndex::class)->name('users');
        Route::get('billing', BillingIndex::class)->name('billing');
        Route::get('features', FeatureIndex::class)->name('features');
        Route::get('pricing', PricingIndex::class)->name('pricing');

        // User CRUD routes
        Route::get('/users', UserIndex::class)->name('users');
        Route::get('/users/create', UserCreate::class)->name('users.create');
        Route::get('/users/{user}/edit', UserEdit::class)->name('users.edit');
        Route::get('/users/{user}', UserShow::class)->name('users.show');

        // Project CRUD routes
        Route::get('/projects', ProjectIndex::class)->name('projects');
        Route::get('/projects/create', ProjectCreate::class)->name('projects.create');
        Route::get('/projects/{project}/edit', ProjectEdit::class)->name('projects.edit');
        Route::get('/projects/{project}', ProjectShow::class)->name('projects.show');

        // Task CRUD routes
        Route::get('/tasks', TaskIndex::class)->name('tasks');
        Route::get('/tasks/create', TaskCreate::class)->name('tasks.create');
        Route::get('/tasks/{task}/edit', TaskEdit::class)->name('tasks.edit');
        Route::get('/tasks/{task}', TaskShow::class)->name('tasks.show');

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
        Route::get('/roles', \App\Livewire\Roles\RoleIndex::class)->name('roles.index');
        Route::get('/roles/create', \App\Livewire\Roles\Form::class)->name('roles.create');
        Route::get('/roles/{role}/edit', \App\Livewire\Roles\Form::class)->name('roles.edit')->where('role', '[0-9]+');

        // Permissions management routes
        Route::get('/permissions', \App\Livewire\Permissions\PermissionIndex::class)->name('permissions.index');
        Route::get('/permissions/create', \App\Livewire\Permissions\PermissionCreate::class)->name('permissions.create');
        Route::get('/permissions/{permission}/edit', \App\Livewire\Permissions\PermissionEdit::class)->name('permissions.edit');

        // Phases routes
        Route::get('/projects/{project}/phases', \App\Livewire\Projects\Phases\PhaseIndex::class)->name('phases.index');
        Route::get('/projects/{project}/phases/create', \App\Livewire\Projects\Phases\PhaseCreate::class)->name('phases.create');
        Route::get('/projects/{project}/phases/{phase}', \App\Livewire\Projects\Phases\PhaseShow::class)->name('phases.show');
        Route::get('/projects/{project}/phases/{phase}/edit', \App\Livewire\Projects\Phases\PhaseEdit::class)->name('phases.edit');

        // Milestones routes
        Route::get('/projects/{project}/milestones', \App\Livewire\Projects\Milestones\MilestoneIndex::class)->name('milestones.index');
        Route::get('/projects/{project}/milestones/create', \App\Livewire\Projects\Milestones\MilestoneCreate::class)->name('milestones.create');
        Route::get('/projects/{project}/milestones/{milestone}', \App\Livewire\Projects\Milestones\MilestoneShow::class)->name('milestones.show');
        Route::get('/projects/{project}/milestones/{milestone}/edit', \App\Livewire\Projects\Milestones\MilestoneEdit::class)->name('milestones.edit');

        // Discussions routes
        Route::get('/discussions', \App\Livewire\Discussions\DiscussionIndex::class)->name('discussions.index');
        Route::get('/discussions/create', \App\Livewire\Discussions\DiscussionCreate::class)->name('discussions.create');
        Route::get('/discussions/{discussion}', \App\Livewire\Discussions\DiscussionShow::class)->name('discussions.show');
        Route::get('/discussions/{discussion}/edit', \App\Livewire\Discussions\DiscussionEdit::class)->name('discussions.edit');

        // Files routes
        Route::get('/files', \App\Livewire\Files\FilesIndex::class)->name('files.index');
        Route::get('/files/upload', \App\Livewire\Files\Upload::class)->name('files.upload');

        // Vendors routes
        Route::get('/vendors', VendorIndex::class)->name('vendors');
        Route::get('/vendors/create', VendorCreate::class)->name('vendors.create');
        Route::get('/vendors/{vendor}/edit', VendorEdit::class)->name('vendors.edit');
        Route::get('/vendors/{vendor}', VendorShow::class)->name('vendors.show');

        // Vendor relationship routes
        Route::get('/vendors/{vendor}/contacts', VendorContacts::class)->name('vendor.contacts');
        Route::get('/vendors/{vendor}/services', VendorServices::class)->name('vendor.services');
        Route::get('/vendors/{vendor}/invoices', VendorInvoices::class)->name('vendor.invoices');
        Route::get('/vendors/{vendor}/projects', VendorProjects::class)->name('vendor.projects');
        Route::get('/vendors/{vendor}/tasks', VendorTasks::class)->name('vendor.tasks');

        // Purchase Orders routes
        Route::get('/purchase-orders', PurchaseOrderIndex::class)->name('purchase-orders');
        Route::get('/purchase-orders/create', PurchaseOrderCreate::class)->name('purchase-orders.create');
        Route::get('/purchase-orders/{purchase_order}/edit', PurchaseOrderEdit::class)->name('purchase-orders.edit');
        Route::get('/purchase-orders/{purchase_order}', PurchaseOrderShow::class)->name('purchase-orders.show');

        // Worker Management routes
        Route::get('/workers', WorkerIndex::class)->name('workers');
        Route::get('/workers/{workerProfile}', WorkerShow::class)->name('workers.show');
        Route::get('/workers/{workerProfile}/edit', WorkerEdit::class)->name('workers.edit');

        // Worker relationship routes
        Route::get('/workers/{workerId}/skills', WorkerSkills::class)->name('worker.skills');
        Route::get('/workers/{workerId}/certifications', WorkerCertifications::class)->name('worker.certifications');
        Route::get('/workers/{workerId}/timesheets', Timesheets::class)->name('worker.timesheets');

        // Worker-specific timesheets route for their own profile
        Route::get('/my-timesheets', function () {
            $user = auth()->user();
            $workerProfile = $user->workerProfile;
            if ($workerProfile) {
                return \Livewire::mount(Timesheets::class, ['workerId' => $workerProfile->id]);
            }
            abort(403, 'Access denied');
        })->name('my.timesheets');

        // Worker-specific skills route for their own profile
        Route::get('/my-skills', function () {
            $user = auth()->user();
            $workerProfile = $user->workerProfile;
            if ($workerProfile) {
                return \Livewire::mount(WorkerSkills::class, ['workerId' => $workerProfile->id]);
            }
            abort(403, 'Access denied');
        })->name('my.skills');

        // Expenses routes
        Route::get('/expenses', \App\Livewire\Expenses\ExpenseIndex::class)->name('expenses.index');
        Route::get('/expenses/create', \App\Livewire\Expenses\ExpenseCreate::class)->name('expenses.create');
        Route::get('/expenses/{expense}/edit', \App\Livewire\Expenses\ExpenseEdit::class)->name('expenses.edit');
        Route::get('/expenses/{expense}', \App\Livewire\Expenses\ExpenseShow::class)->name('expenses.show');
        Route::get('/expenses/{expense}/attachments', \App\Livewire\Expenses\ExpenseAttachments::class)->name('expenses.attachments');
        Route::get('/expenses/approvals', \App\Livewire\Expenses\ExpenseApprovals::class)->name('expenses.approvals');

        // Payments routes
        Route::get('/payments', \App\Livewire\Payments\PaymentIndex::class)->name('payments.index');
        Route::get('/payments/create', \App\Livewire\Payments\PaymentCreate::class)->name('payments.create');
        Route::get('/payments/{payment}/edit', \App\Livewire\Payments\PaymentEdit::class)->name('payments.edit');
        Route::get('/payments/{payment}', \App\Livewire\Payments\PaymentShow::class)->name('payments.show');

        // Payment reminders route
        Route::get('/payment-reminders', \App\Livewire\Payments\PaymentReminders::class)->name('payment-reminders.index');

        // Invoice payments route
        Route::get('/invoices/{invoice}/payments', \App\Livewire\Invoices\InvoicePayments::class)->name('invoices.payments');
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
    Route::get('/notifications', NotificationList::class)
        ->name('notifications.index')
        ->middleware(['auth']);

    require __DIR__ . '/auth.php';
});
