<div class="space-y-6">
    <div class="flex items-center justify-between">
        <div>
            <h1 class="text-3xl font-bold text-foreground">{{ __('Users') }}</h1>
            <p class="text-muted-foreground">{{ __('Manage team members and their assignments') }}</p>
        </div>
        <flux:button wire:navigate href="/users/create" class="gap-2">
            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none"
                stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="h-4 w-4">
                <path d="M5 12h14"></path>
                <path d="M12 5v14"></path>
            </svg>
            {{ __('Add User') }}
        </flux:button>
    </div>

    <!-- User Search -->
    <div class="flex items-center gap-3">
        <flux:input wire:model.live="search" placeholder="{{ __('Search users') }}" class="max-w-xs" />
        <flux:select wire:model.live="role" class="max-w-xs">
            <option value="all">{{ __('All Users') }}</option>
            <option value="with-permissions">{{ __('With Permissions') }}</option>
            <option value="without-permissions">{{ __('Without Permissions') }}</option>
        </flux:select>
    </div>

    <!-- Users Table -->
    <div class="bg-white dark:bg-zinc-800 rounded-lg border border-zinc-200 dark:border-zinc-700 overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full">
                <thead class="bg-zinc-50 dark:bg-zinc-700/50 border-b border-zinc-200 dark:border-zinc-600">
                    <tr>
                        <th
                            class="px-6 py-3 text-left text-xs font-medium text-zinc-500 dark:text-zinc-400 uppercase tracking-wider">
                            {{ __('User') }}
                        </th>
                        <th
                            class="px-6 py-3 text-left text-xs font-medium text-zinc-500 dark:text-zinc-400 uppercase tracking-wider">
                            {{ __('Projects') }}
                        </th>
                        <th
                            class="px-6 py-3 text-left text-xs font-medium text-zinc-500 dark:text-zinc-400 uppercase tracking-wider">
                            {{ __('Tasks') }}
                        </th>
                        <th
                            class="px-6 py-3 text-left text-xs font-medium text-zinc-500 dark:text-zinc-400 uppercase tracking-wider">
                            {{ __('Permissions') }}
                        </th>
                        <th
                            class="px-6 py-3 text-right text-xs font-medium text-zinc-500 dark:text-zinc-400 uppercase tracking-wider">
                            {{ __('Actions') }}
                        </th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-zinc-200 dark:divide-zinc-600">
                    @forelse($users as $user)
                        @php
                            $projectCount = $user->projects()->count();
                            $activeProjects = $user
                                ->projects()
                                ->whereIn('status', ['planning', 'in_progress'])
                                ->count();
                            $taskCount = $user->tasks()->count();
                            $completedTasks = $user->tasks()->where('status', 'completed')->count();
                            $clientCount = $user->clients()->count();
                        @endphp
                        <tr class="hover:bg-zinc-50 dark:hover:bg-zinc-700/50 transition-colors">
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="flex items-center gap-3">
                                    <div class="relative flex h-8 w-8 shrink-0 overflow-hidden rounded-lg">
                                        <div
                                            class="flex h-full w-full items-center justify-center rounded-lg bg-blue-100 text-blue-800 dark:bg-blue-900/30 dark:text-blue-300">
                                            {{ $user->initials() }}
                                        </div>
                                    </div>
                                    <div>
                                        <div class="text-sm font-medium text-foreground">{{ $user->name }}</div>
                                        <div class="text-sm text-muted-foreground">{{ $user->email }}</div>
                                    </div>
                                </div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="text-sm text-foreground">
                                    <div class="font-medium">{{ $projectCount }}</div>
                                    @if ($activeProjects > 0)
                                        <div class="text-xs text-green-600 dark:text-green-400">{{ $activeProjects }}
                                            {{ __('active') }}</div>
                                    @endif
                                </div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="text-sm text-foreground">
                                    <div class="font-medium">{{ $taskCount }}</div>
                                    @if ($taskCount > 0)
                                        <div class="text-xs text-blue-600 dark:text-blue-400">
                                            {{ round(($completedTasks / $taskCount) * 100) }}% {{ __('done') }}
                                        </div>
                                    @endif
                                </div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="text-sm font-medium text-foreground">{{ $user->permissions_count }}</div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                <flux:button wire:navigate href="/users/{{ $user->id }}" variant="outline"
                                    size="sm"
                                    class="hover:bg-blue-50 dark:hover:bg-blue-900/20 border-blue-200 dark:border-blue-800 whitespace-nowrap">
                                    <svg class="w-3 h-3 mr-1" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"
                                        fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                        stroke-linejoin="round">
                                        <path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"></path>
                                        <circle cx="12" cy="12" r="3"></circle>
                                    </svg>
                                    {{ __('View') }}
                                </flux:button>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="px-6 py-12 text-center">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                    viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                    stroke-linecap="round" stroke-linejoin="round"
                                    class="mx-auto h-12 w-12 text-zinc-400">
                                    <path d="M16 21v-2a4 4 0 0 0-4-4H6a4 4 0 0 0-4 4v2"></path>
                                    <circle cx="9" cy="7" r="4"></circle>
                                    <path d="M22 21v-2a4 4 0 0 0-3-3.87"></path>
                                    <path d="M16 3.13a4 4 0 0 1 0 7.75"></path>
                                </svg>
                                <h3 class="mt-2 text-sm font-medium text-zinc-900 dark:text-zinc-100">
                                    {{ __('No users found') }}</h3>
                                <p class="mt-1 text-sm text-zinc-500 dark:text-zinc-400">
                                    {{ __('Get started by creating a new user.') }}</p>
                                <div class="mt-6">
                                    <flux:button wire:navigate href="/users/create" class="gap-2">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                            viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                            stroke-linecap="round" stroke-linejoin="round" class="h-4 w-4">
                                            <path d="M5 12h14"></path>
                                            <path d="M12 5v14"></path>
                                        </svg>
                                        {{ __('Add User') }}
                                    </flux:button>
                                </div>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    <!-- Pagination -->
    @if ($users->hasPages())
        <div class="flex items-center justify-between">
            <div class="text-sm text-muted-foreground">
                {{ __('Showing :from to :to of :total results', [
                    'from' => $users->firstItem(),
                    'to' => $users->lastItem(),
                    'total' => $users->total(),
                ]) }}
            </div>
            <div>
                {{ $users->links() }}
            </div>
        </div>
    @endif
</div>
