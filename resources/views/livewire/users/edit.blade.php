<div class="space-y-6">
    <div class="flex items-center justify-between">
        <div>
            <h1 class="text-3xl font-bold text-foreground">{{ __('Edit User') }}</h1>
            <p class="text-muted-foreground">{{ __('Update user information and manage assignments') }}</p>
        </div>
        <flux:button wire:navigate href="/users" variant="outline">
            {{ __('Back to Users') }}
        </flux:button>
    </div>

    <form wire:submit="updateUser" class="space-y-6">
        <!-- User Information -->
        <div class="bg-white dark:bg-zinc-800 rounded-lg border border-zinc-200 dark:border-zinc-700 p-6">
            <div class="flex items-center gap-2 mb-4">
                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none"
                    stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                    class="text-zinc-500">
                    <path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path>
                    <circle cx="12" cy="7" r="4"></circle>
                </svg>
                <h2 class="text-lg font-semibold text-foreground">{{ __('User Information') }}</h2>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div>
                    <flux:label>{{ __('Name') }}</flux:label>
                    <flux:input wire:model="name" type="text" required />
                    @error('name')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <flux:label>{{ __('Email') }}</flux:label>
                    <flux:input wire:model="email" type="email" required />
                    @error('email')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>
            </div>
        </div>

        <!-- Project Assignments -->
        <div class="bg-white dark:bg-zinc-800 rounded-lg border border-zinc-200 dark:border-zinc-700 p-6">
            <div class="flex items-center gap-2 mb-4">
                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none"
                    stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                    class="text-zinc-500">
                    <path d="M22 19h-4l-3 3V19h-5a2 2 0 0 1-2-2v-5a2 2 0 0 1 2-2h14a2 2 0 0 1 2 2v5a2 2 0 0 1-2 2z">
                    </path>
                </svg>
                <h2 class="text-lg font-semibold text-foreground">{{ __('Project Assignments') }}</h2>
            </div>

            <div class="space-y-2">
                @if ($projects->count() > 0)
                    @foreach ($projects as $project)
                        <div
                            class="flex items-center justify-between p-3 rounded-lg border border-zinc-200 dark:border-zinc-600 hover:bg-zinc-50 dark:hover:bg-zinc-700/50">
                            <div class="flex items-center gap-3">
                                <flux:checkbox wire:model.live="selectedProjects" value="{{ $project->id }}" />
                                <div>
                                    <div class="font-medium text-foreground">{{ $project->name }}</div>
                                    <div class="text-sm text-zinc-500 dark:text-zinc-400">{{ $project->status }}</div>
                                </div>
                            </div>
                            <flux:badge
                                variant="{{ $project->status === 'completed' ? 'success' : ($project->status === 'in_progress' ? 'warning' : 'info') }}">
                                {{ $project->status }}
                            </flux:badge>
                        </div>
                    @endforeach
                @else
                    <p class="text-zinc-500 dark:text-zinc-400 text-center py-4">{{ __('No projects available') }}</p>
                @endif
            </div>
        </div>

        <!-- Task Assignments -->
        <div class="bg-white dark:bg-zinc-800 rounded-lg border border-zinc-200 dark:border-zinc-700 p-6">
            <div class="flex items-center gap-2 mb-4">
                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none"
                    stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                    class="text-zinc-500">
                    <path d="M9 11l3 3L22 4"></path>
                    <path d="M21 12v7a2 2 0 01-2 2H5a2 2 0 01-2-2V5a2 2 0 012-2h11"></path>
                </svg>
                <h2 class="text-lg font-semibold text-foreground">{{ __('Task Assignments') }}</h2>
            </div>

            <div class="space-y-2">
                @if ($tasks->count() > 0)
                    @foreach ($tasks as $task)
                        <div
                            class="flex items-center justify-between p-3 rounded-lg border border-zinc-200 dark:border-zinc-600 hover:bg-zinc-50 dark:hover:bg-zinc-700/50">
                            <div class="flex items-center gap-3">
                                <flux:checkbox wire:model.live="selectedTasks" value="{{ $task->id }}" />
                                <div>
                                    <div class="font-medium text-foreground">{{ $task->title }}</div>
                                    @if ($task->project)
                                        <div class="text-sm text-zinc-500 dark:text-zinc-400">
                                            {{ $task->project->name }}</div>
                                    @endif
                                </div>
                            </div>
                            <flux:badge
                                variant="{{ $task->status === 'completed' ? 'success' : ($task->status === 'in_progress' ? 'warning' : 'info') }}">
                                {{ $task->status }}
                            </flux:badge>
                        </div>
                    @endforeach
                @else
                    <p class="text-zinc-500 dark:text-zinc-400 text-center py-4">{{ __('No tasks available') }}</p>
                @endif
            </div>
        </div>

        <!-- Client Assignments -->
        <div class="bg-white dark:bg-zinc-800 rounded-lg border border-zinc-200 dark:border-zinc-700 p-6">
            <div class="flex items-center gap-2 mb-4">
                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none"
                    stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                    class="text-zinc-500">
                    <path d="M16 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"></path>
                    <circle cx="8.5" cy="7" r="4"></circle>
                    <path d="M20 8v6"></path>
                    <path d="M23 11h-6"></path>
                </svg>
                <h2 class="text-lg font-semibold text-foreground">{{ __('Client Assignments') }}</h2>
            </div>

            <div class="space-y-2">
                @if ($clients->count() > 0)
                    @foreach ($clients as $client)
                        <div
                            class="flex items-center justify-between p-3 rounded-lg border border-zinc-200 dark:border-zinc-600 hover:bg-zinc-50 dark:hover:bg-zinc-700/50">
                            <div class="flex items-center gap-3">
                                <flux:checkbox wire:model.live="selectedClients" value="{{ $client->id }}" />
                                <div>
                                    <div class="font-medium text-foreground">{{ $client->name }}</div>
                                    <div class="text-sm text-zinc-500 dark:text-zinc-400">{{ $client->email }}</div>
                                </div>
                            </div>
                            <flux:badge variant="secondary">
                                Client
                            </flux:badge>
                        </div>
                    @endforeach
                @else
                    <p class="text-zinc-500 dark:text-zinc-400 text-center py-4">{{ __('No clients available') }}</p>
                @endif
            </div>
        </div>

        <!-- Form Actions -->
        <div class="flex justify-end gap-3">
            <flux:button type="button" wire:navigate href="/users" variant="outline">
                {{ __('Cancel') }}
            </flux:button>
            <flux:button type="submit" variant="primary" wire:loading.attr="disabled">
                <span wire:loading.remove>{{ __('Update User') }}</span>
                <span wire:loading>{{ __('Updating...') }}</span>
            </flux:button>
        </div>
    </form>
</div>
