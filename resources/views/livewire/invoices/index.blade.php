<div class="space-y-6">
    <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4">
        <div>
            <h1 class="text-3xl font-bold text-foreground">Invoices</h1>
            <p class="text-muted-foreground">Manage your invoices and payments</p>
        </div>
        <a href="{{ route('invoices.create') }}"
            class="inline-flex items-center gap-2 px-4 py-2 bg-primary text-primary-foreground rounded-lg hover:bg-primary/90 transition-colors">
            <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                xmlns="http://www.w3.org/2000/svg">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6">
                </path>
            </svg>
            Add Invoice
        </a>
    </div>

    <!-- Search and Filters -->
    <div class="flex flex-col sm:flex-row gap-4">
        <div class="relative flex-1 max-w-md">
            <input type="text" wire:model.live.debounce.300ms="search" placeholder="Search invoices..."
                class="w-full pl-10 pr-4 py-2 border border-zinc-200 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent dark:border-zinc-700 dark:bg-zinc-800 dark:text-zinc-300">
            <svg class="absolute left-3 top-2.5 h-5 w-5 text-zinc-400" fill="none" stroke="currentColor"
                viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
            </svg>
        </div>

        <div class="flex gap-2">
            <flux:dropdown>
                <flux:button variant="ghost">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24"
                        fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                        stroke-linejoin="round" class="h-4 w-4">
                        <path d="M3 12h18"></path>
                        <path d="M3 6h18"></path>
                        <path d="M3 18h18"></path>
                    </svg>
                    All Status
                </flux:button>
                <flux:menu>
                    <button type="button" wire:click="setFilter('all')"
                        class="block w-full px-4 py-2 text-left text-sm text-zinc-700 hover:bg-zinc-100 dark:text-zinc-200 dark:hover:bg-zinc-700">
                        All Status
                    </button>
                    <button type="button" wire:click="setFilter('draft')"
                        class="block w-full px-4 py-2 text-left text-sm text-zinc-700 hover:bg-zinc-100 dark:text-zinc-200 dark:hover:bg-zinc-700">
                        Draft
                    </button>
                    <button type="button" wire:click="setFilter('sent')"
                        class="block w-full px-4 py-2 text-left text-sm text-zinc-700 hover:bg-zinc-100 dark:text-zinc-200 dark:hover:bg-zinc-700">
                        Sent
                    </button>
                    <button type="button" wire:click="setFilter('paid')"
                        class="block w-full px-4 py-2 text-left text-sm text-zinc-700 hover:bg-zinc-100 dark:text-zinc-200 dark:hover:bg-zinc-700">
                        Paid
                    </button>
                    <button type="button" wire:click="setFilter('overdue')"
                        class="block w-full px-4 py-2 text-left text-sm text-zinc-700 hover:bg-zinc-100 dark:text-zinc-200 dark:hover:bg-zinc-700">
                        Overdue
                    </button>
                    <button type="button" wire:click="setFilter('cancelled')"
                        class="block w-full px-4 py-2 text-left text-sm text-zinc-700 hover:bg-zinc-100 dark:text-zinc-200 dark:hover:bg-zinc-700">
                        Cancelled
                    </button>
                </flux:menu>
            </flux:dropdown>
        </div>
    </div>

    @if ($invoices->count() > 0)
        <div class="grid gap-6 md:grid-cols-2 lg:grid-cols-3">
            @foreach ($invoices as $invoice)
                <div
                    class="bg-white dark:bg-zinc-800 rounded-lg border border-zinc-200 dark:border-zinc-700 overflow-hidden hover:shadow-lg transition-shadow">
                    <!-- Invoice Header -->
                    <div class="p-6 pb-4">
                        <div class="flex items-start justify-between">
                            <div class="space-y-1 flex-1">
                                <h3 class="text-lg font-semibold text-foreground hover:text-blue-600 transition-colors">
                                    <a href="{{ route('invoices.show', $invoice) }}">{{ $invoice->invoice_number }}</a>
                                </h3>
                                <p class="text-sm text-zinc-500 dark:text-zinc-400">{{ $invoice->client->name }}</p>
                            </div>
                            <span
                                class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium
                                @if ($invoice->status === 'draft') bg-gray-100 text-gray-800 dark:bg-gray-700 dark:text-gray-200
                                @elseif($invoice->status === 'sent') bg-yellow-100 text-yellow-800 dark:bg-yellow-900/30 dark:text-yellow-400
                                @elseif($invoice->status === 'paid') bg-green-100 text-green-800 dark:bg-green-900/30 dark:text-green-400
                                @elseif($invoice->status === 'overdue') bg-red-100 text-red-800 dark:bg-red-900/30 dark:text-red-400
                                @elseif($invoice->status === 'cancelled') bg-gray-300 text-gray-800 dark:bg-gray-600 dark:text-gray-300 @endif
                            ">
                                {{ ucfirst($invoice->status) }}
                            </span>
                        </div>
                    </div>

                    <!-- Invoice Details -->
                    <div class="px-6 pb-4">
                        <div class="space-y-3">
                            <div class="flex justify-between items-center">
                                <span class="text-sm text-zinc-500 dark:text-zinc-400">Issue Date</span>
                                <span
                                    class="text-sm font-medium text-foreground">{{ $invoice->issue_date->format('M d, Y') }}</span>
                            </div>
                            <div class="flex justify-between items-center">
                                <span class="text-sm text-zinc-500 dark:text-zinc-400">Due Date</span>
                                <span
                                    class="text-sm font-medium text-foreground">{{ $invoice->due_date->format('M d, Y') }}</span>
                            </div>
                            <div class="flex justify-between items-center">
                                <span class="text-sm text-zinc-500 dark:text-zinc-400">Total Amount</span>
                                <span
                                    class="text-lg font-semibold text-foreground">${{ number_format($invoice->total, 2) }}</span>
                            </div>
                        </div>
                    </div>

                    <!-- Invoice Actions -->
                    <div class="px-6 py-4 border-t border-zinc-200 dark:border-zinc-700 bg-zinc-50 dark:bg-zinc-700/50">
                        <div class="flex items-center justify-between">
                            <div class="flex gap-2">
                                <a href="{{ route('invoices.show', $invoice) }}"
                                    class="p-2 text-zinc-500 hover:text-blue-600 dark:text-zinc-400 dark:hover:text-blue-400 transition-colors"
                                    title="View Invoice">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                        viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                        stroke-linecap="round" stroke-linejoin="round" class="h-4 w-4">
                                        <path d="M2 12s3-7 10-7 10 7 10 7-3 7-10 7-10-7-10-7Z"></path>
                                        <circle cx="12" cy="12" r="3"></circle>
                                    </svg>
                                </a>
                                <a href="{{ route('invoices.edit', $invoice) }}"
                                    class="p-2 text-zinc-500 hover:text-blue-600 dark:text-zinc-400 dark:hover:text-blue-400 transition-colors"
                                    title="Edit Invoice">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                        viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                        stroke-linecap="round" stroke-linejoin="round" class="h-4 w-4">
                                        <path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"></path>
                                        <path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z"></path>
                                    </svg>
                                </a>
                                <button type="button" wire:click="deleteInvoice({{ $invoice->id }})"
                                    class="p-2 text-zinc-500 hover:text-red-600 dark:text-zinc-400 dark:hover:text-red-400 transition-colors"
                                    title="Delete Invoice">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                        viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                        stroke-linecap="round" stroke-linejoin="round" class="h-4 w-4">
                                        <polyline points="3 6 5 6 21 6"></polyline>
                                        <path
                                            d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2">
                                        </path>
                                    </svg>
                                </button>
                            </div>
                            @if ($invoice->status === 'overdue')
                                <span class="text-xs text-red-600 dark:text-red-400 font-medium">Overdue</span>
                            @endif
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
        <!-- Pagination -->
        <div class="mt-6">
            {{ $invoices->links() }}
        </div>
    @else
        <div class="text-center py-12">
            <svg xmlns="http://www.w3.org/2000/svg" width="48" height="48" viewBox="0 0 24 24"
                fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                stroke-linejoin="round" class="h-12 w-12 text-zinc-400 mx-auto mb-4">
                <path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"></path>
                <polyline points="14 2 14 8 20 8"></polyline>
                <line x1="16" y1="13" x2="8" y2="13"></line>
                <line x1="16" y1="17" x2="8" y2="17"></line>
                <polyline points="10 9 9 9 8 9"></polyline>
            </svg>
            <h3 class="text-lg font-medium text-foreground mb-2">No invoices found</h3>
            <p class="text-zinc-500 dark:text-zinc-400 mb-6">Get started by creating your first invoice.</p>
            <a href="{{ route('invoices.create') }}"
                class="inline-flex items-center gap-2 px-4 py-2 bg-primary text-primary-foreground rounded-lg hover:bg-primary/90 transition-colors">
                <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                    xmlns="http://www.w3.org/2000/svg">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                </svg>
                Create Invoice
            </a>
        </div>
    @endif
</div>
