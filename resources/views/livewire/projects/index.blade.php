<div class="space-y-6">
    <div class="flex items-center justify-between">
        <div>
            <h1 class="text-3xl font-bold text-foreground">{{ __('Projects') }}</h1>
            <p class="text-muted-foreground">{{ __('Manage your team projects and milestones') }}</p>
        </div>
        <button type="button" class="inline-flex items-center gap-2 px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 dark:focus:ring-offset-zinc-900">
            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="h-4 w-4">
                <path d="M5 12h14"></path>
                <path d="M12 5v14"></path>
            </svg>
            {{ __('New Project') }}
        </button>
    </div>

    <!-- Filters -->
    <div class="flex gap-2">
        <button type="button" class="px-3 py-1.5 text-sm rounded-md border border-zinc-200 bg-white text-zinc-700 hover:bg-zinc-50 dark:border-zinc-700 dark:bg-zinc-800 dark:text-zinc-300 dark:hover:bg-zinc-700">
            {{ __('All') }}
        </button>
        <button type="button" class="px-3 py-1.5 text-sm rounded-md border border-yellow-200 bg-yellow-50 text-yellow-700 hover:bg-yellow-100 dark:border-yellow-700 dark:bg-yellow-900/30 dark:text-yellow-400 dark:hover:bg-yellow-900/50">
            {{ __('Planning') }}
        </button>
        <button type="button" class="px-3 py-1.5 text-sm rounded-md border border-blue-200 bg-blue-50 text-blue-700 hover:bg-blue-100 dark:border-blue-700 dark:bg-blue-900/30 dark:text-blue-400 dark:hover:bg-blue-900/50">
            {{ __('In Progress') }}
        </button>
        <button type="button" class="px-3 py-1.5 text-sm rounded-md border border-green-200 bg-green-50 text-green-700 hover:bg-green-100 dark:border-green-700 dark:bg-green-900/30 dark:text-green-400 dark:hover:bg-green-900/50">
            {{ __('Completed') }}
        </button>
    </div>

    <!-- Projects Grid -->
    <div class="grid gap-6 md:grid-cols-2 lg:grid-cols-3">
        <!-- Project 1 -->
        <div class="relative overflow-hidden rounded-xl border border-zinc-200 bg-white dark:border-zinc-700 dark:bg-zinc-800 hover:shadow-md transition-shadow">
            <div class="flex items-start justify-between p-6 pb-2">
                <div class="space-y-1">
                    <h2 class="text-lg font-semibold text-foreground">{{ __('Website Redesign') }}</h2>
                    <flux:badge class="bg-yellow-500/10 text-yellow-700 dark:text-yellow-400">
                        {{ __('Planning') }}
                    </flux:badge>
                </div>
                <flux:dropdown>
                    <flux:button variant="ghost" >
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="h-4 w-4">
                            <circle cx="12" cy="12" r="1"></circle>
                            <circle cx="19" cy="12" r="1"></circle>
                            <circle cx="5" cy="12" r="1"></circle>
                        </svg>
                    </flux:button>
                    <flux:menu>
                        <flux:menu.item href="{{ route('projects') }}">{{ __('View Details') }}</flux:menu.item>
                        <flux:menu.item href="#" @click.prevent="$dispatch('open-modal', 'edit-project')">{{ __('Edit') }}</flux:menu.item>
                        <flux:menu.item class="text-red-600 dark:text-red-400" @click.prevent="$dispatch('open-modal', 'delete-project')">{{ __('Delete') }}</flux:menu.item>
                    </flux:menu>
                </flux:dropdown>
            </div>
            <div class="p-6 pt-0">
                <p class="mb-4 text-sm text-zinc-500 dark:text-zinc-400">{{ __('Complete overhaul of company website with modern design') }}</p>
                <div class="flex items-center justify-between text-sm text-zinc-500 dark:text-zinc-400">
                    <div class="flex items-center gap-1">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="h-4 w-4">
                            <path d="M8 2v4"></path>
                            <path d="M16 2v4"></path>
                            <rect width="18" height="18" x="3" y="4" rx="2"></rect>
                            <path d="M3 10h18"></path>
                            <path d="M8 14h.01"></path>
                            <path d="M12 14h.01"></path>
                            <path d="M16 14h.01"></path>
                        </svg>
                        {{ __('2024-02-15') }}
                    </div>
                    <div class="flex items-center gap-1">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="h-4 w-4">
                            <path d="M16 21v-2a4 4 0 0 0-4-4H6a4 4 0 0 0-4 4v2"/>
                            <circle cx="9" cy="7" r="4"/>
                            <path d="M22 21v-2a4 4 0 0 0-3-3.87"/>
                            <path d="M16 3.13a4 4 0 0 1 0 7.75"/>
                        </svg>
                        5
                    </div>
                </div>
            </div>
        </div>

        <!-- Project 2 -->
        <div class="relative overflow-hidden rounded-xl border border-zinc-200 bg-white dark:border-zinc-700 dark:bg-zinc-800 hover:shadow-md transition-shadow">
            <div class="flex items-start justify-between p-6 pb-2">
                <div class="space-y-1">
                    <h2 class="text-lg font-semibold text-foreground">{{ __('Mobile App Development') }}</h2>
                    <span class="inline-flex items-center rounded-md bg-blue-50 px-2 py-1 text-xs font-medium text-blue-700 ring-1 ring-inset ring-blue-700/10 dark:bg-blue-900/30 dark:text-blue-400 dark:ring-blue-400/30">
                        {{ __('In Progress') }}
                    </span>
                </div>
                <div class="relative">
                    <button type="button" class="flex items-center justify-center p-1 rounded-full text-zinc-400 hover:bg-zinc-100 hover:text-zinc-600 dark:hover:bg-zinc-700 dark:hover:text-zinc-300">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="h-4 w-4">
                            <circle cx="12" cy="12" r="1"></circle>
                            <circle cx="19" cy="12" r="1"></circle>
                            <circle cx="5" cy="12" r="1"></circle>
                        </svg>
                    </button>
                    <div class="absolute right-0 z-10 mt-2 w-48 origin-top-right rounded-md bg-white py-1 shadow-lg ring-1 ring-black ring-opacity-5 focus:outline-none dark:bg-zinc-800 dark:ring-white/10" role="menu" aria-orientation="vertical" tabindex="-1">
                        <a href="{{ route('projects') }}" class="block px-4 py-2 text-sm text-zinc-700 hover:bg-zinc-100 dark:text-zinc-200 dark:hover:bg-zinc-700" role="menuitem">{{ __('View Details') }}</a>
                        <button type="button" @click="$dispatch('open-modal', 'edit-project')" class="block w-full px-4 py-2 text-left text-sm text-zinc-700 hover:bg-zinc-100 dark:text-zinc-200 dark:hover:bg-zinc-700" role="menuitem">{{ __('Edit') }}</button>
                        <button type="button" @click="$dispatch('open-modal', 'delete-project')" class="block w-full px-4 py-2 text-left text-sm text-red-600 hover:bg-red-50 dark:text-red-400 dark:hover:bg-red-900/30" role="menuitem">{{ __('Delete') }}</button>
                    </div>
                </div>
            </div>
            <div class="p-6 pt-0">
                <p class="mb-4 text-sm text-zinc-500 dark:text-zinc-400">{{ __('Native iOS and Android app for customer engagement') }}</p>
                <div class="flex items-center justify-between text-sm text-zinc-500 dark:text-zinc-400">
                    <div class="flex items-center gap-1">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="h-4 w-4">
                            <path d="M8 2v4"></path>
                            <path d="M16 2v4"></path>
                            <rect width="18" height="18" x="3" y="4" rx="2"></rect>
                            <path d="M3 10h18"></path>
                            <path d="M8 14h.01"></path>
                            <path d="M12 14h.01"></path>
                            <path d="M16 14h.01"></path>
                        </svg>
                        {{ __('2024-03-20') }}
                    </div>
                    <div class="flex items-center gap-1">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="h-4 w-4">
                            <path d="M16 21v-2a4 4 0 0 0-4-4H6a4 4 0 0 0-4 4v2"/>
                            <circle cx="9" cy="7" r="4"/>
                            <path d="M22 21v-2a4 4 0 0 0-3-3.87"/>
                            <path d="M16 3.13a4 4 0 0 1 0 7.75"/>
                        </svg>
                        8
                    </div>
                </div>
            </div>
        </div>

        <!-- Project 3 -->
        <div class="relative overflow-hidden rounded-xl border border-zinc-200 bg-white dark:border-zinc-700 dark:bg-zinc-800 hover:shadow-md transition-shadow">
            <div class="flex items-start justify-between p-6 pb-2">
                <div class="space-y-1">
                    <h2 class="text-lg font-semibold text-foreground">{{ __('Marketing Campaign') }}</h2>
                    <flux:badge class="bg-yellow-500/10 text-yellow-700 dark:text-yellow-400">
                        {{ __('Planning') }}
                    </flux:badge>
                </div>
                <flux:dropdown>
                    <flux:button variant="ghost" >
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="h-4 w-4">
                            <circle cx="12" cy="12" r="1"></circle>
                            <circle cx="19" cy="12" r="1"></circle>
                            <circle cx="5" cy="12" r="1"></circle>
                        </svg>
                    </flux:button>
                    <flux:menu>
                        <flux:menu.item href="{{ route('projects') }}">{{ __('View Details') }}</flux:menu.item>
                        <flux:menu.item href="#" @click.prevent="$dispatch('open-modal', 'edit-project')">{{ __('Edit') }}</flux:menu.item>
                        <flux:menu.item class="text-red-600 dark:text-red-400" @click.prevent="$dispatch('open-modal', 'delete-project')">{{ __('Delete') }}</flux:menu.item>
                    </flux:menu>
                </flux:dropdown>
            </div>
            <div class="p-6 pt-0">
                <p class="mb-4 text-sm text-zinc-500 dark:text-zinc-400">{{ __('Q1 digital marketing campaign planning and execution') }}</p>
                <div class="flex items-center justify-between text-sm text-zinc-500 dark:text-zinc-400">
                    <div class="flex items-center gap-1">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="h-4 w-4">
                            <path d="M8 2v4"></path>
                            <path d="M16 2v4"></path>
                            <rect width="18" height="18" x="3" y="4" rx="2"></rect>
                            <path d="M3 10h18"></path>
                            <path d="M8 14h.01"></path>
                            <path d="M12 14h.01"></path>
                            <path d="M16 14h.01"></path>
                        </svg>
                        {{ __('2024-02-28') }}
                    </div>
                    <div class="flex items-center gap-1">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="h-4 w-4">
                            <path d="M16 21v-2a4 4 0 0 0-4-4H6a4 4 0 0 0-4 4v2"/>
                            <circle cx="9" cy="7" r="4"/>
                            <path d="M22 21v-2a4 4 0 0 0-3-3.87"/>
                            <path d="M16 3.13a4 4 0 0 1 0 7.75"/>
                        </svg>
                        4
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>