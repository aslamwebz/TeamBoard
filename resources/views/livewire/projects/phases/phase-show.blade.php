<div class="max-w-4xl mx-auto p-6">
    <div class="flex items-center justify-between mb-6">
        <div>
            <h1 class="text-3xl font-bold text-foreground">{{ $phase->name }}</h1>
            <p class="text-muted-foreground">{{ $phase->description }}</p>
        </div>
        <div class="flex gap-3">
            <flux:button :href="route('projects.show', $phase->project)" variant="outline">
                Back to Project
            </flux:button>
            <flux:button :href="route('phases.edit', ['project' => $phase->project->id, 'phase' => $phase])">
                Edit Phase
            </flux:button>
        </div>
    </div>

    <div class="bg-white dark:bg-zinc-800 rounded-lg border border-zinc-200 dark:border-zinc-700 p-6">
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
            <div>
                <h2 class="text-sm font-medium text-zinc-500 dark:text-zinc-400">Status</h2>
                @php
                    $statusColors = [
                        'not_started' => 'bg-zinc-100 text-zinc-800 dark:bg-zinc-700 dark:text-zinc-300',
                        'in_progress' => 'bg-blue-100 text-blue-800 dark:bg-blue-900/30 dark:text-blue-400',
                        'completed' => 'bg-green-100 text-green-800 dark:bg-green-900/30 dark:text-green-400',
                        'on_hold' => 'bg-red-100 text-red-800 dark:bg-red-900/30 dark:text-red-400',
                    ];
                @endphp
                <div class="mt-1">
                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium {{ $statusColors[$phase->status] ?? 'bg-zinc-100 text-zinc-800 dark:bg-zinc-700 dark:text-zinc-300' }}">
                        {{ ucfirst(str_replace('_', ' ', $phase->status)) }}
                    </span>
                </div>
            </div>
            <div>
                <h2 class="text-sm font-medium text-zinc-500 dark:text-zinc-400">Start Date</h2>
                <p class="mt-1 text-foreground">{{ $phase->start_date ? $phase->start_date->format('M d, Y') : 'N/A' }}</p>
            </div>
            <div>
                <h2 class="text-sm font-medium text-zinc-500 dark:text-zinc-400">End Date</h2>
                <p class="mt-1 text-foreground">{{ $phase->end_date ? $phase->end_date->format('M d, Y') : 'N/A' }}</p>
            </div>
            <div>
                <h2 class="text-sm font-medium text-zinc-500 dark:text-zinc-400">Progress</h2>
                <p class="mt-1 text-foreground">{{ $phase->getCompletionPercentage() }}%</p>
            </div>
        </div>

        @if ($phase->description)
            <div class="mb-8">
                <h2 class="text-lg font-semibold text-foreground mb-3">Description</h2>
                <p class="text-foreground whitespace-pre-wrap border border-zinc-200 dark:border-zinc-700 rounded-lg p-4 bg-zinc-50 dark:bg-zinc-900/20">
                    {{ $phase->description }}
                </p>
            </div>
        @endif>

        <!-- Tasks in this phase -->
        <div class="mb-8">
            <div class="flex justify-between items-center mb-4">
                <h2 class="text-lg font-semibold text-foreground">Tasks in this Phase</h2>
                <flux:button :href="route('tasks.create', ['project_id' => $phase->project->id, 'project_phase_id' => $phase->id])" size="sm">
                    Add Task
                </flux:button>
            </div>
            
            @if($phase->tasks->count() > 0)
                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-zinc-200 dark:divide-zinc-700">
                        <thead class="bg-zinc-50 dark:bg-zinc-700">
                            <tr>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-zinc-500 dark:text-zinc-300 uppercase tracking-wider">Title</th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-zinc-500 dark:text-zinc-300 uppercase tracking-wider">Status</th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-zinc-500 dark:text-zinc-300 uppercase tracking-wider">Due Date</th>
                                <th scope="col" class="px-6 py-3 text-right text-xs font-medium text-zinc-500 dark:text-zinc-300 uppercase tracking-wider">Actions</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-zinc-200 dark:divide-zinc-700 dark:bg-zinc-800">
                            @foreach($phase->tasks as $task)
                                <tr class="hover:bg-zinc-50 dark:hover:bg-zinc-700/50">
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="text-sm font-medium text-foreground">{{ $task->title }}</div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        @php
                                            $taskStatusColors = [
                                                'todo' => 'bg-zinc-100 text-zinc-800 dark:bg-zinc-700 dark:text-zinc-300',
                                                'in_progress' => 'bg-blue-100 text-blue-800 dark:bg-blue-900/30 dark:text-blue-400',
                                                'completed' => 'bg-green-100 text-green-800 dark:bg-green-900/30 dark:text-green-400',
                                                'on_hold' => 'bg-red-100 text-red-800 dark:bg-red-900/30 dark:text-red-400',
                                            ];
                                        @endphp
                                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium {{ $taskStatusColors[$task->status] ?? 'bg-zinc-100 text-zinc-800 dark:bg-zinc-700 dark:text-zinc-300' }}">
                                            {{ ucfirst(str_replace('_', ' ', $task->status)) }}
                                        </span>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-foreground">
                                        {{ $task->due_date ? $task->due_date->format('M d, Y') : 'N/A' }}
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                        <a href="{{ route('tasks.show', $task) }}"
                                            class="text-blue-600 hover:text-blue-900 dark:text-blue-400 dark:hover:text-blue-300">
                                            View
                                        </a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            @else
                <div class="text-center py-8 text-sm text-muted-foreground">
                    No tasks in this phase yet.
                </div>
            @endif
        </div>

        <div class="flex justify-end space-x-3">
            <flux:button :href="route('projects.show', $phase->project)" variant="outline">
                Back to Project
            </flux:button>
            <flux:button :href="route('phases.edit', ['project' => $phase->project->id, 'phase' => $phase])">
                Edit Phase
            </flux:button>
        </div>
    </div>
</div>