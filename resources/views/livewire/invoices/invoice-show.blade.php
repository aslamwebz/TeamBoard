<div class="space-y-6">
    <!-- Header -->
    <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4">
        <div>
            <h1 class="text-3xl font-bold text-foreground">Invoice Details</h1>
            <p class="text-muted-foreground">{{ $invoice->invoice_number }}</p>
        </div>
        <div class="flex gap-3">
            <a href="{{ route('invoices.index') }}"
                class="px-4 py-2 border border-zinc-200 rounded-lg text-zinc-700 hover:bg-zinc-50 dark:border-zinc-700 dark:text-zinc-300 dark:hover:bg-zinc-700">
                Back to Invoices
            </a>
            <a href="{{ route('invoices.edit', $invoice) }}"
                class="px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition-colors">
                Edit Invoice
            </a>
        </div>
    </div>

    <!-- Invoice Overview Cards -->
    <div class="grid gap-6 md:grid-cols-3">
        <!-- Invoice Status Card -->
        <div class="bg-white dark:bg-zinc-800 rounded-lg border border-zinc-200 dark:border-zinc-700 p-6">
            <div class="flex items-center justify-between mb-4">
                <h3 class="text-sm font-medium text-zinc-500 dark:text-zinc-400">Status</h3>
                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none"
                    stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                    class="h-5 w-5 text-zinc-400">
                    <path d="M9 11l3 3L22 4"></path>
                    <path d="M21 12v7a2 2 0 01-2 2H5a2 2 0 01-2-2V5a2 2 0 012-2h11"></path>
                </svg>
            </div>
            <span
                class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium
                @if ($invoice->status === 'draft') bg-gray-100 text-gray-800 dark:bg-gray-700 dark:text-gray-200
                @elseif($invoice->status === 'sent') bg-yellow-100 text-yellow-800 dark:bg-yellow-900/30 dark:text-yellow-400
                @elseif($invoice->status === 'paid') bg-green-100 text-green-800 dark:bg-green-900/30 dark:text-green-400
                @elseif($invoice->status === 'overdue') bg-red-100 text-red-800 dark:bg-red-900/30 dark:text-red-400
                @elseif($invoice->status === 'cancelled') bg-gray-300 text-gray-800 dark:bg-gray-600 dark:text-gray-300 @endif
            ">
                {{ ucfirst($invoice->status) }}
            </span>
        </div>

        <!-- Total Amount Card -->
        <div class="bg-white dark:bg-zinc-800 rounded-lg border border-zinc-200 dark:border-zinc-700 p-6">
            <div class="flex items-center justify-between mb-4">
                <h3 class="text-sm font-medium text-zinc-500 dark:text-zinc-400">Total Amount</h3>
                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none"
                    stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                    class="h-5 w-5 text-zinc-400">
                    <line x1="12" y1="1" x2="12" y2="23"></line>
                    <path d="M17 5H9.5a3.5 3.5 0 000 7h5a3.5 3.5 0 010 7H6"></path>
                </svg>
            </div>
            <p class="text-2xl font-bold text-foreground">${{ number_format($invoice->total, 2) }}</p>
        </div>

        <!-- Due Date Card -->
        <div class="bg-white dark:bg-zinc-800 rounded-lg border border-zinc-200 dark:border-zinc-700 p-6">
            <div class="flex items-center justify-between mb-4">
                <h3 class="text-sm font-medium text-zinc-500 dark:text-zinc-400">Due Date</h3>
                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none"
                    stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                    class="h-5 w-5 text-zinc-400">
                    <rect x="3" y="4" width="18" height="18" rx="2" ry="2"></rect>
                    <line x1="16" y1="2" x2="16" y2="6"></line>
                    <line x1="8" y1="2" x2="8" y2="6"></line>
                    <line x1="3" y1="10" x2="21" y2="10"></line>
                </svg>
            </div>
            <p class="text-lg font-semibold text-foreground">{{ $invoice->due_date->format('M d, Y') }}</p>
            @if ($invoice->status === 'overdue')
                <p class="text-sm text-red-600 dark:text-red-400 mt-1">Overdue</p>
            @endif
        </div>
    </div>

    <!-- Client and Invoice Details -->
    <div class="grid gap-6 lg:grid-cols-2">
        <!-- Client Information -->
        <div class="bg-white dark:bg-zinc-800 rounded-lg border border-zinc-200 dark:border-zinc-700 p-6">
            <div class="flex items-center justify-between mb-6">
                <h3 class="text-lg font-semibold text-foreground flex items-center gap-2">
                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24"
                        fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                        stroke-linejoin="round" class="h-5 w-5 text-zinc-500">
                        <path d="M16 21v-2a4 4 0 00-4-4H5a4 4 0 00-4 4v2"></path>
                        <circle cx="8.5" cy="7" r="4"></circle>
                        <path d="M20 8v6M23 11h-6"></path>
                    </svg>
                    Bill To
                </h3>
                <a href="{{ route('clients.show', $invoice->client) }}"
                    class="text-blue-600 hover:text-blue-700 text-sm font-medium">
                    View Client
                </a>
            </div>
            <div class="space-y-4">
                <div>
                    <p class="font-semibold text-foreground text-lg">{{ $invoice->client->name }}</p>
                    @if ($invoice->client->company_name)
                        <p class="text-zinc-600 dark:text-zinc-400">{{ $invoice->client->company_name }}</p>
                    @endif
                </div>
                <div class="space-y-2">
                    <div class="flex items-center gap-2 text-sm">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24"
                            fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                            stroke-linejoin="round" class="h-4 w-4 text-zinc-400">
                            <path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z">
                            </path>
                            <polyline points="22,6 12,13 2,6"></polyline>
                        </svg>
                        <span class="text-zinc-600 dark:text-zinc-400">{{ $invoice->client->email }}</span>
                    </div>
                    @if ($invoice->client->phone)
                        <div class="flex items-center gap-2 text-sm">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                stroke-linecap="round" stroke-linejoin="round" class="h-4 w-4 text-zinc-400">
                                <path
                                    d="M22 16.92v3a2 2 0 01-2.18 2 19.79 19.79 0 01-8.63-3.07 19.5 19.5 0 01-6-6 19.79 19.79 0 01-3.07-8.67A2 2 0 014.11 2h3a2 2 0 012 1.72 12.84 12.84 0 00.7 2.81 2 2 0 01-.45 2.11L8.09 9.91a16 16 0 006 6l1.27-1.27a2 2 0 012.11-.45 12.84 12.84 0 002.81.7A2 2 0 0122 16.92z">
                                </path>
                            </svg>
                            <span class="text-zinc-600 dark:text-zinc-400">{{ $invoice->client->phone }}</span>
                        </div>
                    @endif
                    @if ($invoice->client->address || $invoice->client->city || $invoice->client->country)
                        <div class="flex items-start gap-2 text-sm">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                stroke-linecap="round" stroke-linejoin="round" class="h-4 w-4 text-zinc-400 mt-0.5">
                                <path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0118 0z"></path>
                                <circle cx="12" cy="10" r="3"></circle>
                            </svg>
                            <span class="text-zinc-600 dark:text-zinc-400">
                                {{ collect([$invoice->client->address, $invoice->client->city, $invoice->client->state, $invoice->client->zip_code, $invoice->client->country])->filter()->implode(', ') }}
                            </span>
                        </div>
                    @endif
                </div>
            </div>
        </div>

        <!-- Invoice Information -->
        <div class="bg-white dark:bg-zinc-800 rounded-lg border border-zinc-200 dark:border-zinc-700 p-6">
            <h3 class="text-lg font-semibold text-foreground mb-6 flex items-center gap-2">
                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24"
                    fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                    stroke-linejoin="round" class="h-5 w-5 text-zinc-500">
                    <path d="M14 2H6a2 2 0 00-2 2v16a2 2 0 002 2h12a2 2 0 002-2V8z"></path>
                    <polyline points="14 2 14 8 20 8"></polyline>
                    <line x1="16" y1="13" x2="8" y2="13"></line>
                    <line x1="16" y1="17" x2="8" y2="17"></line>
                    <polyline points="10 9 9 9 8 9"></polyline>
                </svg>
                Invoice Information
            </h3>
            <div class="space-y-4">
                <div class="flex justify-between items-center py-2 border-b border-zinc-100 dark:border-zinc-700">
                    <span class="text-sm text-zinc-500 dark:text-zinc-400">Invoice Number</span>
                    <span class="font-medium text-foreground">{{ $invoice->invoice_number }}</span>
                </div>
                <div class="flex justify-between items-center py-2 border-b border-zinc-100 dark:border-zinc-700">
                    <span class="text-sm text-zinc-500 dark:text-zinc-400">Issue Date</span>
                    <span class="font-medium text-foreground">{{ $invoice->issue_date->format('M d, Y') }}</span>
                </div>
                <div class="flex justify-between items-center py-2 border-b border-zinc-100 dark:border-zinc-700">
                    <span class="text-sm text-zinc-500 dark:text-zinc-400">Due Date</span>
                    <span class="font-medium text-foreground">{{ $invoice->due_date->format('M d, Y') }}</span>
                </div>
                @if ($invoice->project)
                    <div class="flex justify-between items-center py-2 border-b border-zinc-100 dark:border-zinc-700">
                        <span class="text-sm text-zinc-500 dark:text-zinc-400">Project</span>
                        <a href="{{ route('projects.show', $invoice->project) }}"
                            class="font-medium text-blue-600 hover:text-blue-700">{{ $invoice->project->name }}</a>
                    </div>
                @endif
            </div>
        </div>
    </div>

    <!-- Financial Summary -->
    <div class="bg-white dark:bg-zinc-800 rounded-lg border border-zinc-200 dark:border-zinc-700 p-6">
        <h3 class="text-lg font-semibold text-foreground mb-6 flex items-center gap-2">
            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24"
                fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                stroke-linejoin="round" class="h-5 w-5 text-zinc-500">
                <line x1="12" y1="1" x2="12" y2="23"></line>
                <path d="M17 5H9.5a3.5 3.5 0 000 7h5a3.5 3.5 0 010 7H6"></path>
            </svg>
            Financial Summary
        </h3>
        <div class="grid gap-4 md:grid-cols-3">
            <div class="bg-zinc-50 dark:bg-zinc-700/50 p-4 rounded-lg">
                <h4 class="text-sm font-medium text-zinc-500 dark:text-zinc-400 mb-1">Subtotal</h4>
                <p class="text-xl font-bold text-foreground">${{ number_format($invoice->amount, 2) }}</p>
            </div>
            <div class="bg-zinc-50 dark:bg-zinc-700/50 p-4 rounded-lg">
                <h4 class="text-sm font-medium text-zinc-500 dark:text-zinc-400 mb-1">Tax</h4>
                <p class="text-xl font-bold text-foreground">${{ number_format($invoice->tax, 2) }}</p>
            </div>
            <div class="bg-blue-600 text-white p-4 rounded-lg">
                <h4 class="text-sm font-medium text-blue-100 mb-1">Total Amount</h4>
                <p class="text-2xl font-bold">${{ number_format($invoice->total, 2) }}</p>
            </div>
        </div>
    </div>

    @if ($invoice->description)
        <!-- Description -->
        <div class="bg-white dark:bg-zinc-800 rounded-lg border border-zinc-200 dark:border-zinc-700 p-6">
            <h3 class="text-lg font-semibold text-foreground mb-4 flex items-center gap-2">
                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24"
                    fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                    stroke-linejoin="round" class="h-5 w-5 text-zinc-500">
                    <path d="M21 15a2 2 0 01-2 2H7l-4 4V5a2 2 0 012-2h14a2 2 0 012 2z"></path>
                </svg>
                Description
            </h3>
            <p class="text-zinc-600 dark:text-zinc-400 leading-relaxed">{{ $invoice->description }}</p>
        </div>
    @endif
</div>
