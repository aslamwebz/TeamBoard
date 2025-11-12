<div class="space-y-6">
    <div class="flex items-center justify-between">
        <div>
            <h1 class="text-3xl font-bold text-foreground">{{ __('Users') }}</h1>
            <p class="text-muted-foreground">{{ __('Manage team members and their permissions') }}</p>
        </div>
        <flux:button class="gap-2">
            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="h-4 w-4">
                <path d="M5 12h14"></path>
                <path d="M12 5v14"></path>
            </svg>
            {{ __('Add User') }}
        </flux:button>
    </div>

    <!-- User Search -->
    <div class="flex items-center gap-3">
        <flux:input placeholder="{{ __('Search users') }}" class="max-w-xs" />
        <flux:select class="max-w-xs">
            <option value="all">{{ __('All Roles') }}</option>
            <option value="admin">{{ __('Administrator') }}</option>
            <option value="manager">{{ __('Manager') }}</option>
            <option value="member">{{ __('Member') }}</option>
        </flux:select>
    </div>

    <!-- User List -->
    <div class="overflow-hidden rounded-xl border border-zinc-200 dark:border-zinc-700">
        <div class="grid grid-cols-12 gap-4 border-b border-zinc-200 bg-zinc-50 px-6 py-3 text-sm font-medium text-zinc-500 dark:border-zinc-700 dark:bg-zinc-900 dark:text-zinc-400">
            <div class="col-span-4">{{ __('User') }}</div>
            <div class="col-span-3">{{ __('Role') }}</div>
            <div class="col-span-3">{{ __('Status') }}</div>
            <div class="col-span-2 text-right">{{ __('Actions') }}</div>
        </div>
        <div class="divide-y divide-zinc-200 dark:divide-zinc-700">
            <!-- User 1 -->
            <div class="grid grid-cols-12 gap-4 px-6 py-4">
                <div class="col-span-4 flex items-center gap-3">
                    <div class="relative flex h-8 w-8 shrink-0 overflow-hidden rounded-lg">
                        <div class="flex h-full w-full items-center justify-center rounded-lg bg-blue-100 text-blue-800 dark:bg-blue-900/30 dark:text-blue-300">
                            {{ __('JD') }}
                        </div>
                    </div>
                    <div>
                        <div class="font-medium text-foreground">{{ __('John Doe') }}</div>
                        <div class="text-sm text-zinc-500 dark:text-zinc-400">{{ __('john@example.com') }}</div>
                    </div>
                </div>
                <div class="col-span-3 flex items-center">
                    <flux:badge class="bg-green-500/10 text-green-700 dark:text-green-400">
                        {{ __('Administrator') }}
                    </flux:badge>
                </div>
                <div class="col-span-3 flex items-center">
                    <flux:badge class="bg-green-500/10 text-green-700 dark:text-green-400">
                        {{ __('Active') }}
                    </flux:badge>
                </div>
                <div class="col-span-2 flex justify-end">
                    <flux:dropdown>
                        <flux:button variant="ghost" >
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="h-4 w-4">
                                <circle cx="12" cy="12" r="1"></circle>
                                <circle cx="19" cy="12" r="1"></circle>
                                <circle cx="5" cy="12" r="1"></circle>
                            </svg>
                        </flux:button>
                        <flux:menu>
                            <flux:menu.item>{{ __('Edit') }}</flux:menu.item>
                            <flux:menu.item>{{ __('View Profile') }}</flux:menu.item>
                            <flux:menu.item class="text-red-600 dark:text-red-400">{{ __('Deactivate') }}</flux:menu.item>
                        </flux:menu>
                    </flux:dropdown>
                </div>
            </div>

            <!-- User 2 -->
            <div class="grid grid-cols-12 gap-4 px-6 py-4">
                <div class="col-span-4 flex items-center gap-3">
                    <div class="relative flex h-8 w-8 shrink-0 overflow-hidden rounded-lg">
                        <div class="flex h-full w-full items-center justify-center rounded-lg bg-purple-100 text-purple-800 dark:bg-purple-900/30 dark:text-purple-300">
                            {{ __('JS') }}
                        </div>
                    </div>
                    <div>
                        <div class="font-medium text-foreground">{{ __('Jane Smith') }}</div>
                        <div class="text-sm text-zinc-500 dark:text-zinc-400">{{ __('jane@example.com') }}</div>
                    </div>
                </div>
                <div class="col-span-3 flex items-center">
                    <flux:badge class="bg-blue-500/10 text-blue-700 dark:text-blue-400">
                        {{ __('Manager') }}
                    </flux:badge>
                </div>
                <div class="col-span-3 flex items-center">
                    <flux:badge class="bg-green-500/10 text-green-700 dark:text-green-400">
                        {{ __('Active') }}
                    </flux:badge>
                </div>
                <div class="col-span-2 flex justify-end">
                    <flux:dropdown>
                        <flux:button variant="ghost" >
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="h-4 w-4">
                                <circle cx="12" cy="12" r="1"></circle>
                                <circle cx="19" cy="12" r="1"></circle>
                                <circle cx="5" cy="12" r="1"></circle>
                            </svg>
                        </flux:button>
                        <flux:menu>
                            <flux:menu.item>{{ __('Edit') }}</flux:menu.item>
                            <flux:menu.item>{{ __('View Profile') }}</flux:menu.item>
                            <flux:menu.item class="text-red-600 dark:text-red-400">{{ __('Deactivate') }}</flux:menu.item>
                        </flux:menu>
                    </flux:dropdown>
                </div>
            </div>

            <!-- User 3 -->
            <div class="grid grid-cols-12 gap-4 px-6 py-4">
                <div class="col-span-4 flex items-center gap-3">
                    <div class="relative flex h-8 w-8 shrink-0 overflow-hidden rounded-lg">
                        <div class="flex h-full w-full items-center justify-center rounded-lg bg-green-100 text-green-800 dark:bg-green-900/30 dark:text-green-300">
                            {{ __('RB') }}
                        </div>
                    </div>
                    <div>
                        <div class="font-medium text-foreground">{{ __('Robert Brown') }}</div>
                        <div class="text-sm text-zinc-500 dark:text-zinc-400">{{ __('robert@example.com') }}</div>
                    </div>
                </div>
                <div class="col-span-3 flex items-center">
                    <flux:badge class="bg-zinc-500/10 text-zinc-700 dark:text-zinc-400">
                        {{ __('Member') }}
                    </flux:badge>
                </div>
                <div class="col-span-3 flex items-center">
                    <flux:badge class="bg-yellow-500/10 text-yellow-700 dark:text-yellow-400">
                        {{ __('Pending') }}
                    </flux:badge>
                </div>
                <div class="col-span-2 flex justify-end">
                    <flux:dropdown>
                        <flux:button variant="ghost" >
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="h-4 w-4">
                                <circle cx="12" cy="12" r="1"></circle>
                                <circle cx="19" cy="12" r="1"></circle>
                                <circle cx="5" cy="12" r="1"></circle>
                            </svg>
                        </flux:button>
                        <flux:menu>
                            <flux:menu.item>{{ __('Edit') }}</flux:menu.item>
                            <flux:menu.item>{{ __('View Profile') }}</flux:menu.item>
                            <flux:menu.item class="text-red-600 dark:text-red-400">{{ __('Deactivate') }}</flux:menu.item>
                        </flux:menu>
                    </flux:dropdown>
                </div>
            </div>
        </div>
    </div>
</div>