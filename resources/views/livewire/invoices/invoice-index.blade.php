<div class="space-y-6">
    <div class="flex items-center justify-between">
        <div>
            <p class="text-muted-foreground">Manage your invoices and payments</p>
        </div>
        <flux:button :href="route('invoices.create')" class="flex items-center gap-2">
            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none"
                stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="h-4 w-4">
                <path d="M5 12h14"></path>
                <path d="M12 5v14"></path>
            </svg>
            Add Invoice
        </flux:button>
    </div>

    <!-- Filters -->
    <div class="bg-white dark:bg-zinc-800 rounded-lg border border-zinc-200 dark:border-zinc-700 p-4">
        <div class="grid gap-4 md:grid-cols-4">
            <div class="relative">
                <input type="text" wire:model.live.debounce.300ms="search" placeholder="Search invoices..."
                    class="w-full pl-10 pr-4 py-2 border border-zinc-300 rounded-lg dark:border-zinc-600 dark:bg-zinc-700 dark:text-zinc-300 focus:ring-2 focus:ring-sky-500 focus:border-sky-500">
                <svg class="absolute left-3 top-2.5 h-5 w-5 text-muted-foreground" fill="none" stroke="currentColor"
                    viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                </svg>
            </div>

            <select wire:model.live="status_filter"
                class="w-full px-3 py-2 border border-zinc-300 rounded-lg dark:border-zinc-600 dark:bg-zinc-700 dark:text-zinc-300 focus:ring-2 focus:ring-sky-500 focus:border-sky-500">
                <option value="">All Status</option>
                <option value="draft">Draft</option>
                <option value="sent">Sent</option>
                <option value="paid">Paid</option>
                <option value="overdue">Overdue</option>
                <option value="cancelled">Cancelled</option>
            </select>

            <select wire:model.live="client_filter"
                class="w-full px-3 py-2 border border-zinc-300 rounded-lg dark:border-zinc-600 dark:bg-zinc-700 dark:text-zinc-300 focus:ring-2 focus:ring-sky-500 focus:border-sky-500">
                <option value="">All Clients</option>
                @foreach ($clients as $client)
                    <option value="{{ $client->id }}">{{ $client->name }}</option>
                @endforeach
            </select>

            <select wire:model.live="per_page"
                class="w-full px-3 py-2 border border-zinc-300 rounded-lg dark:border-zinc-600 dark:bg-zinc-700 dark:text-zinc-300 focus:ring-2 focus:ring-sky-500 focus:border-sky-500">
                <option value="10">10 per page</option>
                <option value="25">25 per page</option>
                <option value="50">50 per page</option>
                <option value="100">100 per page</option>
            </select>
        </div>
    </div>

    <!-- Invoices Table -->
    <div class="bg-white dark:bg-zinc-800 rounded-lg border border-zinc-200 dark:border-zinc-700 overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full">
                <thead class="bg-zinc-50 dark:bg-zinc-700/50 border-b border-zinc-200 dark:border-zinc-600">
                    <tr>
                        <th
                            class="px-6 py-3 text-left text-xs font-medium text-zinc-500 dark:text-zinc-400 uppercase tracking-wider">
                            Invoice
                        </th>
                        <th
                            class="px-6 py-3 text-left text-xs font-medium text-zinc-500 dark:text-zinc-400 uppercase tracking-wider">
                            Client
                        </th>
                        <th
                            class="px-6 py-3 text-left text-xs font-medium text-zinc-500 dark:text-zinc-400 uppercase tracking-wider">
                            Issue Date
                        </th>
                        <th
                            class="px-6 py-3 text-left text-xs font-medium text-zinc-500 dark:text-zinc-400 uppercase tracking-wider">
                            Due Date
                        </th>
                        <th
                            class="px-6 py-3 text-left text-xs font-medium text-zinc-500 dark:text-zinc-400 uppercase tracking-wider">
                            Amount
                        </th>
                        <th
                            class="px-6 py-3 text-left text-xs font-medium text-zinc-500 dark:text-zinc-400 uppercase tracking-wider">
                            Status
                        </th>
                        <th
                            class="px-6 py-3 text-right text-xs font-medium text-zinc-500 dark:text-zinc-400 uppercase tracking-wider">
                            Actions
                        </th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-zinc-200 dark:divide-zinc-600">
                    @forelse($invoices as $invoice)
                        <tr class="hover:bg-zinc-50 dark:hover:bg-zinc-700/50 transition-colors">
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="text-sm font-medium text-foreground">
                                    <a href="{{ route('invoices.show', $invoice) }}"
                                        class="hover:text-sky-600 dark:hover:text-sky-500">
                                        {{ $invoice->invoice_number }}
                                    </a>
                                </div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="text-sm text-foreground">{{ $invoice->client->name }}</div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-muted-foreground">
                                {{ $invoice->issue_date->format('M d, Y') }}
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-muted-foreground">
                                {{ $invoice->due_date->format('M d, Y') }}
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="text-sm font-medium text-foreground">
                                    ${{ number_format($invoice->total, 2) }}
                                </div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <span
                                    class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium {{ $this->getInvoiceStatusBadgeClass($invoice->status) }}">
                                    {{ ucfirst($invoice->status) }}
                                </span>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                <div class="flex items-center justify-end gap-2">
                                    <flux:button variant="outline" size="sm"
                                        :href="route('invoices.show', $invoice)">
                                        View
                                    </flux:button>
                                    <flux:button variant="outline" size="sm"
                                        :href="route('invoices.edit', $invoice)">
                                        Edit
                                    </flux:button>
                                    <flux:tooltip content="Delete Invoice">
                                        <flux:button variant="outline" size="sm" color="red" type="button"
                                            wire:click="deleteInvoice({{ $invoice->id }})" class="h-8 w-8 p-0"
                                            title="Delete Invoice">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                                viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                                stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                                class="h-4 w-4">
                                                <path d="M3 6h18"></path>
                                                <path
                                                    d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2">
                                                </path>
                                            </svg>
                                        </flux:button>
                                    </flux:tooltip>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" class="px-6 py-12 text-center">
                                <svg xmlns="http://www.w3.org/2000/svg" width="48" height="48"
                                    viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                    stroke-linecap="round" stroke-linejoin="round"
                                    class="h-12 w-12 text-zinc-400 mx-auto mb-4">
                                    <path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"></path>
                                    <polyline points="14 2 14 8 20 8"></polyline>
                                    <line x1="16" y1="13" x2="8" y2="13"></line>
                                    <line x1="16" y1="17" x2="8" y2="17"></line>
                                    <polyline points="10 9 9 9 8 9"></polyline>
                                </svg>
                                <h3 class="text-lg font-medium text-foreground mb-2">No invoices found</h3>
                                <p class="text-zinc-500 dark:text-zinc-400 mb-6">Get started by creating your first
                                    invoice.</p>
                                <flux:button :href="route('invoices.create')" class="inline-flex items-center gap-2">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                        viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                        stroke-linecap="round" stroke-linejoin="round" class="h-4 w-4">
                                        <path d="M5 12h14"></path>
                                        <path d="M12 5v14"></path>
                                    </svg>
                                    Create Invoice
                                </flux:button>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    <!-- Pagination -->
    @if ($invoices->hasPages())
        <div class="mt-6">
            {{ $invoices->links() }}
        </div>
    @endif

    <!-- Delete Confirmation Modal -->
    @if ($confirmingDelete)
        <flux:modal name="delete-invoice">
            <div class="p-6">
                <h3 class="text-lg font-medium text-foreground">Delete Invoice</h3>
                <p class="mt-2 text-sm text-muted-foreground">
                    Are you sure you want to delete this invoice? This action cannot be undone.
                </p>
                <div class="mt-6 flex justify-end gap-3">
                    <flux:button variant="ghost" wire:click="cancelDelete">Cancel</flux:button>
                    <flux:button variant="danger" wire:click="confirmDelete">Delete Invoice</flux:button>
                </div>
            </div>
        </flux:modal>
    @endif
</div>
