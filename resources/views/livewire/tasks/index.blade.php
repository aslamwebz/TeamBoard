<div class="space-y-6">
    <div class="flex items-center justify-between">
        <div>
            <h1 class="text-3xl font-bold text-foreground">{{ __('Tasks') }}</h1>
            <p class="text-muted-foreground">{{ __('Track and manage your daily tasks') }}</p>
        </div>
        <flux:button class="gap-2">
            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="h-4 w-4">
                <path d="M5 12h14"></path>
                <path d="M12 5v14"></path>
            </svg>
            {{ __('New Task') }}
        </flux:button>
    </div>

    <!-- Task Filters -->
    <div class="flex gap-2">
        <flux:button variant="outline" size="sm" class="data-[active]:bg-blue-500 data-[active]:text-white">
            {{ __('All Tasks') }}
        </flux:button>
        <flux:button variant="outline" size="sm" class="data-[active]:bg-green-500 data-[active]:text-white">
            {{ __('To Do') }}
        </flux:button>
        <flux:button variant="outline" size="sm" class="data-[active]:bg-blue-500 data-[active]:text-white">
            {{ __('In Progress') }}
        </flux:button>
        <flux:button variant="outline" size="sm" class="data-[active]:bg-purple-500 data-[active]:text-white">
            {{ __('Review') }}
        </flux:button>
        <flux:button variant="outline" size="sm" class="data-[active]:bg-green-500 data-[active]:text-white">
            {{ __('Completed') }}
        </flux:button>
    </div>

    <!-- Task List -->
    <div class="space-y-3">
        <!-- Task 1 -->
        <div class="relative overflow-hidden rounded-xl border border-zinc-200 bg-white dark:border-zinc-700 dark:bg-zinc-800 p-4 flex items-start gap-3">
            <flux:checkbox />
            <div class="flex-1">
                <div class="flex items-center justify-between">
                    <h3 class="font-medium text-foreground">{{ __('Implement user authentication system') }}</h3>
                    <flux:badge class="bg-blue-500/10 text-blue-700 dark:text-blue-400">
                        {{ __('In Progress') }}
                    </flux:badge>
                </div>
                <p class="text-sm text-zinc-500 dark:text-zinc-400 mt-1">{{ __('Create secure login and registration forms with validation') }}</p>
                <div class="flex items-center gap-4 mt-2 text-xs text-zinc-500 dark:text-zinc-400">
                    <div class="flex items-center gap-1">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="h-4 w-4">
                            <path d="M12 2v4"></path>
                            <path d="M18 8h-4"></path>
                            <path d="M20 12h-4"></path>
                            <path d="M20 18l-4-4"></path>
                            <path d="M8 18l4-4"></path>
                            <path d="M2 12h4"></path>
                            <path d="M4 4l4 4"></path>
                            <path d="M4 20l4-4"></path>
                        </svg>
                        {{ __('Due: 2024-01-15') }}
                    </div>
                    <div class="flex items-center gap-1">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="h-4 w-4">
                            <path d="M9 10h.01"></path>
                            <path d="M14 10h.01"></path>
                            <path d="M19 10h.01"></path>
                            <path d="M5 14h12a2 2 0 0 0 2-2V5a2 2 0 0 0-2-2H5a2 2 0 0 0-2 2v7a2 2 0 0 0 2 2"></path>
                            <path d="M3 22v-3a2 2 0 0 1 2-2h14a2 2 0 0 1 2 2v3"></path>
                        </svg>
                        {{ __('Priority: High') }}
                    </div>
                </div>
            </div>
        </div>

        <!-- Task 2 -->
        <div class="relative overflow-hidden rounded-xl border border-zinc-200 bg-white dark:border-zinc-700 dark:bg-zinc-800 p-4 flex items-start gap-3">
            <flux:checkbox />
            <div class="flex-1">
                <div class="flex items-center justify-between">
                    <h3 class="font-medium text-foreground">{{ __('Design new dashboard interface') }}</h3>
                    <flux:badge class="bg-purple-500/10 text-purple-700 dark:text-purple-400">
                        {{ __('Review') }}
                    </flux:badge>
                </div>
                <p class="text-sm text-zinc-500 dark:text-zinc-400 mt-1">{{ __('Create wireframes and mockups for the updated dashboard') }}</p>
                <div class="flex items-center gap-4 mt-2 text-xs text-zinc-500 dark:text-zinc-400">
                    <div class="flex items-center gap-1">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="h-4 w-4">
                            <path d="M12 2v4"></path>
                            <path d="M18 8h-4"></path>
                            <path d="M20 12h-4"></path>
                            <path d="M20 18l-4-4"></path>
                            <path d="M8 18l4-4"></path>
                            <path d="M2 12h4"></path>
                            <path d="M4 4l4 4"></path>
                            <path d="M4 20l4-4"></path>
                        </svg>
                        {{ __('Due: 2024-01-20') }}
                    </div>
                    <div class="flex items-center gap-1">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="h-4 w-4">
                            <path d="M9 10h.01"></path>
                            <path d="M14 10h.01"></path>
                            <path d="M19 10h.01"></path>
                            <path d="M5 14h12a2 2 0 0 0 2-2V5a2 2 0 0 0-2-2H5a2 2 0 0 0-2 2v7a2 2 0 0 0 2 2"></path>
                            <path d="M3 22v-3a2 2 0 0 1 2-2h14a2 2 0 0 1 2 2v3"></path>
                        </svg>
                        {{ __('Priority: Medium') }}
                    </div>
                </div>
            </div>
        </div>

        <!-- Task 3 -->
        <div class="relative overflow-hidden rounded-xl border border-zinc-200 bg-white dark:border-zinc-700 dark:bg-zinc-800 p-4 flex items-start gap-3">
            <flux:checkbox />
            <div class="flex-1">
                <div class="flex items-center justify-between">
                    <h3 class="font-medium text-foreground">{{ __('Update documentation') }}</h3>
                    <flux:badge class="bg-green-500/10 text-green-700 dark:text-green-400">
                        {{ __('Completed') }}
                    </flux:badge>
                </div>
                <p class="text-sm text-zinc-500 dark:text-zinc-400 mt-1">{{ __('Update API documentation with new endpoints') }}</p>
                <div class="flex items-center gap-4 mt-2 text-xs text-zinc-500 dark:text-zinc-400">
                    <div class="flex items-center gap-1">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="h-4 w-4">
                            <path d="M12 2v4"></path>
                            <path d="M18 8h-4"></path>
                            <path d="M20 12h-4"></path>
                            <path d="M20 18l-4-4"></path>
                            <path d="M8 18l4-4"></path>
                            <path d="M2 12h4"></path>
                            <path d="M4 4l4 4"></path>
                            <path d="M4 20l4-4"></path>
                        </svg>
                        {{ __('Due: 2024-01-10') }}
                    </div>
                    <div class="flex items-center gap-1">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="h-4 w-4">
                            <path d="M9 10h.01"></path>
                            <path d="M14 10h.01"></path>
                            <path d="M19 10h.01"></path>
                            <path d="M5 14h12a2 2 0 0 0 2-2V5a2 2 0 0 0-2-2H5a2 2 0 0 0-2 2v7a2 2 0 0 0 2 2"></path>
                            <path d="M3 22v-3a2 2 0 0 1 2-2h14a2 2 0 0 1 2 2v3"></path>
                        </svg>
                        {{ __('Priority: Low') }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>