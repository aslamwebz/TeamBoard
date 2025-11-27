<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="h-full">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ $title ?? config('app.name', 'TeamBoard') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">

    <!-- Styles -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @livewireStyles
    @filamentStyles
    @fluxAppearance

    <!-- Navigation Preloading -->
    @livewire('navigation-handler', key('navigation-handler'))

    <style>
        /* Navigation loading indicator */
        .navigate-loading {
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
            height: 3px;
            background: linear-gradient(90deg, #3b82f6, #8b5cf6, #ec4899, #f59e0b, #10b981);
            background-size: 200% 100%;
            animation: gradient 2s ease infinite;
            transform-origin: left;
            transform: scaleX(0);
            z-index: 9999;
            transition: transform 0.3s ease-out;
        }

        @keyframes gradient {
            0% {
                background-position: 0% 50%;
            }

            50% {
                background-position: 100% 50%;
            }

            100% {
                background-position: 0% 50%;
            }
        }

        .navigate-loading.active {
            transform: scaleX(1);
            transition: transform 10s cubic-bezier(0.1, 0.8, 0.2, 1);
        }
    </style>
</head>

<body class="font-sans antialiased bg-white dark:bg-gray-900 text-gray-900 dark:text-white h-full"
    x-data="{
        isLoading: false,
        preloaded: new Set(),
        preloadLink(url) {
            if (!this.preloaded.has(url)) {
                fetch(url, {
                    headers: { 'X-Livewire': 'true' },
                    credentials: 'same-origin'
                });
                this.preloaded.add(url);
            }
        }
    }" @navigating.window="isLoading = true"
    @navigated.window="setTimeout(() => { isLoading = false }, 300)">
    <div class="navigate-loading" :class="{ 'active': isLoading }"></div>
    <div class="flex h-full">
        <!-- Sidebar -->
        @if(auth()->user()->hasRole('worker') && auth()->user()->roles()->count() <= 1)
            <x-layouts.app.worker-sidebar />
        @else
            <x-layouts.app.sidebar />
        @endif

        <!-- Main content -->
        <div class="flex-1 overflow-y-auto">
            <x-layouts.app.header />

            <main class="p-6">
                {{ $slot }}
            </main>
        </div>
    </div>

    @livewireScripts
    @filamentScripts
    @fluxScripts
</body>

</html>
