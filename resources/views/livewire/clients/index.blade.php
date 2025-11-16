<div class="space-y-6">
    <div class="flex items-center justify-between">
        <div>
            <h1 class="text-3xl font-bold text-foreground">Clients</h1>
            <p class="text-muted-foreground">Manage your clients and their projects</p>
        </div>
        <a href="{{ route('clients.create') }}"
            class="inline-flex items-center gap-2 px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 dark:focus:ring-offset-zinc-900">
            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none"
                stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="h-4 w-4">
                <path d="M5 12h14"></path>
                <path d="M12 5v14"></path>
            </svg>
            Add Client
        </a>
    </div>

    <!-- Search and Filters -->
    <div class="flex flex-col sm:flex-row gap-4">
        <div class="flex-1 relative">
            <input type="text" wire:model.live.debounce.300ms="search" placeholder="Search clients..."
                class="w-full pl-10 pr-4 py-2 border border-zinc-200 rounded-md dark:border-zinc-700 dark:bg-zinc-800 dark:text-zinc-300">
            <svg class="absolute left-3 top-2.5 h-5 w-5 text-muted-foreground" fill="none" stroke="currentColor"
                viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
            </svg>
        </div>
    </div>

    <!-- Clients Grid -->
    <div class="grid gap-6 md:grid-cols-2 lg:grid-cols-3">
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
                $recentProjects = $client->projects()->latest()->take(3)->get();
            @endphp
            <div class="relative overflow-hidden rounded-xl border border-zinc-200 bg-white dark:border-zinc-700 dark:bg-zinc-800 hover:shadow-md transition-shadow cursor-pointer"
                onclick="window.location.href='{{ route('clients.show', $client) }}'">
                <div class="flex items-start justify-between p-6 pb-2">
                    <div class="space-y-1 flex-1">
                        <h2
                            class="text-lg font-semibold text-foreground hover:text-blue-600 dark:hover:text-blue-400 transition-colors">
                            {{ $client->name }}</h2>
                        @if ($client->company_name)
                            <p class="text-sm text-zinc-500 dark:text-zinc-400">{{ $client->company_name }}</p>
                        @endif
                    </div>
                    <div class="flex gap-2" onclick="event.stopPropagation()">
                        <a href="{{ route('clients.edit', $client) }}"
                            class="p-2 text-zinc-500 hover:text-blue-600 dark:text-zinc-400 dark:hover:text-blue-400 transition-colors"
                            title="Edit Client">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24"
                                fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                stroke-linejoin="round" class="h-4 w-4">
                                <path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"></path>
                                <path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z"></path>
                            </svg>
                        </a>
                        <button type="button" wire:click="deleteClient({{ $client->id }})"
                            class="p-2 text-zinc-500 hover:text-red-600 dark:text-zinc-400 dark:hover:text-red-400 transition-colors"
                            title="Delete Client">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24"
                                fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                stroke-linejoin="round" class="h-4 w-4">
                                <path d="M3 6h18"></path>
                                <path
                                    d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2">
                                </path>
                            </svg>
                        </button>
                    </div>
                </div>

                <div class="p-6 pt-0 space-y-4">
                    <!-- Contact Info -->
                    <div class="flex items-center gap-4 text-sm text-zinc-500 dark:text-zinc-400">
                        @if ($client->email)
                            <div class="flex items-center gap-1">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                    viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                    stroke-linecap="round" stroke-linejoin="round" class="h-4 w-4">
                                    <rect width="20" height="16" x="2" y="4" rx="2"></rect>
                                    <path d="m22 7-10 5L2 7"></path>
                                </svg>
                                {{ Str::limit($client->email, 20) }}
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                    viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                    stroke-linecap="round" stroke-linejoin="round" class="h-4 w-4">
                                    <rect width="20" height="16" x="2" y="4" rx="2"></rect>
                                    <path d="m22 7-10 5L2 7"></path>
                                </svg>
                                {{ Str::limit($client->email, 20) }}
                            </div>
                        @endif
                        @if ($client->phone)
                            <div class="flex items-center gap-1">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                    viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                    stroke-linecap="round" stroke-linejoin="round" class="h-4 w-4">
                                    <path
                                        d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07 19.5 19.5 0 0 1-6-6 19.79 19.79 0 0 1-3.07-8.67A2 2 0 0 1 4.11 2h3a2 2 0 0 1 2 1.72 12.84 12.84 0 0 0 .7 2.81 2 2 0 0 1-.45 2.11L8.09 9.91a16 16 0 0 0 6 6l1.27-1.27a2 2 0 0 1 2.11-.45 12.84 12.84 0 0 0 2.81.7A2 2 0 0 1 22 16.92z">
                                    </path>
                                </svg>
                                {{ $client->phone }}
                            </div>
                        @endif
                    </div>

                    <!-- Project & Task Stats -->
                    <div class="grid grid-cols-2 gap-4">
                        <div class="bg-zinc-50 dark:bg-zinc-700/50 rounded-lg p-3">
                            <div class="flex items-center  gap-2">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                    viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                    stroke-linecap="round" stroke-linejoin="round" class="h-4 w-4 text-blue-600">
                                    <path d="M22 19h-4.5a2.5 2.5 0 0 1-2.5-2.5V12a2.5 2.5 0 0 1 2.5-2.5H22"></path>
                                    <path d="M2 19h4.5a2.5 2.5 0 0 0 2.5-2.5V12a2.5 2.5 0 0 0-2.5-2.5H2"></path>
                                    <path d="M12 19h0"></path>
                                </svg>
                                <div class="flew-full whitespace-nowrap">
                                    <p class="text-lg font-semibold text-foreground"> Projects {{ $projectCount }}</p>
                                </div>
                            </div>
                            @if ($activeProjects > 0)
                                <p class="text-xs text-green-600 dark:text-green-400 mt-1">{{ $activeProjects }}
                                    active
                                </p>
                            @endif
                        </div>
                        <div class="bg-zinc-50 dark:bg-zinc-700/50 rounded-lg p-3">
                            <div class="flex items-center gap-2">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                    viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                    stroke-linecap="round" stroke-linejoin="round" class="h-4 w-4 text-green-600">
                                    <path d="M9 11l3 3L22 4"></path>
                                    <path d="M21 12v7a2 2 0 01-2 2H5a2 2 0 01-2-2V5a2 2 0 012-2h11"></path>
                                </svg>
                                <div>
                                    <p class="text-lg font-semibold text-foreground"> Tasks {{ $totalTasks }}</p>
                                </div>
                            </div>
                            @if ($totalTasks > 0)
                                <p class="text-xs text-blue-600 dark:text-blue-400 mt-1">
                                    {{ round(($completedTasks / $totalTasks) * 100) }}% done</p>
                            @endif
                        </div>
                    </div>

                    <!-- Recent Projects -->
                    @if ($recentProjects->count() > 0)
                        <div>
                            <p class="text-xs font-medium text-zinc-500 dark:text-zinc-400 mb-2">Recent Projects
                            </p>
                            <div class="space-y-2">
                                @foreach ($recentProjects as $project)
                                    @php
                                        $statusColors = [
                                            'planning' => 'bg-yellow-500/10 text-yellow-700 dark:text-yellow-400',
                                            'in_progress' => 'bg-blue-500/10 text-blue-700 dark:text-blue-400',
                                            'completed' => 'bg-green-500/10 text-green-700 dark:text-green-400',
                                            'on_hold' => 'bg-red-500/10 text-red-700 dark:text-red-400',
                                        ];
                                    @endphp
                                    <div class="flex items-center justify-between">
                                        <a href="{{ route('projects.show', $project) }}"
                                            class="text-sm text-zinc-700 dark:text-zinc-300 hover:text-blue-600 dark:hover:text-blue-400">
                                            {{ Str::limit($project->name, 25) }}
                                        </a>
                                        <flux:badge
                                            class="text-xs {{ $statusColors[$project->status] ?? 'bg-zinc-500/10 text-zinc-700 dark:text-zinc-400' }}">
                                            {{ ucfirst(str_replace('_', ' ', $project->status)) }}
                                        </flux:badge>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    @endif
                </div>
            </div>
        @empty
            <div class="col-span-full text-center py-12">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                    fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                    stroke-linejoin="round" class="mx-auto h-12 w-12 text-zinc-400">
                    <path d="M16 21v-2a4 4 0 0 0-4-4H6a4 4 0 0 0-4 4v2"></path>
                    <circle cx="9" cy="7" r="4"></circle>
                    <path d="M22 21v-2a4 4 0 0 0-3-3.87"></path>
                    <path d="M16 3.13a4 4 0 0 1 0 7.75"></path>
                </svg>
                <h3 class="mt-2 text-sm font-medium text-zinc-900 dark:text-zinc-100">No clients</h3>
                <p class="mt-1 text-sm text-zinc-500 dark:text-zinc-400">Get started by creating a new client.</p>
                <div class="mt-6">
                    <a href="{{ route('clients.create') }}"
                        class="inline-flex items-center gap-2 px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 dark:focus:ring-offset-zinc-900">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24"
                            fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                            stroke-linejoin="round" class="h-4 w-4">
                            <path d="M5 12h14"></path>
                            <path d="M12 5v14"></path>
                        </svg>
                        Add Client
                    </a>
                </div>
            </div>
        @endforelse
    </div>

    <!-- Pagination -->
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
