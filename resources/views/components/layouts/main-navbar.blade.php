<nav class="fixed top-0 z-50 w-full border-b border-zinc-200 bg-white/80 backdrop-blur-md dark:border-zinc-800 dark:bg-zinc-900/80">
    <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
        <div class="flex h-16 items-center justify-between">
            <!-- Logo -->
            <div class="flex-shrink-0">
                <a href="{{ route('home') }}" wire:navigate class="flex items-center">
                    <x-application-logo class="h-8 w-auto" />
                    <span class="ml-2 text-xl font-bold text-zinc-900 dark:text-white">{{ config('app.name') }}</span>
                </a>
            </div>

            <!-- Desktop Navigation -->
            <div class="hidden md:block">
                <div class="ml-10 flex items-center space-x-8">
                    <a href="#features" @click="mobileMenuOpen = false" class="text-sm font-medium text-zinc-700 hover:text-blue-600 dark:text-zinc-300 dark:hover:text-blue-400">
                        {{ __('Features') }}
                    </a>
                    <a href="#pricing" @click="mobileMenuOpen = false" class="text-sm font-medium text-zinc-700 hover:text-blue-600 dark:text-zinc-300 dark:hover:text-blue-400">
                        {{ __('Pricing') }}
                    </a>
                    <a href="#contact" @click="mobileMenuOpen = false" class="text-sm font-medium text-zinc-700 hover:text-blue-600 dark:text-zinc-300 dark:hover:text-blue-400">
                        {{ __('Contact') }}
                    </a>
                </div>
            </div>

            <!-- Auth Buttons -->
            <div class="hidden md:block">
                <div class="ml-4 flex items-center space-x-4 md:ml-6">
                    <a href="{{ route('login') }}" wire:navigate class="inline-flex items-center rounded-md px-4 py-2 text-sm font-medium text-zinc-700 hover:bg-zinc-100 hover:text-zinc-900 dark:text-zinc-300 dark:hover:bg-zinc-800 dark:hover:text-white">
                        {{ __('Sign in') }}
                    </a>
                    <a href="{{ route('register') }}" wire:navigate class="inline-flex w-full justify-center rounded-md bg-blue-600 px-4 py-2 text-sm font-medium text-white hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 dark:focus:ring-offset-gray-900">
                        {{ __('Get started') }}
                    </a>
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
                </div>
            </div>

            <!-- Mobile menu button -->
            <div class="-mr-2 flex md:hidden">
                <button type="button" 
                        @click="mobileMenuOpen = !mobileMenuOpen" 
                        class="inline-flex items-center justify-center rounded-md p-2 text-zinc-700 hover:bg-zinc-100 hover:text-zinc-900 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 dark:text-zinc-300 dark:hover:bg-zinc-800 dark:hover:text-white"
                        aria-controls="mobile-menu"
                        :aria-expanded="mobileMenuOpen">
                    <span class="sr-only">Open main menu</span>
                    <svg x-show="!mobileMenuOpen" class="block h-6 w-6" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M3.75 6.75h16.5M3.75 12h16.5m-16.5 5.25h16.5" />
                    </svg>
                    <svg x-show="mobileMenuOpen" class="block h-6 w-6" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
        </div>
    </div>

    <!-- Mobile menu, show/hide based on menu state -->
    <div x-show="mobileMenuOpen" 
         x-transition:enter="transition ease-out duration-200"
         x-transition:enter-start="opacity-0 scale-95"
         x-transition:enter-end="opacity-100 scale-100"
         x-transition:leave="transition ease-in duration-150"
         x-transition:leave-start="opacity-100 scale-100"
         x-transition:leave-end="opacity-0 scale-95"
         class="md:hidden" 
         id="mobile-menu">
        <div class="space-y-1 pb-3 pt-2">
            <a href="#features" 
               class="block border-l-4 border-transparent py-2 pl-3 pr-4 text-base font-medium text-zinc-600 hover:border-zinc-300 hover:bg-zinc-50 hover:text-zinc-800 dark:text-zinc-300 dark:hover:bg-zinc-700 dark:hover:text-white"
               @click="mobileMenuOpen = false">
                {{ __('Features') }}
            </a>
            <a href="#pricing" 
               class="block border-l-4 border-transparent py-2 pl-3 pr-4 text-base font-medium text-zinc-600 hover:border-zinc-300 hover:bg-zinc-50 hover:text-zinc-800 dark:text-zinc-300 dark:hover:bg-zinc-700 dark:hover:text-white"
               @click="mobileMenuOpen = false">
                {{ __('Pricing') }}
            </a>
            <a href="#contact" 
               class="block border-l-4 border-transparent py-2 pl-3 pr-4 text-base font-medium text-zinc-600 hover:border-zinc-300 hover:bg-zinc-50 hover:text-zinc-800 dark:text-zinc-300 dark:hover:bg-zinc-700 dark:hover:text-white"
               @click="mobileMenuOpen = false">
                {{ __('Contact') }}
            </a>
        </div>
        <div class="border-t border-zinc-200 pb-3 pt-4 dark:border-zinc-700">
            <div class="flex items-center px-4">
                <div class="flex-1">
                    <div class="text-base font-medium text-zinc-800 dark:text-white">Get Started</div>
                </div>
                <div class="flex space-x-2">
                    <a href="{{ route('login') }}" class="inline-flex items-center rounded-md border border-transparent bg-zinc-100 px-4 py-2 text-sm font-medium text-zinc-700 hover:bg-zinc-200 dark:bg-zinc-800 dark:text-zinc-300 dark:hover:bg-zinc-700">
                        {{ __('Sign in') }}
                    </a>
                </div>
            </div>
            <div class="mt-3 space-y-1">
                <a href="{{ route('register') }}" class="block w-full px-4 py-2 text-base font-medium text-zinc-500 hover:bg-zinc-100 hover:text-zinc-800 dark:text-zinc-400 dark:hover:bg-zinc-700 dark:hover:text-white">
                    {{ __('Create account') }}
                </a>
            </div>
        </div>
    </div>
</nav>

<!-- Add padding to account for fixed navbar -->
<div class="h-16"></div>
