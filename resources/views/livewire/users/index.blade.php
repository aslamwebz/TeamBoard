<div class="space-y-6">
    <div class="flex items-center justify-between">
        <div>
            <h1 class="text-3xl font-bold text-foreground">{{ __('Users') }}</h1>
            <p class="text-muted-foreground">{{ __('Manage team members and their permissions') }}</p>
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
            <option value="all">{{ __('All Roles') }}</option>
            <option value="admin">{{ __('Administrator') }}</option>
            <option value="manager">{{ __('Manager') }}</option>
            <option value="member">{{ __('Member') }}</option>
        </flux:select>
    </div>

    <!-- User List -->
    <div class="overflow-hidden rounded-xl border border-zinc-200 dark:border-zinc-700">
        <div
            class="grid grid-cols-12 gap-4 border-b border-zinc-200 bg-zinc-50 px-6 py-3 text-sm font-medium text-zinc-500 dark:border-zinc-700 dark:bg-zinc-900 dark:text-zinc-400">
            <div class="col-span-4">{{ __('User') }}</div>
            <div class="col-span-3">{{ __('Role') }}</div>
            <div class="col-span-3">{{ __('Status') }}</div>
            <div class="col-span-2 text-right">{{ __('Actions') }}</div>
        </div>
        <div class="divide-y divide-zinc-200 dark:divide-zinc-700">
            @forelse($users as $user)
                <div class="grid grid-cols-12 gap-4 px-6 py-4">
                    <div class="col-span-4 flex items-center gap-3">
                        <div class="relative flex h-8 w-8 shrink-0 overflow-hidden rounded-lg">
                            <div
                                class="flex h-full w-full items-center justify-center rounded-lg bg-blue-100 text-blue-800 dark:bg-blue-900/30 dark:text-blue-300">
                                {{ $user->initials() }}
                            </div>
                        </div>
                        <div>
                            <div class="font-medium text-foreground">{{ $user->name }}</div>
                            <div class="text-sm text-zinc-500 dark:text-zinc-400">{{ $user->email }}</div>
                        </div>
                    </div>
                    <div class="col-span-3 flex items-center">
                        <flux:badge class="bg-green-500/10 text-green-700 dark:text-green-400">
                            {{ __('Member') }}
                        </flux:badge>
                    </div>
                    <div class="col-span-3 flex items-center">
                        <flux:badge class="bg-green-500/10 text-green-700 dark:text-green-400">
                            {{ __('Active') }}
                        </flux:badge>
                    </div>
                    <div class="col-span-2 flex justify-end gap-2">
                            <flux:button 
                                wire:navigate 
                                href="/users/{{ $user->id }}/edit"
                                variant="outline"
                                size="sm"
                                class="hover:bg-blue-50 dark:hover:bg-blue-900/20 border-blue-200 dark:border-blue-800 whitespace-nowrap min-w-[60px]"
                            >
                                <svg class="w-3 h-3 mr-1" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                    <path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"></path>
                                    <path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z"></path>
                                </svg>
                                {{ __('Edit') }}
                            </flux:button>
                            <flux:button 
                                wire:click="deleteUser({{ $user->id }})"
                                wire:confirm="{{ __('Are you sure you want to delete this user?') }}"
                                variant="outline"
                                size="sm"
                                class="hover:bg-blue-50 dark:hover:bg-blue-900/20 border-blue-200 dark:border-blue-800 !whitespace-nowrap !min-w-[60px]"
                            >
                                <svg class="w-3 h-3 mr-1" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                    <polyline points="3,6 5,6 21,6"></polyline>
                                    <path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"></path>
                                </svg>
                                {{ __('Delete') }}
                            </flux:button>
                        </div>
                </div>
            @empty
                <div class="px-6 py-12 text-center">
                    <div class="text-zinc-500 dark:text-zinc-400">
                        {{ __('No users found.') }}
                    </div>
                </div>
            @endforelse
        </div>
    </div>

    <!-- Pagination -->
    @if ($users->hasPages())
        <div class="flex items-center justify-between">
            <div class="text-sm text-zinc-500 dark:text-zinc-400">
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
</div>
