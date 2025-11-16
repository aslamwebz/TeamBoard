<div class="max-w-7xl mx-auto p-6">
    <div class="mb-6">
        <a href="{{ route('users') }}"
            class="inline-flex items-center text-sm text-zinc-600 hover:text-zinc-900 dark:text-zinc-400 dark:hover:text-zinc-200">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1" fill="none" viewBox="0 0 24 24"
                stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
            </svg>
            {{ __('Back to Users') }}
        </a>
    </div>

    <!-- User Details -->
    <div class="bg-white dark:bg-zinc-800 rounded-lg shadow p-6 mb-6">
        <div class="flex items-center mb-6">
            <div
                class="w-16 h-16 bg-blue-500 rounded-full flex items-center justify-center text-white text-2xl font-bold mr-4">
                {{ Str::substr($user->name, 0, 1) }}{{ Str::substr(explode(' ', $user->name)[1] ?? '', 0, 1) }}
            </div>
            <div>
                <h1 class="text-2xl font-bold text-foreground">{{ $user->name }}</h1>
                <p class="text-zinc-600 dark:text-zinc-400">{{ $user->email }}</p>
            </div>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <div>
                <h3 class="text-lg font-semibold text-foreground mb-3">{{ __('User Information') }}</h3>
                <div class="space-y-2">
                    <div class="flex justify-between">
                        <span class="text-zinc-600 dark:text-zinc-400">{{ __('Email') }}:</span>
                        <span class="text-foreground">{{ $user->email }}</span>
                    </div>
                    <div class="flex justify-between">
                        <span class="text-zinc-600 dark:text-zinc-400">{{ __('Created') }}:</span>
                        <span class="text-foreground">{{ $user->created_at->format('M d, Y') }}</span>
                    </div>
                    @if ($user->updated_at->gt($user->created_at))
                        <div class="flex justify-between">
                            <span class="text-zinc-600 dark:text-zinc-400">{{ __('Last Updated') }}:</span>
                            <span class="text-foreground">{{ $user->updated_at->format('M d, Y') }}</span>
                        </div>
                    @endif
                </div>
            </div>

            <div>
                <h3 class="text-lg font-semibold text-foreground mb-3">{{ __('Statistics') }}</h3>
                <div class="space-y-2">
                    <div class="flex justify-between">
                        <span class="text-zinc-600 dark:text-zinc-400">{{ __('Projects') }}:</span>
                        <span class="text-foreground">{{ $user->projects()->count() }}</span>
                    </div>
                    <div class="flex justify-between">
                        <span class="text-zinc-600 dark:text-zinc-400">{{ __('Tasks') }}:</span>
                        <span class="text-foreground">{{ $user->tasks()->count() }}</span>
                    </div>
                    <div class="flex justify-between">
                        <span class="text-zinc-600 dark:text-zinc-400">{{ __('Clients') }}:</span>
                        <span class="text-foreground">{{ $user->clients()->count() }}</span>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Action Buttons -->
    <div class="flex gap-4">
        <a href="{{ route('users.edit', $user) }}"
            class="inline-flex items-center px-4 py-2 bg-blue-600 text-white rounded-md hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 dark:focus:ring-offset-zinc-900">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-2" fill="none" viewBox="0 0 24 24"
                stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
            </svg>
            {{ __('Edit User') }}
        </a>
    </div>
</div>
