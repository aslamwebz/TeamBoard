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
        @if (auth()->user()->hasRole('client') && auth()->user()->roles()->count() <= 1)
            <x-layouts.app.client-sidebar />
        @elseif(auth()->user()->hasRole('worker') && auth()->user()->roles()->count() <= 1)
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
