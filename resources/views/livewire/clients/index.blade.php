<div>
    <div class="space-y-6">
        <div class="flex items-center justify-between">
            <div>
                <h1 class="text-3xl font-bold text-foreground">Clients</h1>
                <p class="text-muted-foreground">Manage your clients and their projects</p>
            </div>
            <a href="{{ route('clients.create') }}"
                class="inline-flex items-center gap-2 px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 dark:focus:ring-offset-zinc-900">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none"
                    stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                    class="h-4 w-4">
                    <path d="M5 12h14"></path>
                    <path d="M12 5v14"></path>
                </svg>
                Add Client
            </a>
        </div>

        <!-- Filters -->
        <div class="bg-white dark:bg-zinc-800 rounded-lg border border-zinc-200 dark:border-zinc-700 p-4">
            <div class="grid gap-4 md:grid-cols-4">
                <div class="relative">
                    <input type="text" wire:model.live.debounce.300ms="search" placeholder="Search clients..."
                        class="w-full pl-10 pr-4 py-2 border border-zinc-300 rounded-lg dark:border-zinc-600 dark:bg-zinc-700 dark:text-zinc-300 focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                    <svg class="absolute left-3 top-2.5 h-5 w-5 text-muted-foreground" fill="none"
                        stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                    </svg>
                </div>

                <select wire:model.live="status_filter"
                    class="w-full px-3 py-2 border border-zinc-300 rounded-lg dark:border-zinc-600 dark:bg-zinc-700 dark:text-zinc-300 focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                    <option value="">All Status</option>
                    <option value="active">Active</option>
                    <option value="inactive">Inactive</option>
                    <option value="prospect">Prospect</option>
                </select>

                <select wire:model.live="project_filter"
                    class="w-full px-3 py-2 border border-zinc-300 rounded-lg dark:border-zinc-600 dark:bg-zinc-700 dark:text-zinc-300 focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                    <option value="">All Projects</option>
                    <option value="has_projects">Has Projects</option>
                    <option value="no_projects">No Projects</option>
                    <option value="active_projects">Active Projects</option>
                </select>

                <select wire:model.live="per_page"
                    class="w-full px-3 py-2 border border-zinc-300 rounded-lg dark:border-zinc-600 dark:bg-zinc-700 dark:text-zinc-300 focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                    <option value="10">10 per page</option>
                    <option value="25">25 per page</option>
                    <option value="50">50 per page</option>
                    <option value="100">100 per page</option>
                </select>
            </div>
        </div>

        <!-- Clients Table -->
        <div class="bg-white dark:bg-zinc-800 rounded-lg border border-zinc-200 dark:border-zinc-700 overflow-hidden">
            <div class="overflow-x-auto">
                <table class="w-full">
                    <thead class="bg-zinc-50 dark:bg-zinc-700/50 border-b border-zinc-200 dark:border-zinc-600">
                        <tr>
                            <th
                                class="px-6 py-3 text-left text-xs font-medium text-zinc-500 dark:text-zinc-400 uppercase tracking-wider">
                                Client
                            </th>
                            <th
                                class="px-6 py-3 text-left text-xs font-medium text-zinc-500 dark:text-zinc-400 uppercase tracking-wider">
                                Contact
                            </th>
                            <th
                                class="px-6 py-3 text-left text-xs font-medium text-zinc-500 dark:text-zinc-400 uppercase tracking-wider">
                                Projects
                            </th>
                            <th
                                class="px-6 py-3 text-left text-xs font-medium text-zinc-500 dark:text-zinc-400 uppercase tracking-wider">
                                Tasks
                            </th>
                            <th
                                class="px-6 py-3 text-left text-xs font-medium text-zinc-500 dark:text-zinc-400 uppercase tracking-wider">
                                Status
                            </th>
                            <th
                                class="px-6 py-3 text-left text-xs font-medium text-zinc-500 dark:text-zinc-400 uppercase tracking-wider">
                                Created
                            </th>
                            <th
                                class="px-6 py-3 text-right text-xs font-medium text-zinc-500 dark:text-zinc-400 uppercase tracking-wider">
                                Actions
                            </th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-zinc-200 dark:divide-zinc-600">
                        @forelse($clients as $client)
                            @php
                                $projectCount = $client->projects()->count();
                                $activeProjects = $client
                                    ->projects()
                                    ->whereIn('status', ['planning', 'in_progress'])
                                    ->count();
                                $totalTasks = $client->projects()->withCount('tasks')->get()->sum('tasks_count');
                                $completedTasks = $client
                                    ->projects()
                                    ->whereHas('tasks', function ($query) {
                                        $query->where('status', 'completed');
                                    })
                                    ->count();
                            @endphp
                            <tr class="hover:bg-zinc-50 dark:hover:bg-zinc-700/50 transition-colors">
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div>
                                        <div class="text-sm font-medium text-foreground">{{ $client->name }}</div>
                                        @if ($client->company_name)
                                            <div class="text-sm text-muted-foreground">{{ $client->company_name }}</div>
                                        @endif
                                    </div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="text-sm text-foreground">
                                        @if ($client->email)
                                            <div class="flex items-center gap-1">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14"
                                                    viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                                    stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                                    class="h-3.5 w-3.5 text-zinc-400">
                                                    <rect width="20" height="16" x="2" y="4" rx="2">
                                                    </rect>
                                                    <path d="m22 7-10 5L2 7"></path>
                                                </svg>
                                                {{ Str::limit($client->email, 25) }}
                                            </div>
                                        @endif
                                        @if ($client->phone)
                                            <div class="flex items-center gap-1 mt-1">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14"
                                                    viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                                    stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                                    class="h-3.5 w-3.5 text-zinc-400">
                                                    <path
                                                        d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07 19.5 19.5 0 0 1-6-6 19.79 19.79 0 0 1-3.07-8.67A2 2 0 0 1 4.11 2h3a2 2 0 0 1 2 1.72 12.84 12.84 0 0 0 .7 2.81 2 2 0 0 1-.45 2.11L8.09 9.91a16 16 0 0 0 6 6l1.27-1.27a2 2 0 0 1 2.11-.45 12.84 12.84 0 0 0 2.81.7A2 2 0 0 1 22 16.92z">
                                                    </path>
                                                </svg>
                                                {{ $client->phone }}
                                            </div>
                                        @endif
                                    </div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="text-sm text-foreground">
                                        <div class="font-medium">{{ $projectCount }}</div>
                                        @if ($activeProjects > 0)
                                            <div class="text-xs text-green-600 dark:text-green-400">
                                                {{ $activeProjects }}
                                                active</div>
                                        @endif
                                    </div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="text-sm text-foreground">
                                        <div class="font-medium">{{ $totalTasks }}</div>
                                        @if ($totalTasks > 0)
                                            <div class="text-xs text-blue-600 dark:text-blue-400">
                                                {{ round(($completedTasks / $totalTasks) * 100) }}% done
                                            </div>
                                        @endif
                                    </div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <span
                                        class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800 dark:bg-green-900/30 dark:text-green-400">
                                        Active
                                    </span>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-muted-foreground">
                                    {{ $client->created_at->format('M d, Y') }}
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                    <div class="flex items-center justify-end gap-2">
                                        <a href="{{ route('clients.show', $client) }}"
                                            class="text-blue-600 hover:text-blue-900 dark:text-blue-400 dark:hover:text-blue-300"
                                            title="View">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                                viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                                stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                                class="h-4 w-4">
                                                <path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z" />
                                                <circle cx="12" cy="12" r="3" />
                                            </svg>
                                        </a>
                                        <a href="{{ route('clients.edit', $client) }}"
                                            class="text-zinc-600 hover:text-zinc-900 dark:text-zinc-400 dark:hover:text-zinc-300"
                                            title="Edit">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                                viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                                stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                                class="h-4 w-4">
                                                <path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7">
                                                </path>
                                                <path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z">
                                                </path>
                                            </svg>
                                        </a>
                                        <button type="button" wire:click="deleteClient({{ $client->id }})"
                                            class="text-red-600 hover:text-red-900 dark:text-red-400 dark:hover:text-red-300"
                                            title="Delete">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                                viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                                stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                                class="h-4 w-4">
                                                <path d="M3 6h18"></path>
                                                <path
                                                    d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2">
                                                </path>
                                            </svg>
                                        </button>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="7" class="px-6 py-12 text-center">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                        viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                        stroke-linecap="round" stroke-linejoin="round"
                                        class="mx-auto h-12 w-12 text-zinc-400">
                                        <path d="M16 21v-2a4 4 0 0 0-4-4H6a4 4 0 0 0-4 4v2"></path>
                                        <circle cx="9" cy="7" r="4"></circle>
                                        <path d="M22 21v-2a4 4 0 0 0-3-3.87"></path>
                                        <path d="M16 3.13a4 4 0 0 1 0 7.75"></path>
                                    </svg>
                                    <h3 class="mt-2 text-sm font-medium text-zinc-900 dark:text-zinc-100">No clients
                                    </h3>
                                    <p class="mt-1 text-sm text-zinc-500 dark:text-zinc-400">Get started by creating a
                                        new
                                        client.</p>
                                    <div class="mt-6">
                                        <a href="{{ route('clients.create') }}"
                                            class="inline-flex items-center gap-2 px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 dark:focus:ring-offset-zinc-900">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                                viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                                stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                                class="h-4 w-4">
                                                <path d="M5 12h14"></path>
                                                <path d="M12 5v14"></path>
                                            </svg>
                                            Add Client
                                        </a>
                                    </div>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

        <!-- Pagination -->
        @if ($clients->hasPages())
            <div class="flex items-center justify-between">
                <div class="text-sm text-muted-foreground">
                    Showing {{ $clients->firstItem() }} to {{ $clients->lastItem() }} of {{ $clients->total() }}
                    results
                </div>
                {{ $clients->links() }}
            </div>
        @endif

        <!-- Delete Confirmation Modal -->
        @if ($confirmingDelete)
            <flux:modal name="delete-client">
                <div class="p-6">
                    <h3 class="text-lg font-medium text-foreground">Delete Client</h3>
                    <p class="mt-2 text-sm text-muted-foreground">
                        Are you sure you want to delete this client? This action cannot be undone and will also delete
                        all
                        associated projects and tasks.
                    </p>
                    <div class="mt-6 flex justify-end gap-3">
                        <flux:button variant="ghost" wire:click="cancelDelete">Cancel</flux:button>
                        <flux:button variant="danger" wire:click="confirmDelete">Delete Client</flux:button>
                    </div>
                </div>
            </flux:modal>
        @endif
    </div>
    <div class="mt-6">
        {{ $clients->links() }}
    </div>

    <!-- Delete Confirmation Modal -->
    @if ($showDeleteModal)
        <div class="fixed inset-0 bg-black/50 flex items-center justify-center p-4 z-50">
            <div class="bg-background rounded-lg shadow-lg max-w-md w-full p-6">
                <h3 class="text-lg font-medium text-foreground mb-2">Delete Client</h3>
                <p class="text-sm text-muted-foreground mb-6">Are you sure you want to delete this client? This action
                    cannot be undone.</p>
                <div class="flex justify-end space-x-3">
                    <button wire:click="cancelDelete"
                        class="px-4 py-2 border border-input rounded-lg text-foreground hover:bg-muted">
                        Cancel
                    </button>
                    <button wire:click="confirmDelete"
                        class="px-4 py-2 bg-destructive text-destructive-foreground rounded-lg hover:bg-destructive/90">
                        Delete
                    </button>
                </div>
            </div>
        </div>
    @endif
</div>
