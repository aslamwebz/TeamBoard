<div class="space-y-6">
    <div class="flex items-center justify-between">
        <div>
            <p class="text-muted-foreground">Vendor details and relationships</p>
        </div>
        <div class="flex gap-3">
            <flux:button :href="route('vendors.edit', $vendor->id)">
                Edit Vendor
            </flux:button>
            <flux:button :href="route('vendors')" variant="outline">
                Back to Vendors
            </flux:button>
        </div>
    </div>

    <!-- Vendor Information -->
    <div class="bg-white dark:bg-zinc-800 rounded-lg border border-zinc-200 dark:border-zinc-700 p-6">
        <h3 class="text-lg font-semibold text-foreground mb-6">Vendor Information</h3>
        <div class="grid gap-6 md:grid-cols-2">
            <div class="space-y-4">
                <div>
                    <div class="text-sm font-medium text-zinc-500 dark:text-zinc-400">Company Name</div>
                    <div class="text-sm text-foreground">{{ $vendor->name }}</div>
                </div>

                <div>
                    <div class="text-sm font-medium text-zinc-500 dark:text-zinc-400">Email</div>
                    <div class="text-sm text-foreground">{{ $vendor->email ?? 'N/A' }}</div>
                </div>

                <div>
                    <div class="text-sm font-medium text-zinc-500 dark:text-zinc-400">Phone</div>
                    <div class="text-sm text-foreground">{{ $vendor->phone ?? 'N/A' }}</div>
                </div>

                <div>
                    <div class="text-sm font-medium text-zinc-500 dark:text-zinc-400">Website</div>
                    <div class="text-sm text-foreground">
                        @if ($vendor->website)
                            <a href="{{ $vendor->website }}" target="_blank"
                                class="text-sky-600 hover:text-sky-800 dark:text-sky-400">{{ $vendor->website }}</a>
                        @else
                            N/A
                        @endif
                    </div>
                </div>

                <div>
                    <div class="text-sm font-medium text-zinc-500 dark:text-zinc-400">Tax ID</div>
                    <div class="text-sm text-foreground">{{ $vendor->tax_id ?? 'N/A' }}</div>
                </div>
            </div>

            <div class="space-y-4">
                <div>
                    <div class="text-sm font-medium text-zinc-500 dark:text-zinc-400">Status</div>
                    <div class="text-sm">
                        <span
                            class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium
                            {{ $this->getVendorStatusBadgeClass($vendor->status) }}">
                            {{ ucfirst($vendor->status) }}
                        </span>
                    </div>
                </div>

                <div>
                    <div class="text-sm font-medium text-zinc-500 dark:text-zinc-400">Rating</div>
                    <div class="text-sm text-foreground">
                        <div class="flex items-center">
                            <span class="font-medium">{{ number_format($vendor->rating, 1) }}/5.0</span>
                            <div class="ml-1 flex">
                                @for ($i = 1; $i <= 5; $i++)
                                    <svg class="w-4 h-4 {{ $i <= round($vendor->rating) ? 'text-yellow-400' : 'text-gray-300' }}"
                                        fill="currentColor" viewBox="0 0 20 20">
                                        <path
                                            d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
                                    </svg>
                                @endfor
                            </div>
                        </div>
                    </div>
                </div>

                <div>
                    <div class="text-sm font-medium text-zinc-500 dark:text-zinc-400">Payment Terms</div>
                    <div class="text-sm text-foreground">{{ $vendor->payment_terms ?? 'N/A' }}</div>
                </div>

                <div>
                    <div class="text-sm font-medium text-zinc-500 dark:text-zinc-400">Credit Limit</div>
                    <div class="text-sm text-foreground">
                        {{ $vendor->credit_limit ? '$' . number_format($vendor->credit_limit, 2) : 'N/A' }}</div>
                </div>

                <div>
                    <div class="text-sm font-medium text-zinc-500 dark:text-zinc-400">Last Transaction</div>
                    <div class="text-sm text-foreground">
                        {{ $vendor->last_transaction_date ? $vendor->last_transaction_date->format('M j, Y') : 'Never' }}
                    </div>
                </div>
            </div>
        </div>

        <div class="mt-6">
            <div class="text-sm font-medium text-zinc-500 dark:text-zinc-400">Address</div>
            <div class="mt-1 text-sm text-foreground">
                {{ $vendor->address ?? 'N/A' }}<br>
                @if ($vendor->city || $vendor->state || $vendor->zip_code)
                    {{ $vendor->city ?? '' }}{{ $vendor->city ? ', ' : '' }}{{ $vendor->state ?? '' }}
                    {{ $vendor->zip_code ?? '' }}<br>
                @endif
                {{ $vendor->country ?? 'N/A' }}
            </div>
        </div>

        @if ($vendor->description)
            <div class="mt-6">
                <div class="text-sm font-medium text-zinc-500 dark:text-zinc-400">Description</div>
                <div class="mt-1 text-sm text-foreground">{{ $vendor->description }}</div>
            </div>
        @endif
    </div>

    <!-- Related Data Sections -->
    <div class="bg-white dark:bg-zinc-800 rounded-lg border border-zinc-200 dark:border-zinc-700">
        <div class="border-b border-zinc-200 dark:border-zinc-700">
            <nav class="-mb-px flex space-x-8 px-6">
                <button wire:click="setActiveTab('contacts')"
                    class="border-b-2 font-medium text-sm whitespace-nowrap py-4 px-1 transition-colors
                    {{ $activeTab === 'contacts'
                        ? 'border-sky-500 text-sky-600 dark:border-sky-400 dark:text-sky-400'
                        : 'border-transparent text-zinc-500 hover:text-foreground hover:border-zinc-300 dark:text-zinc-400 dark:hover:text-zinc-300 dark:hover:border-zinc-600' }}">
                    Contacts ({{ $vendor->contacts->count() }})
                </button>

                <button wire:click="setActiveTab('services')"
                    class="border-b-2 font-medium text-sm whitespace-nowrap py-4 px-1 transition-colors
                    {{ $activeTab === 'services'
                        ? 'border-sky-500 text-sky-600 dark:border-sky-400 dark:text-sky-400'
                        : 'border-transparent text-zinc-500 hover:text-foreground hover:border-zinc-300 dark:text-zinc-400 dark:hover:text-zinc-300 dark:hover:border-zinc-600' }}">
                    Services ({{ $vendor->services->count() }})
                </button>

                <button wire:click="setActiveTab('invoices')"
                    class="border-b-2 font-medium text-sm whitespace-nowrap py-4 px-1 transition-colors
                    {{ $activeTab === 'invoices'
                        ? 'border-sky-500 text-sky-600 dark:border-sky-400 dark:text-sky-400'
                        : 'border-transparent text-zinc-500 hover:text-foreground hover:border-zinc-300 dark:text-zinc-400 dark:hover:text-zinc-300 dark:hover:border-zinc-600' }}">
                    Invoices ({{ $vendor->invoices->count() }})
                </button>

                <button wire:click="setActiveTab('projects')"
                    class="border-b-2 font-medium text-sm whitespace-nowrap py-4 px-1 transition-colors
                    {{ $activeTab === 'projects'
                        ? 'border-sky-500 text-sky-600 dark:border-sky-400 dark:text-sky-400'
                        : 'border-transparent text-zinc-500 hover:text-foreground hover:border-zinc-300 dark:text-zinc-400 dark:hover:text-zinc-300 dark:hover:border-zinc-600' }}">
                    Projects ({{ $vendor->projects->count() }})
                </button>

                <button wire:click="setActiveTab('tasks')"
                    class="border-b-2 font-medium text-sm whitespace-nowrap py-4 px-1 transition-colors
                    {{ $activeTab === 'tasks'
                        ? 'border-sky-500 text-sky-600 dark:border-sky-400 dark:text-sky-400'
                        : 'border-transparent text-zinc-500 hover:text-foreground hover:border-zinc-300 dark:text-zinc-400 dark:hover:text-zinc-300 dark:hover:border-zinc-600' }}">
                    Tasks ({{ $vendor->tasks->count() }})
                </button>
            </nav>
        </div>

        <div class="p-6">
            @if ($activeTab === 'contacts')
                <h3 class="text-lg font-semibold text-foreground mb-4">Vendor Contacts</h3>
                @if ($vendor->contacts->count() > 0)
                    <div class="overflow-x-auto">
                        <table class="w-full">
                            <thead class="bg-zinc-50 dark:bg-zinc-700/50 border-b border-zinc-200 dark:border-zinc-600">
                                <tr>
                                    <th
                                        class="px-6 py-3 text-left text-xs font-medium text-zinc-500 dark:text-zinc-400 uppercase tracking-wider">
                                        Name
                                    </th>
                                    <th
                                        class="px-6 py-3 text-left text-xs font-medium text-zinc-500 dark:text-zinc-400 uppercase tracking-wider">
                                        Position
                                    </th>
                                    <th
                                        class="px-6 py-3 text-left text-xs font-medium text-zinc-500 dark:text-zinc-400 uppercase tracking-wider">
                                        Contact
                                    </th>
                                    <th
                                        class="px-6 py-3 text-left text-xs font-medium text-zinc-500 dark:text-zinc-400 uppercase tracking-wider">
                                        Primary
                                    </th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-zinc-200 dark:divide-zinc-600">
                                @foreach ($vendor->contacts as $contact)
                                    <tr class="hover:bg-zinc-50 dark:hover:bg-zinc-700/50 transition-colors">
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <div class="text-sm font-medium text-foreground">{{ $contact->full_name }}
                                            </div>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <div class="text-sm text-foreground">{{ $contact->position ?? 'N/A' }}
                                            </div>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <div class="text-sm text-foreground">{{ $contact->email }}</div>
                                            <div class="text-sm text-muted-foreground">{{ $contact->phone ?? 'N/A' }}
                                            </div>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <span
                                                class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium
                                                {{ $contact->is_primary ? 'bg-green-100 text-green-800 dark:bg-green-900/30 dark:text-green-400' : 'bg-zinc-100 text-zinc-800 dark:bg-zinc-700/30 dark:text-zinc-400' }}">
                                                {{ $contact->is_primary ? 'Yes' : 'No' }}
                                            </span>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                @else
                    <div class="text-center py-4 text-zinc-500 dark:text-zinc-400">
                        No contacts found for this vendor.
                    </div>
                @endif
            @endif

            <!-- Services Tab -->
            @if ($activeTab === 'services')
                <h3 class="text-lg font-semibold text-foreground mb-4">Services Offered</h3>
                @if ($vendor->services->count() > 0)
                    <div class="overflow-x-auto">
                        <table class="w-full">
                            <thead class="bg-zinc-50 dark:bg-zinc-700/50 border-b border-zinc-200 dark:border-zinc-600">
                                <tr>
                                    <th
                                        class="px-6 py-3 text-left text-xs font-medium text-zinc-500 dark:text-zinc-400 uppercase tracking-wider">
                                        Service
                                    </th>
                                    <th
                                        class="px-6 py-3 text-left text-xs font-medium text-zinc-500 dark:text-zinc-400 uppercase tracking-wider">
                                        Category
                                    </th>
                                    <th
                                        class="px-6 py-3 text-left text-xs font-medium text-zinc-500 dark:text-zinc-400 uppercase tracking-wider">
                                        Unit Price
                                    </th>
                                    <th
                                        class="px-6 py-3 text-left text-xs font-medium text-zinc-500 dark:text-zinc-400 uppercase tracking-wider">
                                        Status
                                    </th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-zinc-200 dark:divide-zinc-600">
                                @foreach ($vendor->services as $service)
                                    <tr class="hover:bg-zinc-50 dark:hover:bg-zinc-700/50 transition-colors">
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <div class="text-sm font-medium text-foreground">{{ $service->name }}</div>
                                            <div class="text-sm text-muted-foreground">
                                                {{ $service->description ?: 'No description' }}</div>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <div class="text-sm text-foreground">{{ $service->category ?: 'N/A' }}
                                            </div>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-foreground">
                                            {{ $service->unit_price ? '$' . number_format($service->unit_price, 2) : 'N/A' }}
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <span
                                                class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium
                                                {{ $service->is_active ? 'bg-green-100 text-green-800 dark:bg-green-900/30 dark:text-green-400' : 'bg-zinc-100 text-zinc-800 dark:bg-zinc-700/30 dark:text-zinc-400' }}">
                                                {{ $service->is_active ? 'Active' : 'Inactive' }}
                                            </span>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                @else
                    <div class="text-center py-4 text-zinc-500 dark:text-zinc-400">
                        No services found for this vendor.
                    </div>
                @endif
            @endif

            <!-- Invoices Tab -->
            @if ($activeTab === 'invoices')
                <h3 class="text-lg font-semibold text-foreground mb-4">Recent Invoices</h3>
                @if ($vendor->invoices->count() > 0)
                    <div class="overflow-x-auto">
                        <table class="w-full">
                            <thead
                                class="bg-zinc-50 dark:bg-zinc-700/50 border-b border-zinc-200 dark:border-zinc-600">
                                <tr>
                                    <th
                                        class="px-6 py-3 text-left text-xs font-medium text-zinc-500 dark:text-zinc-400 uppercase tracking-wider">
                                        Invoice #
                                    </th>
                                    <th
                                        class="px-6 py-3 text-left text-xs font-medium text-zinc-500 dark:text-zinc-400 uppercase tracking-wider">
                                        Date
                                    </th>
                                    <th
                                        class="px-6 py-3 text-left text-xs font-medium text-zinc-500 dark:text-zinc-400 uppercase tracking-wider">
                                        Amount
                                    </th>
                                    <th
                                        class="px-6 py-3 text-left text-xs font-medium text-zinc-500 dark:text-zinc-400 uppercase tracking-wider">
                                        Status
                                    </th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-zinc-200 dark:divide-zinc-600">
                                @foreach ($vendor->invoices->take(5) as $invoice)
                                    <tr class="hover:bg-zinc-50 dark:hover:bg-zinc-700/50 transition-colors">
                                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-foreground">
                                            {{ $invoice->invoice_number }}
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-foreground">
                                            {{ $invoice->invoice_date->format('M j, Y') }}
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-foreground">
                                            ${{ number_format($invoice->total_amount, 2) }}
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <span
                                                class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium
                                                {{ $this->getInvoiceStatusBadgeClass($invoice->status) }}">
                                                {{ ucfirst($invoice->status) }}
                                            </span>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                @else
                    <div class="text-center py-4 text-zinc-500 dark:text-zinc-400">
                        No invoices found for this vendor.
                    </div>
                @endif
            @endif

            <!-- Projects Tab -->
            @if ($activeTab === 'projects')
                <h3 class="text-lg font-semibold text-foreground mb-4">Projects</h3>
                @if ($vendor->projects->count() > 0)
                    <div class="overflow-x-auto">
                        <table class="w-full">
                            <thead
                                class="bg-zinc-50 dark:bg-zinc-700/50 border-b border-zinc-200 dark:border-zinc-600">
                                <tr>
                                    <th
                                        class="px-6 py-3 text-left text-xs font-medium text-zinc-500 dark:text-zinc-400 uppercase tracking-wider">
                                        Project
                                    </th>
                                    <th
                                        class="px-6 py-3 text-left text-xs font-medium text-zinc-500 dark:text-zinc-400 uppercase tracking-wider">
                                        Client
                                    </th>
                                    <th
                                        class="px-6 py-3 text-left text-xs font-medium text-zinc-500 dark:text-zinc-400 uppercase tracking-wider">
                                        Status
                                    </th>
                                    <th
                                        class="px-6 py-3 text-left text-xs font-medium text-zinc-500 dark:text-zinc-400 uppercase tracking-wider">
                                        Budget
                                    </th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-zinc-200 dark:divide-zinc-600">
                                @foreach ($vendor->projects as $project)
                                    <tr class="hover:bg-zinc-50 dark:hover:bg-zinc-700/50 transition-colors">
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <div class="text-sm font-medium text-foreground">{{ $project->name }}
                                            </div>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <div class="text-sm text-foreground">{{ $project->client->name }}</div>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <span
                                                class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium
                                                {{ $project->status === 'active' ? 'bg-green-100 text-green-800 dark:bg-green-900/30 dark:text-green-400' : 'bg-zinc-100 text-zinc-800 dark:bg-zinc-700/30 dark:text-zinc-400' }}">
                                                {{ ucfirst($project->status) }}
                                            </span>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-foreground">
                                            {{ $project->budget ? '$' . number_format($project->budget, 2) : 'N/A' }}
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                @else
                    <div class="text-center py-4 text-zinc-500 dark:text-zinc-400">
                        No projects found for this vendor.
                    </div>
                @endif
            @endif

            <!-- Tasks Tab -->
            @if ($activeTab === 'tasks')
                <h3 class="text-lg font-semibold text-foreground mb-4">Tasks</h3>
                @if ($vendor->tasks->count() > 0)
                    <div class="overflow-x-auto">
                        <table class="w-full">
                            <thead
                                class="bg-zinc-50 dark:bg-zinc-700/50 border-b border-zinc-200 dark:border-zinc-600">
                                <tr>
                                    <th
                                        class="px-6 py-3 text-left text-xs font-medium text-zinc-500 dark:text-zinc-400 uppercase tracking-wider">
                                        Task
                                    </th>
                                    <th
                                        class="px-6 py-3 text-left text-xs font-medium text-zinc-500 dark:text-zinc-400 uppercase tracking-wider">
                                        Project
                                    </th>
                                    <th
                                        class="px-6 py-3 text-left text-xs font-medium text-zinc-500 dark:text-zinc-400 uppercase tracking-wider">
                                        Status
                                    </th>
                                    <th
                                        class="px-6 py-3 text-left text-xs font-medium text-zinc-500 dark:text-zinc-400 uppercase tracking-wider">
                                        Priority
                                    </th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-zinc-200 dark:divide-zinc-600">
                                @foreach ($vendor->tasks as $task)
                                    <tr class="hover:bg-zinc-50 dark:hover:bg-zinc-700/50 transition-colors">
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <div class="text-sm font-medium text-foreground">{{ $task->title }}</div>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <div class="text-sm text-foreground">{{ $task->project->name }}</div>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <span
                                                class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium
                                                {{ $task->status === 'completed' ? 'bg-green-100 text-green-800 dark:bg-green-900/30 dark:text-green-400' : 'bg-zinc-100 text-zinc-800 dark:bg-zinc-700/30 dark:text-zinc-400' }}">
                                                {{ ucfirst($task->status) }}
                                            </span>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <span
                                                class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium
                                                {{ $task->priority === 'high' ? 'bg-red-100 text-red-800 dark:bg-red-900/30 dark:text-red-400' : 'bg-zinc-100 text-zinc-800 dark:bg-zinc-700/30 dark:text-zinc-400' }}">
                                                {{ ucfirst($task->priority) }}
                                            </span>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                @else
                    <div class="text-center py-4 text-zinc-500 dark:text-zinc-400">
                        No tasks found for this vendor.
                    </div>
                @endif
            @endif
        </div>
    </div>
</div>
