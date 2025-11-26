<div class="space-y-6">
    <!-- Header -->
    <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4">
        <div>
            <h1 class="text-3xl font-bold text-foreground">Edit Invoice</h1>
            <p class="text-muted-foreground">Update invoice details for {{ $invoice->invoice_number }}</p>
        </div>
        <div class="flex gap-3">
            <a href="{{ route('invoices.show', $invoice) }}"
                class="px-4 py-2 border border-zinc-200 rounded-lg text-zinc-700 hover:bg-zinc-50 dark:border-zinc-700 dark:text-zinc-300 dark:hover:bg-zinc-700">
                View Invoice
            </a>
            <a href="{{ route('invoices.index') }}"
                class="px-4 py-2 border border-zinc-200 rounded-lg text-zinc-700 hover:bg-zinc-50 dark:border-zinc-700 dark:text-zinc-300 dark:hover:bg-zinc-700">
                Cancel
            </a>
        </div>
    </div>

    <!-- Invoice Form -->
    <div class="bg-white dark:bg-zinc-800 rounded-lg border border-zinc-200 dark:border-zinc-700">
        <form wire:submit="updateInvoice" class="p-6">
            <div class="grid gap-8 lg:grid-cols-2">
                <!-- Left Column -->
                <div class="space-y-6">
                    <!-- Client Selection -->
                    <div>
                        <label for="client_id" class="block text-sm font-medium text-zinc-700 dark:text-zinc-300 mb-2">
                            Client <span class="text-red-500">*</span>
                        </label>
                        <select id="client_id" wire:model="client_id"
                            class="w-full px-3 py-2 border border-zinc-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 dark:border-zinc-600 dark:bg-zinc-700 dark:text-white @error('client_id') border-red-500 @enderror">
                            <option value="">Select a client</option>
                            @foreach ($clients as $client)
                                <option value="{{ $client->id }}">{{ $client->name }} ({{ $client->email }})</option>
                            @endforeach
                        </select>
                        @error('client_id')
                            <p class="text-sm text-red-500 mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Project Selection -->
                    <div>
                        <label for="project_id" class="block text-sm font-medium text-zinc-700 dark:text-zinc-300 mb-2">
                            Project
                        </label>
                        <select id="project_id" wire:model="project_id"
                            class="w-full px-3 py-2 border border-zinc-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 dark:border-zinc-600 dark:bg-zinc-700 dark:text-white @error('project_id') border-red-500 @enderror">
                            <option value="">Select a project (optional)</option>
                            @foreach ($projects as $project)
                                <option value="{{ $project->id }}">{{ $project->name }}</option>
                            @endforeach
                        </select>
                        @error('project_id')
                            <p class="text-sm text-red-500 mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Invoice Number -->
                    <div>
                        <label for="invoice_number"
                            class="block text-sm font-medium text-zinc-700 dark:text-zinc-300 mb-2">
                            Invoice Number <span class="text-red-500">*</span>
                        </label>
                        <input type="text" id="invoice_number" wire:model="invoice_number" placeholder="INV-001"
                            class="w-full px-3 py-2 border border-zinc-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 dark:border-zinc-600 dark:bg-zinc-700 dark:text-white @error('invoice_number') border-red-500 @enderror">
                        @error('invoice_number')
                            <p class="text-sm text-red-500 mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Dates -->
                    <div class="grid grid-cols-2 gap-4">
                        <div>
                            <label for="issue_date"
                                class="block text-sm font-medium text-zinc-700 dark:text-zinc-300 mb-2">
                                Issue Date <span class="text-red-500">*</span>
                            </label>
                            <input type="date" id="issue_date" wire:model="issue_date"
                                class="w-full px-3 py-2 border border-zinc-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 dark:border-zinc-600 dark:bg-zinc-700 dark:text-white @error('issue_date') border-red-500 @enderror">
                            @error('issue_date')
                                <p class="text-sm text-red-500 mt-1">{{ $message }}</p>
                            @enderror
                        </div>
                        <div>
                            <label for="due_date"
                                class="block text-sm font-medium text-zinc-700 dark:text-zinc-300 mb-2">
                                Due Date <span class="text-red-500">*</span>
                            </label>
                            <input type="date" id="due_date" wire:model="due_date"
                                class="w-full px-3 py-2 border border-zinc-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 dark:border-zinc-600 dark:bg-zinc-700 dark:text-white @error('due_date') border-red-500 @enderror">
                            @error('due_date')
                                <p class="text-sm text-red-500 mt-1">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>
                </div>

                <!-- Right Column -->
                <div class="space-y-6">
                    <!-- Financial Information -->
                    <div class="bg-zinc-50 dark:bg-zinc-700/50 p-4 rounded-lg">
                        <h3 class="text-lg font-semibold text-foreground mb-4 flex items-center gap-2">
                            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24"
                                fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                stroke-linejoin="round" class="h-5 w-5 text-zinc-500">
                                <line x1="12" y1="1" x2="12" y2="23"></line>
                                <path d="M17 5H9.5a3.5 3.5 0 000 7h5a3.5 3.5 0 010 7H6"></path>
                            </svg>
                            Financial Details
                        </h3>
                        <div class="space-y-4">
                            <div>
                                <label for="amount"
                                    class="block text-sm font-medium text-zinc-700 dark:text-zinc-300 mb-2">
                                    Amount <span class="text-red-500">*</span>
                                </label>
                                <div class="relative">
                                    <span class="absolute left-3 top-2 text-zinc-500">$</span>
                                    <input type="number" id="amount" wire:model="amount" step="0.01"
                                        placeholder="0.00"
                                        class="w-full pl-8 pr-3 py-2 border border-zinc-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 dark:border-zinc-600 dark:bg-zinc-700 dark:text-white @error('amount') border-red-500 @enderror">
                                </div>
                                @error('amount')
                                    <p class="text-sm text-red-500 mt-1">{{ $message }}</p>
                                @enderror
                            </div>

                            <div>
                                <label for="tax"
                                    class="block text-sm font-medium text-zinc-700 dark:text-zinc-300 mb-2">
                                    Tax <span class="text-red-500">*</span>
                                </label>
                                <div class="relative">
                                    <span class="absolute left-3 top-2 text-zinc-500">$</span>
                                    <input type="number" id="tax" wire:model="tax" step="0.01"
                                        placeholder="0.00"
                                        class="w-full pl-8 pr-3 py-2 border border-zinc-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 dark:border-zinc-600 dark:bg-zinc-700 dark:text-white @error('tax') border-red-500 @enderror">
                                </div>
                                @error('tax')
                                    <p class="text-sm text-red-500 mt-1">{{ $message }}</p>
                                @enderror
                                <button type="button" wire:click="calculateTotal"
                                    class="mt-2 text-sm text-blue-600 hover:text-blue-700 font-medium">
                                    Calculate Total
                                </button>
                            </div>

                            <div>
                                <label for="total"
                                    class="block text-sm font-medium text-zinc-700 dark:text-zinc-300 mb-2">
                                    Total <span class="text-red-500">*</span>
                                </label>
                                <div class="relative">
                                    <span class="absolute left-3 top-2 text-zinc-500">$</span>
                                    <input type="number" id="total" wire:model="total" step="0.01" readonly
                                        class="w-full pl-8 pr-3 py-2 border border-zinc-300 rounded-lg bg-zinc-100 dark:bg-zinc-600 text-zinc-700 dark:text-zinc-300 @error('total') border-red-500 @enderror">
                                </div>
                                @error('total')
                                    <p class="text-sm text-red-500 mt-1">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <!-- Status -->
                    <div>
                        <label for="status" class="block text-sm font-medium text-zinc-700 dark:text-zinc-300 mb-2">
                            Status <span class="text-red-500">*</span>
                        </label>
                        <select id="status" wire:model="status"
                            class="w-full px-3 py-2 border border-zinc-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 dark:border-zinc-600 dark:bg-zinc-700 dark:text-white @error('status') border-red-500 @enderror">
                            <option value="draft">Draft</option>
                            <option value="sent">Sent</option>
                            <option value="paid">Paid</option>
                            <option value="overdue">Overdue</option>
                            <option value="cancelled">Cancelled</option>
                        </select>
                        @error('status')
                            <p class="text-sm text-red-500 mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                </div>
            </div>

            <!-- Description -->
            <div class="border-t border-zinc-200 dark:border-zinc-700 pt-6">
                <label for="description" class="block text-sm font-medium text-zinc-700 dark:text-zinc-300 mb-2">
                    Description
                </label>
                <textarea id="description" wire:model="description" rows="4"
                    placeholder="Add any additional notes or details about this invoice..."
                    class="w-full px-3 py-2 border border-zinc-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 dark:border-zinc-600 dark:bg-zinc-700 dark:text-white @error('description') border-red-500 @enderror"></textarea>
                @error('description')
                    <p class="text-sm text-red-500 mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- Form Actions -->
            <div class="flex justify-end gap-3 pt-6 border-t border-zinc-200 dark:border-zinc-700">
                <a href="{{ route('invoices.show', $invoice) }}"
                    class="px-4 py-2 border border-zinc-300 rounded-lg text-zinc-700 hover:bg-zinc-50 dark:border-zinc-600 dark:text-zinc-300 dark:hover:bg-zinc-700">
                    View Invoice
                </a>
                <a href="{{ route('invoices.index') }}"
                    class="px-4 py-2 border border-zinc-300 rounded-lg text-zinc-700 hover:bg-zinc-50 dark:border-zinc-600 dark:text-zinc-300 dark:hover:bg-zinc-700">
                    Cancel
                </a>
                <button type="submit"
                    class="px-6 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition-colors font-medium">
                    Update Invoice
                </button>
            </div>
        </form>
    </div>
</div>
