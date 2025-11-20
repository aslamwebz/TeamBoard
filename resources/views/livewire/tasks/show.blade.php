<div class="max-w-4xl mx-auto p-6">
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

    <div class="bg-white dark:bg-zinc-800 rounded-lg border border-zinc-200 dark:border-zinc-700 p-6">
        <!-- Task Details -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
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
                        class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full {{ $statusColors[$task->status] ?? 'text-zinc-800 dark:text-zinc-300' }}">
                        {{ ucfirst(str_replace('_', ' ', $task->status)) }}
                    </span>
                </p>
            </div>
            <div>
                <h2 class="text-sm font-medium text-zinc-500 dark:text-zinc-400">{{ __('Project') }}</h2>
                <p class="mt-1 text-foreground">
                    <a href="{{ route('projects.show', $task->project) }}" class="text-blue-600 hover:text-blue-800 dark:text-blue-400 dark:hover:text-blue-300">
                        {{ $task->project->name ?? 'No Project' }}
                    </a>
                </p>
            </div>
            <div>
                <h2 class="text-sm font-medium text-zinc-500 dark:text-zinc-400">{{ __('Phase') }}</h2>
                <p class="mt-1 text-foreground">
                    {{ $task->phase->name ?? 'No Phase' }}
                </p>
            </div>
            <div>
                <h2 class="text-sm font-medium text-zinc-500 dark:text-zinc-400">{{ __('Due Date') }}</h2>
                <p class="mt-1 text-foreground">
                    {{ $task->due_date ? $task->due_date->format('M d, Y') : 'No due date' }}
                </p>
            </div>
            <div>
                <h2 class="text-sm font-medium text-zinc-500 dark:text-zinc-400">{{ __('Assigned To') }}</h2>
                <p class="mt-1 text-foreground">
                    {{ $task->user->name ?? 'Unassigned' }}
                </p>
            </div>
            <div>
                <h2 class="text-sm font-medium text-zinc-500 dark:text-zinc-400">{{ __('Created') }}</h2>
                <p class="mt-1 text-foreground">
                    {{ $task->created_at->format('M d, Y') }}
                </p>
            </div>
            <div>
                <h2 class="text-sm font-medium text-zinc-500 dark:text-zinc-400">{{ __('Dependencies') }}</h2>
                <p class="mt-1 text-foreground">
                    @if($task->hasDependencies())
                        <span class="text-green-600 dark:text-green-400">{{ count($task->dependencies) }} dependencies</span>
                        @if($task->areDependenciesCompleted())
                            <span class="text-xs ml-2 px-2 py-1 rounded-full bg-green-100 text-green-800 dark:bg-green-900/30 dark:text-green-400">Ready to start</span>
                        @else
                            <span class="text-xs ml-2 px-2 py-1 rounded-full bg-red-100 text-red-800 dark:bg-red-900/30 dark:text-red-400">Blocked</span>
                        @endif
                    @else
                        <span class="text-zinc-500">No dependencies</span>
                    @endif
                </p>
            </div>
            <div>
                <h2 class="text-sm font-medium text-zinc-500 dark:text-zinc-400">{{ __('Order') }}</h2>
                <p class="mt-1 text-foreground">
                    {{ $task->order ?? 0 }}
                </p>
            </div>
        </div>

        @if ($task->description)
            <div class="mb-8">
                <h2 class="text-lg font-semibold text-foreground mb-3">{{ __('Description') }}</h2>
                <p class="text-foreground whitespace-pre-wrap border border-zinc-200 dark:border-zinc-700 rounded-lg p-4 bg-zinc-50 dark:bg-zinc-900/20">
                    {{ $task->description }}
                </p>
            </div>
        @endif>

        <!-- Dependencies Section -->
        @if($task->hasDependencies())
            <div class="mb-8">
                <h2 class="text-lg font-semibold text-foreground mb-3">{{ __('Dependencies') }}</h2>
                <div class="border border-zinc-200 dark:border-zinc-700 rounded-lg p-4 bg-zinc-50 dark:bg-zinc-900/20">
                    <ul class="space-y-2">
                        @foreach($task->getDependentTasks as $dependencyTask)
                            <li class="flex justify-between items-center p-2 bg-white dark:bg-zinc-800 rounded-md">
                                <div>
                                    <span class="font-medium">{{ $dependencyTask->title }}</span>
                                    <span class="ml-2 text-xs px-2 py-1 rounded-full
                                        @if($dependencyTask->status === 'completed') bg-green-100 text-green-800 dark:bg-green-900/30 dark:text-green-400
                                        @elseif($dependencyTask->status === 'in_progress') bg-blue-100 text-blue-800 dark:bg-blue-900/30 dark:text-blue-400
                                        @elseif($dependencyTask->status === 'todo') bg-zinc-100 text-zinc-800 dark:bg-zinc-700 dark:text-zinc-300
                                        @else bg-red-100 text-red-800 dark:bg-red-900/30 dark:text-red-400 @endif">
                                        {{ ucfirst(str_replace('_', ' ', $dependencyTask->status)) }}
                                    </span>
                                </div>
                                <a href="{{ route('tasks.show', $dependencyTask) }}" class="text-sm text-blue-600 hover:text-blue-800 dark:text-blue-400 dark:hover:text-blue-300">
                                    View
                                </a>
                            </li>
                        @endforeach
                    </ul>
                </div>
            </div>
        @endif>

        <!-- Tasks Dependent on This -->
        @php
            $dependents = $task->getTaskDependents;
        @endphp
        @if(count($dependents) > 0)
            <div class="mb-8">
                <h2 class="text-lg font-semibold text-foreground mb-3">{{ __('Tasks Dependent on This') }}</h2>
                <div class="border border-zinc-200 dark:border-zinc-700 rounded-lg p-4 bg-zinc-50 dark:bg-zinc-900/20">
                    <ul class="space-y-2">
                        @foreach($dependents as $dependentTask)
                            <li class="flex justify-between items-center p-2 bg-white dark:bg-zinc-800 rounded-md">
                                <div>
                                    <span class="font-medium">{{ $dependentTask->title }}</span>
                                    <span class="ml-2 text-xs px-2 py-1 rounded-full
                                        @if($dependentTask->status === 'completed') bg-green-100 text-green-800 dark:bg-green-900/30 dark:text-green-400
                                        @elseif($dependentTask->status === 'in_progress') bg-blue-100 text-blue-800 dark:bg-blue-900/30 dark:text-blue-400
                                        @elseif($dependentTask->status === 'todo') bg-zinc-100 text-zinc-800 dark:bg-zinc-700 dark:text-zinc-300
                                        @else bg-red-100 text-red-800 dark:bg-red-900/30 dark:text-red-400 @endif">
                                        {{ ucfirst(str_replace('_', ' ', $dependentTask->status)) }}
                                    </span>
                                </div>
                                <a href="{{ route('tasks.show', $dependentTask) }}" class="text-sm text-blue-600 hover:text-blue-800 dark:text-blue-400 dark:hover:text-blue-300">
                                    View
                                </a>
                            </li>
                        @endforeach
                    </ul>
                </div>
            </div>
        @endif>

        <div class="flex justify-end space-x-3">
            <a href="{{ route('tasks') }}"
                class="inline-flex items-center gap-2 px-4 py-2 border border-zinc-300 rounded-md text-zinc-700 hover:bg-zinc-50 dark:border-zinc-600 dark:text-zinc-300 dark:hover:bg-zinc-700">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="h-4 w-4">
                    <path d="M19 12H5"></path>
                    <path d="M12 19l-7-7 7-7"></path>
                </svg>
                {{ __('Back to Tasks') }}
            </a>
            <a href="{{ route('tasks.edit', $task) }}"
                class="inline-flex items-center gap-2 px-4 py-2 bg-blue-600 text-white rounded-md hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 dark:focus:ring-offset-zinc-900">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="h-4 w-4">
                    <path d="M17 3a2.85 2.83 0 1 1 4 4L7.5 20.5 2 22l1.5-5.5Z"></path>
                </svg>
                {{ __('Edit Task') }}
            </a>
        </div>
    </div>
</div>
