<div class="space-y-8">
    <!-- Header -->
    <div class="flex items-center justify-between">
        <div>
            <h1 class="text-3xl font-bold text-foreground">{{ __('Projects') }}</h1>
            <p class="text-muted-foreground">{{ __('Manage your team projects and milestones') }}</p>
        </div>
        <a href="{{ route('projects.create') }}"
            class="inline-flex items-center gap-2 px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 dark:focus:ring-offset-zinc-900">
            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none"
                stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="h-4 w-4">
                <path d="M5 12h14"></path>
                <path d="M12 5v14"></path>
            </svg>
            {{ __('New Project') }}
        </a>
    </div>

    <!-- Search and Filters -->
    <div class="flex flex-col sm:flex-row gap-4">
        <div class="flex-1">
            <input type="text" wire:model.live="search" placeholder="{{ __('Search projects...') }}"
                class="w-full px-3 py-2 border border-zinc-200 rounded-md dark:border-zinc-700 dark:bg-zinc-800 dark:text-zinc-300" />
        </div>
        <div class="flex gap-2 flex-wrap">
            <button wire:click="updateStatusFilter('')" type="button"
                class="px-3 py-1.5 text-sm rounded-md border {{ $statusFilter === '' ? 'border-blue-500 bg-blue-50 text-blue-700 dark:bg-blue-900/30 dark:text-blue-400' : 'border-zinc-200 bg-white text-zinc-700 hover:bg-zinc-50 dark:border-zinc-700 dark:bg-zinc-800 dark:text-zinc-300 dark:hover:bg-zinc-700' }}">
                {{ __('All') }}
            </button>
            <button wire:click="updateStatusFilter('planning')" type="button"
                class="px-3 py-1.5 text-sm rounded-md border {{ $statusFilter === 'planning' ? 'border-yellow-500 bg-yellow-50 text-yellow-700 dark:bg-yellow-900/30 dark:text-yellow-400' : 'border-zinc-200 bg-white text-zinc-700 hover:bg-zinc-50 dark:border-zinc-700 dark:bg-zinc-800 dark:text-zinc-300 dark:hover:bg-zinc-700' }}">
                {{ __('Planning') }}
            </button>
            <button wire:click="updateStatusFilter('in_progress')" type="button"
                class="px-3 py-1.5 text-sm rounded-md border {{ $statusFilter === 'in_progress' ? 'border-blue-500 bg-blue-50 text-blue-700 dark:bg-blue-900/30 dark:text-blue-400' : 'border-zinc-200 bg-white text-zinc-700 hover:bg-zinc-50 dark:border-zinc-700 dark:bg-zinc-800 dark:text-zinc-300 dark:hover:bg-zinc-700' }}">
                {{ __('In Progress') }}
            </button>
            <button wire:click="updateStatusFilter('completed')" type="button"
                class="px-3 py-1.5 text-sm rounded-md border {{ $statusFilter === 'completed' ? 'border-green-500 bg-green-50 text-green-700 dark:bg-green-900/30 dark:text-green-400' : 'border-zinc-200 bg-white text-zinc-700 hover:bg-zinc-50 dark:border-zinc-700 dark:bg-zinc-800 dark:text-zinc-300 dark:hover:bg-zinc-700' }}">
                {{ __('Completed') }}
            </button>
            <button wire:click="updateStatusFilter('on_hold')" type="button"
                class="px-3 py-1.5 text-sm rounded-md border {{ $statusFilter === 'on_hold' ? 'border-red-500 bg-red-50 text-red-700 dark:bg-red-900/30 dark:text-red-400' : 'border-zinc-200 bg-white text-zinc-700 hover:bg-zinc-50 dark:border-zinc-700 dark:bg-zinc-800 dark:text-zinc-300 dark:hover:bg-zinc-700' }}">
                {{ __('On Hold') }}
            </button>
        </div>
    </div>

    <!-- Projects Grid -->
    <div class="grid gap-6 md:grid-cols-2 lg:grid-cols-3">
        @forelse($projects as $project)
            <div
                class="relative overflow-hidden rounded-xl border border-zinc-200 bg-white dark:border-zinc-700 dark:bg-zinc-800 hover:shadow-md transition-shadow">
                <div class="flex items-start justify-between p-6 pb-2">
                    <div class="space-y-1">
                        <h2 class="text-lg font-semibold text-foreground">{{ $project->name }}</h2>
                        @php
                            $statusColors = [
                                'planning' => 'bg-yellow-500/10 text-yellow-700 dark:text-yellow-400',
                                'in_progress' => 'bg-blue-500/10 text-blue-700 dark:text-blue-400',
                                'completed' => 'bg-green-500/10 text-green-700 dark:text-green-400',
                                'on_hold' => 'bg-red-500/10 text-red-700 dark:text-red-400',
                            ];
                        @endphp
                        <flux:badge
                            class="{{ $statusColors[$project->status] ?? 'bg-zinc-500/10 text-zinc-700 dark:text-zinc-400' }}">
                            {{ ucfirst(str_replace('_', ' ', $project->status)) }}
                        </flux:badge>
                    </div>
                    <!-- Action buttons instead of dropdown -->
                    <div class="flex space-x-2">
                        <a href="{{ route('projects.show', $project) }}"
                            class="text-blue-600 hover:text-blue-800 dark:text-blue-400 dark:hover:text-blue-300"
                            title="{{ __('View Details') }}">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24"
                                fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                stroke-linejoin="round" class="h-4 w-4">
                                <path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"></path>
                                <circle cx="12" cy="12" r="3"></circle>
                            </svg>
                        </a>
                        <a href="{{ route('projects.edit', $project) }}"
                            class="text-zinc-600 hover:text-zinc-800 dark:text-zinc-400 dark:hover:text-zinc-300"
                            title="{{ __('Edit') }}">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24"
                                fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                stroke-linejoin="round" class="h-4 w-4">
                                <path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"></path>
                                <path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z"></path>
                            </svg>
                        </a>
                        <button type="button" wire:click="deleteProject({{ $project->id }})"
                            class="text-red-600 hover:text-red-800 dark:text-red-400 dark:hover:text-red-300"
                            title="{{ __('Delete') }}">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24"
                                fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                stroke-linejoin="round" class="h-4 w-4">
                                <path d="M3 6h18"></path>
                                <path d="M19 6v14c0 1-1 2-2 2H7c-1 0-2-1-2-2V6"></path>
                                <path d="M8 6V4c0-1 1-2 2-2h4c1 0 2 1 2 2v2"></path>
                            </svg>
                        </button>
                    </div>
                </div>
                <div class="p-6 pt-0">
                    <p class="mb-4 text-sm text-zinc-500 dark:text-zinc-400">
                        {{ Str::limit($project->description, 100) }}
                    </p>
                    <div class="flex items-center justify-between text-sm text-zinc-500 dark:text-zinc-400">
                        <div class="flex items-center gap-1">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24"
                                fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                stroke-linejoin="round" class="h-4 w-4">
                                <path d="M8 2v4"></path>
                                <path d="M16 2v4"></path>
                                <rect width="18" height="18" x="3" y="4" rx="2"></rect>
                                <path d="M3 10h18"></path>
                                <path d="M8 14h.01"></path>
                                <path d="M12 14h.01"></path>
                                <path d="M16 14h.01"></path>
                            </svg>
                            {{ $project->due_date ? $project->due_date->format('Y-m-d') : __('No due date') }}
                        </div>
                        <div class="flex items-center gap-1">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                stroke-linecap="round" stroke-linejoin="round" class="h-4 w-4">
                                <path d="M16 21v-2a4 4 0 0 0-4-4H6a4 4 0 0 0-4 4v2" />
                                <circle cx="9" cy="7" r="4" />
                                <path d="M22 21v-2a4 4 0 0 0-3-3.87" />
                                <path d="M16 3.13a4 4 0 0 1 0 7.75" />
                            </svg>
                            {{ $project->tasks->count() }}
                        </div>
                    </div>
                    <!-- Project related data -->
                    <div class="mt-4 pt-4 border-t border-zinc-200 dark:border-zinc-700">
                        <div class="grid grid-cols-2 gap-2 text-xs">
                            <div>
                                <span class="text-zinc-500 dark:text-zinc-400">{{ __('Tasks: ') }}</span>
                                <span class="font-medium">{{ $project->tasks->count() }}</span>
                            </div>
                            <div>
                                <span class="text-zinc-500 dark:text-zinc-400">{{ __('Users: ') }}</span>
                                <span class="font-medium">{{ $project->users->count() }}</span>
                            </div>
                            <div>
                                <span class="text-zinc-500 dark:text-zinc-400">{{ __('Client: ') }}</span>
                                <span class="font-medium">{{ $project->client?->name ?? 'N/A' }}</span>
                            </div>
                            <div>
                                <span class="text-zinc-500 dark:text-zinc-400">{{ __('Invoices: ') }}</span>
                                <span class="font-medium">{{ $project->invoices->count() }}</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @empty
            <div class="col-span-full text-center py-12">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                    fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                    stroke-linejoin="round" class="mx-auto h-12 w-12 text-zinc-400">
                    <path d="M5 22h14"></path>
                    <path d="M5 2h14"></path>
                    <path d="M17 22v-4.172a2 2 0 0 0-.586-1.414L12 12l-4.414 4.414A2 2 0 0 0 7 17.828V22"></path>
                    <path d="M7 2v4.172a2 2 0 0 0 .586 1.414L12 12l4.414-4.414A2 2 0 0 0 17 6.172V2"></path>
                </svg>
                <h3 class="mt-2 text-sm font-medium text-zinc-900 dark:text-zinc-100">{{ __('No projects') }}</h3>
                <p class="mt-1 text-sm text-zinc-500 dark:text-zinc-400">
                    {{ __('Get started by creating a new project.') }}</p>
                <div class="mt-6">
                    <a href="{{ route('projects.create') }}"
                        class="inline-flex items-center gap-2 px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 dark:focus:ring-offset-zinc-900">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24"
                            fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                            stroke-linejoin="round" class="h-4 w-4">
                            <path d="M5 12h14"></path>
                            <path d="M12 5v14"></path>
                        </svg>
                        {{ __('New Project') }}
                    </a>
                </div>
            </div>
        @endforelse
    </div>

    <!-- Pagination -->
    <div class="mt-6">
        {{ $projects->links() }}
    </div>

    <!-- Delete Confirmation Modal -->
    <flux:modal name="delete-project" wire:model="showDeleteModal">
        <div class="space-y-6">
            <div>
                <flux:heading size="lg">{{ __('Delete Project') }}</flux:heading>
                <flux:text class="mt-2">{{ __('Are you sure you want to delete this project? This action cannot be undone.') }}</flux:text>
            </div>

            <div class="flex gap-2">
                <flux:spacer />
                <flux:button wire:click="cancelDelete" variant="ghost">{{ __('Cancel') }}</flux:button>
                <flux:button wire:click="confirmDelete" variant="danger">{{ __('Delete') }}</flux:button>
            </div>
        </div>
    </flux:modal>
</div>

<script>
    document.addEventListener('livewire:initialized', () => {
        Livewire.on('updateStatusFilter', (status) => {
            @this.statusFilter = status;
        });
    });
</script>
