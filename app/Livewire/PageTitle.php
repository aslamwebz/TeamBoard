<?php

declare(strict_types=1);

namespace App\Livewire;

use Livewire\Component;

final class PageTitle extends Component
{
    public string $title = '';

    public string $icon = '';

    protected $listeners = ['pageTitleUpdated' => 'updateTitle'];

    public function mount(): void
    {
        $this->setTitleFromRoute();
    }

    public function updateTitle(string $title, string $icon = ''): void
    {
        $this->title = $title;
        $this->icon = $icon;
    }

    public function setTitleFromRoute(): void
    {
        $routeName = request()->route()->getName();

        $titles = [
            'dashboard' => ['Dashboard', 'chart-bar'],
            'client.dashboard' => ['Client Dashboard', 'user-group'],
            'worker.dashboard' => ['Worker Dashboard', 'identification'],
            'clients' => ['Clients', 'user-group'],
            'clients.index' => ['Clients', 'user-group'],
            'clients.show' => ['Client Details', 'user-group'],
            'clients.create' => ['Create Client', 'plus'],
            'clients.edit' => ['Edit Client', 'pencil'],
            'projects' => ['Projects', 'briefcase'],
            'projects.index' => ['Projects', 'briefcase'],
            'projects.show' => ['Project Details', 'briefcase'],
            'projects.create' => ['Create Project', 'plus'],
            'projects.edit' => ['Edit Project', 'pencil'],
            'tasks' => ['Tasks', 'list-bullet'],
            'tasks.index' => ['Tasks', 'list-bullet'],
            'tasks.show' => ['Task Details', 'list-bullet'],
            'tasks.create' => ['Create Task', 'plus'],
            'tasks.edit' => ['Edit Task', 'pencil'],
            'invoices' => ['Invoices', 'document-text'],
            'invoices.index' => ['Invoices', 'document-text'],
            'invoices.show' => ['Invoice Details', 'document-text'],
            'invoices.create' => ['Create Invoice', 'plus'],
            'invoices.edit' => ['Edit Invoice', 'pencil'],
            'expenses' => ['Expenses', 'receipt-percent'],
            'expenses.index' => ['Expenses', 'receipt-percent'],
            'expenses.show' => ['Expense Details', 'receipt-percent'],
            'expenses.create' => ['Create Expense', 'plus'],
            'expenses.edit' => ['Edit Expense', 'pencil'],
            'payments' => ['Payments', 'credit-card'],
            'payments.index' => ['Payments', 'credit-card'],
            'payments.show' => ['Payment Details', 'credit-card'],
            'payments.create' => ['Create Payment', 'plus'],
            'payments.edit' => ['Edit Payment', 'pencil'],
            'vendors' => ['Vendors', 'building-office'],
            'vendors.index' => ['Vendors', 'building-office'],
            'vendors.show' => ['Vendor Details', 'building-office'],
            'vendors.create' => ['Create Vendor', 'plus'],
            'vendors.edit' => ['Edit Vendor', 'pencil'],
            'workers' => ['Workers', 'identification'],
            'workers.show' => ['Worker Details', 'identification'],
            'workers.edit' => ['Edit Worker', 'pencil'],
            'home' => ['Home', 'home'],
            'users' => ['Users', 'identification'],
            'users.index' => ['Users', 'identification'],
            'users.show' => ['User Details', 'identification'],
            'users.create' => ['Create User', 'plus'],
            'users.edit' => ['Edit User', 'pencil'],
            'teams' => ['Teams', 'user-group'],
            'teams.index' => ['Teams', 'user-group'],
            'teams.show' => ['Team Details', 'user-group'],
            'teams.create' => ['Create Team', 'plus'],
            'teams.edit' => ['Edit Team', 'pencil'],
            'discussions' => ['Discussions', 'chat-bubble-left-right'],
            'discussions.index' => ['Discussions', 'chat-bubble-left-right'],
            'discussions.show' => ['Discussion Details', 'chat-bubble-left-right'],
            'discussions.create' => ['Create Discussion', 'plus'],
            'discussions.edit' => ['Edit Discussion', 'pencil'],
            'files' => ['Files', 'folder'],
            'files.index' => ['Files', 'folder'],
            'reports' => ['Reports', 'chart-bar'],
            'reports.show' => ['Report Details', 'chart-bar'],
            'reports.create' => ['Create Report', 'plus'],
            'reports.edit' => ['Edit Report', 'pencil'],
            'purchase-orders' => ['Purchase Orders', 'clipboard-document-list'],
            'purchase-orders.show' => ['Purchase Order Details', 'clipboard-document-list'],
            'purchase-orders.create' => ['Create Purchase Order', 'plus'],
            'purchase-orders.edit' => ['Edit Purchase Order', 'pencil'],
            'notifications' => ['Notifications', 'bell'],
            'notifications.index' => ['Notifications', 'bell'],
            'settings.profile' => ['Personal Settings', 'cog'],
            'settings.company-profile' => ['Company Profile', 'building-office-2'],
            'settings.appearance' => ['Appearance', 'paint-brush'],
        ];

        if (isset($titles[$routeName])) {
            [$this->title, $this->icon] = $titles[$routeName];
        } else {
            // Handle dynamic routes with wildcards
            foreach ($titles as $pattern => [$title, $icon]) {
                if (str_contains($pattern, '*') && str_starts_with($routeName, str_replace('*', '', $pattern))) {
                    $this->title = $title;
                    $this->icon = $icon;
                    break;
                }
            }
        }

        // Set default title if no match found
        if (! $this->title) {
            $this->title = 'Dashboard';
            $this->icon = 'chart-bar';
        }
    }

    public function render(): \Illuminate\View\View
    {
        return view('livewire.page-title');
    }
}
