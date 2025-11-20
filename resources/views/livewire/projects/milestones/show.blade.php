<div class="max-w-4xl mx-auto p-6">
    <div class="flex items-center justify-between mb-6">
        <div>
            <h1 class="text-3xl font-bold text-foreground">{{ $milestone->name }}</h1>
            <p class="text-muted-foreground">{{ $milestone->description }}</p>
        </div>
        <div class="flex gap-3">
            <flux:button :href="route('projects.show', $milestone->project)" variant="outline">
                Back to Project
            </flux:button>
            <flux:button :href="route('milestones.edit', ['project' => $milestone->project->id, 'milestone' => $milestone])">
                Edit Milestone
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
                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium {{ $statusColors[$milestone->status] ?? 'bg-zinc-100 text-zinc-800 dark:bg-zinc-700 dark:text-zinc-300' }}">
                        {{ ucfirst(str_replace('_', ' ', $milestone->status)) }}
                    </span>
                </div>
            </div>
            <div>
                <h2 class="text-sm font-medium text-zinc-500 dark:text-zinc-400">Phase</h2>
                <p class="mt-1 text-foreground">{{ $milestone->phase?->name ?? 'No Phase' }}</p>
            </div>
            <div>
                <h2 class="text-sm font-medium text-zinc-500 dark:text-zinc-400">Due Date</h2>
                <p class="mt-1 text-foreground">{{ $milestone->due_date ? $milestone->due_date->format('M d, Y') : 'N/A' }}</p>
            </div>
            <div>
                <h2 class="text-sm font-medium text-zinc-500 dark:text-zinc-400">Project</h2>
                <p class="mt-1 text-foreground">{{ $milestone->project->name }}</p>
            </div>
        </div>

        @if ($milestone->description)
            <div class="mb-8">
                <h2 class="text-lg font-semibold text-foreground mb-3">Description</h2>
                <p class="text-foreground whitespace-pre-wrap border border-zinc-200 dark:border-zinc-700 rounded-lg p-4 bg-zinc-50 dark:bg-zinc-900/20">
                    {{ $milestone->description }}
                </p>
            </div>
        @endif>

        <!-- Milestone Details -->
        <div class="mb-8">
            <h2 class="text-lg font-semibold text-foreground mb-4">Milestone Details</h2>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div class="p-4 bg-zinc-50 dark:bg-zinc-900/20 rounded-lg">
                    <h3 class="font-medium text-foreground mb-2">Progress</h3>
                    <div class="w-full bg-zinc-200 dark:bg-zinc-700 rounded-full h-2.5">
                        <div class="bg-blue-600 h-2.5 rounded-full" style="width: {{ $milestone->status === 'completed' ? 100 : ($milestone->status === 'in_progress' ? 50 : 0) }}%"></div>
                    </div>
                    <div class="mt-1 text-sm text-muted-foreground">
                        {{ $milestone->status === 'completed' ? 'Completed' : ($milestone->status === 'in_progress' ? 'In Progress' : 'Not Started') }}
                    </div>
                </div>
                
                @if($milestone->due_date)
                    <div class="p-4 bg-zinc-50 dark:bg-zinc-900/20 rounded-lg">
                        <h3 class="font-medium text-foreground mb-2">Due Date Status</h3>
                        @if($milestone->isOverdue())
                            <div class="text-red-600 dark:text-red-400">Overdue by {{ $milestone->due_date->diffInDays(now()) }} days</div>
                        @elseif($milestone->isUpcoming())
                            <div class="text-blue-600 dark:text-blue-400">Due in {{ $milestone->due_date->diffInDays(now()) }} days</div>
                        @else
                            <div class="text-green-600 dark:text-green-400">Due date reached</div>
                        @endif
                    </div>
                @endif
            </div>
        </div>

        <div class="flex justify-end space-x-3">
            <flux:button :href="route('projects.show', $milestone->project)" variant="outline">
                Back to Project
            </flux:button>
            <flux:button :href="route('milestones.edit', ['project' => $milestone->project->id, 'milestone' => $milestone])">
                Edit Milestone
            </flux:button>
        </div>
    </div>
</div>