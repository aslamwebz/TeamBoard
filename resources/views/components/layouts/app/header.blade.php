<header x-data="{
    darkMode: $persist(false).as('dark-mode'),
    mobileMenuOpen: false,
    profileMenuOpen: false,
    init() {
        // Set initial dark mode
        if (this.darkMode) {
            document.documentElement.classList.add('dark');
        } else {
            document.documentElement.classList.remove('dark');
        }
        
        // Watch for changes to dark mode
        this.$watch('darkMode', value => {
            if (value) {
                document.documentElement.classList.add('dark');
            } else {
                document.documentElement.classList.remove('dark');
            }
        });
    }
}" x-init="init" class="sticky top-0 z-40 border-b border-zinc-200 bg-white/80 backdrop-blur-md dark:border-zinc-800 dark:bg-zinc-900/80">
    <div class="mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex h-16 items-center justify-between">
            <!-- Mobile menu button -->
            <div class="flex lg:hidden">
                <button type="button" 
                        @click="mobileMenuOpen = !mobileMenuOpen" 
                        class="inline-flex items-center justify-center rounded-md p-2 text-zinc-500 hover:bg-zinc-100 hover:text-zinc-900 focus:outline-none focus:ring-2 focus:ring-inset focus:ring-blue-500 dark:text-zinc-400 dark:hover:bg-zinc-800 dark:hover:text-white"
                        aria-controls="mobile-menu"
                        :aria-expanded="mobileMenuOpen">
                    <span class="sr-only">Open main menu</span>
                    <svg x-show="!mobileMenuOpen" class="block h-6 w-6" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" aria-hidden="true">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M3.75 6.75h16.5M3.75 12h16.5m-16.5 5.25h16.5" />
                    </svg>
                    <svg x-show="mobileMenuOpen" class="block h-6 w-6" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" aria-hidden="true">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>

            <!-- Logo -->
            <div class="flex-shrink-0">
                <a href="{{ route('dashboard') }}" class="flex items-center">
                    <x-application-logo class="h-8 w-auto" />
                </a>
            </div>

            <!-- Desktop Navigation -->
            <nav class="hidden lg:ml-6 lg:flex lg:space-x-8">
                <a href="{{ route('projects') }}" class="inline-flex items-center border-b-2 {{ request()->routeIs('projects') ? 'border-blue-500 text-zinc-900 dark:border-blue-400 dark:text-white' : 'border-transparent text-zinc-500 hover:border-zinc-300 hover:text-zinc-700 dark:text-zinc-300 dark:hover:border-zinc-600 dark:hover:text-white' }} px-1 pt-1 text-sm font-medium" wire:navigate>
                    {{ __('Projects') }}
                </a>
                <a href="{{ route('tasks') }}" class="inline-flex items-center border-b-2 {{ request()->routeIs('tasks') ? 'border-blue-500 text-zinc-900 dark:border-blue-400 dark:text-white' : 'border-transparent text-zinc-500 hover:border-zinc-300 hover:text-zinc-700 dark:text-zinc-300 dark:hover:border-zinc-600 dark:hover:text-white' }} px-1 pt-1 text-sm font-medium" wire:navigate>
                    {{ __('Tasks') }}
                </a>
                <a href="{{ route('users') }}" class="inline-flex items-center border-b-2 {{ request()->routeIs('users') ? 'border-blue-500 text-zinc-900 dark:border-blue-400 dark:text-white' : 'border-transparent text-zinc-500 hover:border-zinc-300 hover:text-zinc-700 dark:text-zinc-300 dark:hover:border-zinc-600 dark:hover:text-white' }} px-1 pt-1 text-sm font-medium" wire:navigate>
                    {{ __('Team') }}
                </a>
            </nav>

            <!-- Right side items -->
            <div class="hidden lg:ml-4 lg:flex lg:items-center">
                <!-- Theme Toggle -->
                <button type="button" 
                        @click="darkMode = !darkMode" 
                        class="rounded-full p-2 text-zinc-500 hover:bg-zinc-100 hover:text-zinc-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 dark:text-zinc-400 dark:hover:bg-zinc-800 dark:hover:text-white">
                    <span class="sr-only">Toggle dark mode</span>
                    <svg x-show="!darkMode" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20.354 15.354A9 9 0 018.646 3.646 9.003 9.003 0 0012 21a9.003 9.003 0 008.354-5.646z" />
                    </svg>
                    <svg x-show="darkMode" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 3v1m0 16v1m9-9h-1M4 12H3m15.364 6.364l-.707-.707M6.343 6.343l-.707-.707m12.728 0l-.707.707M6.343 17.657l-.707.707M16 12a4 4 0 11-8 0 4 4 0 018 0z" />
                    </svg>
                </button>

                <!-- Notifications -->
                <button type="button" class="ml-4 flex-shrink-0 rounded-full bg-white p-1 text-zinc-500 hover:text-zinc-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 dark:bg-zinc-800 dark:text-zinc-400 dark:hover:text-white">
                    <span class="sr-only">View notifications</span>
                    <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" aria-hidden="true">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M14.857 17.082a23.848 23.848 0 005.454-1.31A8.967 8.967 0 0118 9.75v-.7V9A6 6 0 006 9v.75a8.967 8.967 0 01-2.312 6.022c1.733.64 3.56 1.085 5.455 1.31m5.714 0a24.255 24.255 0 01-5.714 0m5.714 0a3 3 0 11-5.714 0" />
                    </svg>
                </button>

                <!-- Profile dropdown -->
                <div class="relative ml-4 flex-shrink-0">
                    <div>
                        <button type="button" 
                                @click="profileMenuOpen = !profileMenuOpen" 
                                class="flex rounded-full bg-white text-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 dark:bg-zinc-800" 
                                id="user-menu-button" 
                                aria-expanded="false" 
                                aria-haspopup="true">
                            <span class="sr-only">Open user menu</span>
                            <div class="h-8 w-8 rounded-full bg-zinc-100 flex items-center justify-center text-zinc-600 dark:bg-zinc-700 dark:text-zinc-300">
                                {{ auth()->user()->initials() }}
                            </div>
                        </button>
                    </div>

                    <!-- Dropdown menu -->
                    <div x-show="profileMenuOpen" 
                         @click.away="profileMenuOpen = false"
                         class="absolute right-0 z-10 mt-2 w-48 origin-top-right rounded-md bg-white py-1 shadow-lg ring-1 ring-black ring-opacity-5 focus:outline-none dark:bg-zinc-800" 
                         role="menu" 
                         aria-orientation="vertical" 
                         aria-labelledby="user-menu-button" 
                         tabindex="-1">
                        <a href="{{ route('settings.profile') }}" 
                           class="block px-4 py-2 text-sm text-zinc-700 hover:bg-zinc-100 dark:text-zinc-300 dark:hover:bg-zinc-700" 
                           role="menuitem" 
                           tabindex="-1" 
                           wire:navigate>
                            {{ __('Settings') }}
                        </a>
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button type="submit" 
                                    class="block w-full px-4 py-2 text-left text-sm text-zinc-700 hover:bg-zinc-100 dark:text-zinc-300 dark:hover:bg-zinc-700" 
                                    role="menuitem" 
                                    tabindex="-1">
                                {{ __('Sign out') }}
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Mobile menu, show/hide based on menu state. -->
    <div x-show="mobileMenuOpen" 
         x-transition:enter="transition ease-out duration-200"
         x-transition:enter-start="opacity-0 scale-95"
         x-transition:enter-end="opacity-100 scale-100"
         x-transition:leave="transition ease-in duration-150"
         x-transition:leave-start="opacity-100 scale-100"
         x-transition:leave-end="opacity-0 scale-95"
         class="lg:hidden" 
         id="mobile-menu">
        <div class="space-y-1 pb-3 pt-2">
            <a href="{{ route('dashboard') }}" class="block border-l-4 border-blue-500 bg-blue-50 py-2 pl-3 pr-4 text-base font-medium text-blue-700 dark:border-blue-400 dark:bg-blue-900/30 dark:text-white">
                {{ __('Dashboard') }}
            </a>
            <a href="{{ route('projects') }}" class="block border-l-4 border-transparent py-2 pl-3 pr-4 text-base font-medium text-zinc-600 hover:border-zinc-300 hover:bg-zinc-50 hover:text-zinc-800 dark:text-zinc-300 dark:hover:bg-zinc-700 dark:hover:text-white">
                {{ __('Projects') }}
            </a>
            <a href="{{ route('tasks') }}" class="block border-l-4 border-transparent py-2 pl-3 pr-4 text-base font-medium text-zinc-600 hover:border-zinc-300 hover:bg-zinc-50 hover:text-zinc-800 dark:text-zinc-300 dark:hover:bg-zinc-700 dark:hover:text-white">
                {{ __('Tasks') }}
            </a>
            <a href="{{ route('users') }}" class="block border-l-4 border-transparent py-2 pl-3 pr-4 text-base font-medium text-zinc-600 hover:border-zinc-300 hover:bg-zinc-50 hover:text-zinc-800 dark:text-zinc-300 dark:hover:bg-zinc-700 dark:hover:text-white">
                {{ __('Team') }}
            </a>
        </div>
        <div class="border-t border-zinc-200 pb-3 pt-4 dark:border-zinc-700">
            <div class="flex items-center px-4">
                <div class="flex-shrink-0">
                    <div class="h-10 w-10 rounded-full bg-zinc-100 flex items-center justify-center text-zinc-600 dark:bg-zinc-700 dark:text-zinc-300">
                        {{ auth()->user()->initials() }}
                    </div>
                </div>
                <div class="ml-3">
                    <div class="text-base font-medium text-zinc-800 dark:text-white">{{ auth()->user()->name }}</div>
                    <div class="text-sm font-medium text-zinc-500 dark:text-zinc-400">{{ auth()->user()->email }}</div>
                </div>
                <button type="button" class="ml-auto flex-shrink-0 rounded-full bg-white p-1 text-zinc-500 hover:text-zinc-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 dark:bg-zinc-800 dark:text-zinc-400 dark:hover:text-white">
                    <span class="sr-only">View notifications</span>
                    <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" aria-hidden="true">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M14.857 17.082a23.848 23.848 0 005.454-1.31A8.967 8.967 0 0118 9.75v-.7V9A6 6 0 006 9v.75a8.967 8.967 0 01-2.312 6.022c1.733.64 3.56 1.085 5.455 1.31m5.714 0a24.255 24.255 0 01-5.714 0m5.714 0a3 3 0 11-5.714 0" />
                    </svg>
                </button>
            </div>
            <div class="mt-3 space-y-1">
                <a href="{{ route('settings.profile') }}" class="block px-4 py-2 text-base font-medium text-zinc-500 hover:bg-zinc-100 hover:text-zinc-800 dark:text-zinc-400 dark:hover:bg-zinc-700 dark:hover:text-white" wire:navigate>
                    {{ __('Settings') }}
                </a>
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="block w-full px-4 py-2 text-left text-base font-medium text-zinc-500 hover:bg-zinc-100 hover:text-zinc-800 dark:text-zinc-400 dark:hover:bg-zinc-700 dark:hover:text-white">
                        {{ __('Sign out') }}
                    </button>
                </form>
            </div>
        </div>
    </div>
</header>

<!-- Initialize Alpine.js state -->
<div x-data="{
    darkMode: $persist(false).as('dark-mode'),
    mobileMenuOpen: false,
    profileMenuOpen: false,
    init() {
        // Set initial dark mode
        if (this.darkMode) {
            document.documentElement.classList.add('dark');
        } else {
            document.documentElement.classList.remove('dark');
        }
        
        // Watch for changes to dark mode
        this.$watch('darkMode', value => {
            if (value) {
                document.documentElement.classList.add('dark');
            } else {
                document.documentElement.classList.remove('dark');
            }
        });
    }
}" x-init="init"></div>