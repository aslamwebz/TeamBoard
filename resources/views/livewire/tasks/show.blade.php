<div class="bg-white max-w-3xl mx-auto p-6">
    <div class="mb-6">
        <a href="{{ route('tasks') }}"
            class="inline-flex items-center text-sm text-zinc-600 hover:text-zinc-900 dark:text-zinc-400 dark:hover:text-zinc-200">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1" fill="none" viewBox="0 0 24 24"
                stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
            </svg>
            {{ __('Back to Tasks') }}
        </a>
        <h1 class="text-3xl font-bold text-foreground mt-2">{{ $task->title }}</h1>
    </div>

    <div class="bg-white rounded-lg shadow-md p-6">
        <div class=" bg-white grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
            <div>
                <h2 class="text-sm font-medium text-zinc-500 dark:text-zinc-400">{{ __('Status') }}</h2>
                @php
                    $statusColors = [
                        'todo' => 'bg-white text-zinc-800 dark:text-zinc-300',
                        'in_progress' => 'text-blue-800 dark:text-blue-400',
                        'completed' => 'text-green-800 dark:text-green-400',
                        'on_hold' => 'text-red-800 dark:text-red-400',
                    ];
                @endphp
                <p class="mt-1">
                    <span
                        class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full {{ $statusColors[$task->status] ?? 'text-zinc-800  dark:text-zinc-300' }}">
                        {{ ucfirst(str_replace('_', ' ', $task->status)) }}
                    </span>
                </p>
            </div>
            <div>
                <h2 class="text-sm font-medium text-zinc-500 dark:text-zinc-400">{{ __('Due Date') }}</h2>
                <p class="mt-1 text-foreground">
                    {{ $task->due_date ? $task->due_date->format('M d, Y') : 'No due date' }}
                </p>
            </div>
            <div>
                <h2 class="text-sm font-medium text-zinc-500 dark:text-zinc-400">{{ __('Project') }}</h2>
                <p class="mt-1 text-foreground">
                    {{ $task->project->name ?? 'No Project' }}
                </p>
            </div>
            <div>
                <h2 class="text-sm font-medium text-zinc-500 dark:text-zinc-400">{{ __('Assigned To') }}</h2>
                <p class="mt-1 text-foreground">
                    {{ $task->user->name ?? 'Unassigned' }}
                </p>
            </div>
        </div>

        @if ($task->description)
            <div class="mb-6">
                <h2 class="text-sm font-medium text-zinc-500 dark:text-zinc-400">{{ __('Description') }}</h2>
                <p class="mt-1 text-foreground whitespace-pre-wrap">
                    {{ $task->description }}
                </p>
            </div>
        @endif>

        <div class="flex justify-end space-x-3">
            <a href="{{ route('tasks') }}"
                class="px-4 py-2 border border-zinc-300 rounded-md text-zinc-700 hover:bg-zinc-50 dark:border-zinc-600 dark:text-zinc-300 dark:hover:bg-zinc-700">
                {{ __('Back to Tasks') }}
            </a>
            <a href="{{ route('tasks.edit', $task) }}"
                class="px-4 py-2 bg-blue-600 text-white rounded-md hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 dark:focus:ring-offset-zinc-900">
                {{ __('Edit Task') }}
            </a>
        </div>
    </div>
</div>
