<div class="space-y-6">
    <div class="flex items-center justify-between">
        <div>
            <h1 class="text-3xl font-bold text-foreground">{{ __('Tasks') }}</h1>
            <p class="text-muted-foreground">{{ __('Manage your tasks across all projects') }}</p>
        </div>
        <div class="flex items-center gap-3">
            <!-- View Mode Toggle -->
            <div class="flex border border-zinc-200 dark:border-zinc-700 rounded-md p-1">
                <button wire:click="switchViewMode('table')"
                    class="flex-1 px-3 py-1.5 text-sm rounded-md {{ $viewMode === 'table' ? 'bg-sky-100 text-sky-700 dark:bg-sky-900/30 dark:text-sky-400' : 'text-zinc-700 hover:bg-zinc-50 dark:text-zinc-300 dark:hover:bg-zinc-700' }}">
                    {{ __('Table') }}
                </button>
                <button wire:click="switchViewMode('board')"
                    class="flex-1 px-3 py-1.5 text-sm rounded-md {{ $viewMode === 'board' ? 'bg-sky-100 text-sky-700 dark:bg-sky-900/30 dark:text-sky-400' : 'text-zinc-700 hover:bg-zinc-50 dark:text-zinc-300 dark:hover:bg-zinc-700' }}">
                    {{ __('Board') }}
                </button>
            </div>
            <flux:button :href="route('tasks.create')" class="flex items-center gap-2">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none"
                    stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                    class="h-4 w-4">
                    <path d="M5 12h14"></path>
                    <path d="M12 5v14"></path>
                </svg>
                {{ __('New Task') }}
            </flux:button>
        </div>
    </div>

    <!-- Search and Filters -->
    <div class="bg-white dark:bg-zinc-800 rounded-lg border border-zinc-200 dark:border-zinc-700 p-4">
        <div class="grid gap-4 md:grid-cols-3">
            <div class="relative">
                <input type="text" wire:model.live="search" placeholder="{{ __('Search tasks...') }}"
                    class="w-full pl-10 pr-4 py-2 border border-zinc-300 rounded-lg dark:border-zinc-600 dark:bg-zinc-700 dark:text-zinc-300 focus:ring-2 focus:ring-sky-500 focus:border-sky-500">
                <svg class="absolute left-3 top-2.5 h-5 w-5 text-muted-foreground" fill="none" stroke="currentColor"
                    viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                </svg>
            </div>

            <select wire:model.live="statusFilter"
                class="w-full px-3 py-2 border border-zinc-300 rounded-lg dark:border-zinc-600 dark:bg-zinc-700 dark:text-zinc-300 focus:ring-2 focus:ring-sky-500 focus:border-sky-500">
                <option value="">{{ __('All Status') }}</option>
                <option value="todo">{{ __('To Do') }}</option>
                <option value="in_progress">{{ __('In Progress') }}</option>
                <option value="completed">{{ __('Completed') }}</option>
                <option value="on_hold">{{ __('On Hold') }}</option>
            </select>

            <select wire:model.live="projectFilter"
                class="w-full px-3 py-2 border border-zinc-300 rounded-lg dark:border-zinc-600 dark:bg-zinc-700 dark:text-zinc-300 focus:ring-2 focus:ring-sky-500 focus:border-sky-500">
                <option value="">{{ __('All Projects') }}</option>
                @foreach ($projects as $project)
                    <option value="{{ $project->id }}">{{ $project->name }}</option>
                @endforeach
            </select>
        </div>
    </div>

    @if ($viewMode === 'table')
        <!-- Tasks Table -->
        <div class="bg-white dark:bg-zinc-800 rounded-lg border border-zinc-200 dark:border-zinc-700 overflow-hidden">
            <div class="overflow-x-auto">
                <table class="w-full">
                    <thead class="bg-zinc-50 dark:bg-zinc-700/50 border-b border-zinc-200 dark:border-zinc-600">
                        <tr>
                            <th
                                class="px-6 py-3 text-left text-xs font-medium text-zinc-500 dark:text-zinc-400 uppercase tracking-wider">
                                {{ __('Title') }}
                            </th>
                            <th
                                class="px-6 py-3 text-left text-xs font-medium text-zinc-500 dark:text-zinc-400 uppercase tracking-wider">
                                {{ __('Project') }}
                            </th>
                            <th
                                class="px-6 py-3 text-left text-xs font-medium text-zinc-500 dark:text-zinc-400 uppercase tracking-wider">
                                {{ __('Phase') }}
                            </th>
                            <th
                                class="px-6 py-3 text-left text-xs font-medium text-zinc-500 dark:text-zinc-400 uppercase tracking-wider">
                                {{ __('Status') }}
                            </th>
                            <th
                                class="px-6 py-3 text-left text-xs font-medium text-zinc-500 dark:text-zinc-400 uppercase tracking-wider">
                                {{ __('Due Date') }}
                            </th>
                            <th
                                class="px-6 py-3 text-left text-xs font-medium text-zinc-500 dark:text-zinc-400 uppercase tracking-wider">
                                {{ __('Assigned To') }}
                            </th>
                            <th
                                class="px-6 py-3 text-right text-xs font-medium text-zinc-500 dark:text-zinc-400 uppercase tracking-wider">
                                {{ __('Actions') }}
                            </th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-zinc-200 dark:divide-zinc-600">
                        @forelse($tasks as $task)
                            <tr class="hover:bg-zinc-50 dark:hover:bg-zinc-700/50 transition-colors">
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="text-sm font-medium text-foreground">{{ $task->title }}</div>
                                    @if ($task->description)
                                        <div class="text-sm text-zinc-500 dark:text-zinc-400 mt-1">
                                            {{ Str::limit($task->description, 50) }}</div>
                                    @endif
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="text-sm text-foreground">{{ $task->project->name ?? 'No Project' }}
                                    </div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="text-sm text-foreground">{{ $task->phase->name ?? 'No Phase' }}</div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <flux:badge class="{{ $this->getTaskStatusBadgeClass($task->status) }}">
                                        {{ ucfirst(str_replace('_', ' ', $task->status)) }}
                                    </flux:badge>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-foreground">
                                    {{ $task->due_date ? $task->due_date->format('M d, Y') : 'No due date' }}
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-foreground">
                                    {{ $task->user->name ?? 'Unassigned' }}
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                    <div class="flex items-center justify-end gap-2">
                                        <flux:button variant="outline" size="sm"
                                            :href="route('tasks.show', $task)">
                                            {{ __('View') }}
                                        </flux:button>
                                        <flux:button variant="outline" size="sm"
                                            :href="route('tasks.edit', $task)">
                                            {{ __('Edit') }}
                                        </flux:button>
                                        <flux:button variant="outline" size="sm" color="red" type="button"
                                            wire:click="deleteTask({{ $task->id }})">
                                            {{ __('Delete') }}
                                        </flux:button>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="7"
                                    class="px-6 py-4 text-center text-sm text-zinc-500 dark:text-zinc-400">
                                    {{ __('No tasks found') }}
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <!-- Pagination -->
            <div class="px-6 py-3 bg-zinc-50 dark:bg-zinc-700 border-t border-zinc-200 dark:border-zinc-700">
                {{ $tasks->links() }}
            </div>
        </div>
    @else
        <!-- Kanban Board View -->
        <div class="grid grid-cols-1 md:grid-cols-4 gap-4">

            @foreach ($statusColumns as $status => $column)
                <div class="{{ $column['color'] }} rounded-lg p-4 min-h-[500px]">
                    <h3 class="font-semibold text-foreground mb-4 flex justify-between items-center">
                        <span>{{ $column['title'] }}</span>
                        <span
                            class="bg-zinc-200 dark:bg-zinc-600 text-zinc-700 dark:text-zinc-300 text-xs font-medium px-2 py-1 rounded-full">
                            {{ count($tasksByStatus[$status] ?? []) }}
                        </span>
                    </h3>

                    <div class="space-y-3" id="column-{{ $status }}">
                        @forelse($tasksByStatus[$status] ?? [] as $task)
                            <div data-task-id="{{ $task->id }}"
                                class="bg-white rounded-md shadow-sm p-4 cursor-move border border-zinc-200 dark:border-zinc-600 task-item"
                                wire:dblclick="openTaskDetails({{ $task->id }})">
                                <div class="flex justify-between items-start">
                                    <h4 class="font-medium text-foreground">{{ $task->title }}</h4>
                                    <div class="relative">
                                        <button
                                            class="text-zinc-500 hover:text-zinc-700 dark:text-zinc-400 dark:hover:text-zinc-200">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none"
                                                viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M5 12h.01M12 12h.01M19 12h.01M6 12a1 1 0 11-2 0 1 1 0 012 0zm7 0a1 1 0 11-2 0 1 1 0 012 0zm7 0a1 1 0 11-2 0 1 1 0 012 0z" />
                                            </svg>
                                        </button>
                                        <div
                                            class="absolute right-0 z-10 mt-1 w-48 origin-top-right rounded-md bg-white py-1 shadow-lg ring-1 ring-black ring-opacity-5 hidden dark:bg-zinc-800 dark:ring-white/10">
                                            <a href="{{ route('tasks.show', $task) }}"
                                                class="block px-4 py-2 text-sm text-zinc-700 hover:bg-zinc-100 dark:text-zinc-200 dark:hover:bg-zinc-700">
                                                {{ __('View') }}
                                            </a>
                                            <a href="{{ route('tasks.edit', $task) }}"
                                                class="block px-4 py-2 text-sm text-zinc-700 hover:bg-zinc-100 dark:text-zinc-200 dark:hover:bg-zinc-700">
                                                {{ __('Edit') }}
                                            </a>
                                            <button wire:click="deleteTask({{ $task->id }})"
                                                class="block w-full text-left px-4 py-2 text-sm text-red-600 hover:bg-red-50 dark:text-red-400 dark:hover:bg-red-900/30">
                                                {{ __('Delete') }}
                                            </button>
                                        </div>
                                    </div>
                                </div>
                                @if ($task->description)
                                    <p class="text-sm text-zinc-500 dark:text-zinc-400 mt-2">
                                        {{ Str::limit($task->description, 80) }}</p>
                                @endif>
                                <div
                                    class="mt-3 flex flex-wrap items-center gap-2 text-xs text-zinc-500 dark:text-zinc-400">
                                    @if ($task->project)
                                        <span
                                            class="inline-flex items-center px-1.5 py-0.5 rounded-full text-xs font-medium bg-zinc-100 text-zinc-800 dark:bg-zinc-600 dark:text-zinc-300">
                                            {{ $task->project->name }}
                                        </span>
                                    @endif>
                                    @if ($task->phase)
                                        <span
                                            class="inline-flex items-center px-1.5 py-0.5 rounded-full text-xs font-medium bg-sky-100 text-sky-800 dark:bg-sky-900/30 dark:text-sky-400">
                                            {{ $task->phase->name }}
                                        </span>
                                    @endif>
                                    @if ($task->due_date)
                                        <span class="flex items-center">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-3 w-3 mr-1"
                                                fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                            </svg>
                                            {{ $task->due_date->format('M d') }}
                                        </span>
                                    @endif>
                                </div>
                            </div>
                        @empty
                            <div class="min-h-[50px]"></div>
                        @endforelse
                    </div>
                </div>
            @endforeach
        </div>

        <!-- SortableJS for drag and drop -->
        <script src="https://cdn.jsdelivr.net/npm/sortablejs@1.15.0/Sortable.min.js"></script>
        <script>
            document.addEventListener('livewire:initialized', () => {
                // Initialize drag and drop between columns
                const columns = document.querySelectorAll('.space-y-3');

                columns.forEach(column => {
                    new Sortable(column, {
                        group: 'tasks-shared',
                        animation: 150,
                        ghostClass: 'opacity-40',
                        dragClass: 'shadow-lg',
                        onEnd: function(evt) {
                            // Get the task ID and the new column ID
                            const taskId = evt.item.getAttribute('data-task-id');

                            // Determine the new status based on the target column
                            const targetColumnId = evt.to.id;
                            let newStatus = '';

                            switch (targetColumnId) {
                                case 'column-todo':
                                    newStatus = 'todo';
                                    break;
                                case 'column-in_progress':
                                    newStatus = 'in_progress';
                                    break;
                                case 'column-completed':
                                    newStatus = 'completed';
                                    break;
                                case 'column-on_hold':
                                    newStatus = 'on_hold';
                                    break;
                            }

                            // Update the task status via Livewire
                            if (taskId && newStatus) {
                                // Use Livewire's $wire to call the method
                                Livewire.find(@this.id).call('updateTaskStatus', taskId, newStatus);
                            }
                        }
                    });
                });
            });
        </script>
    @endif

    <!-- Delete Confirmation Modal -->
    <flux:modal name="delete-task" wire:model="showDeleteModal">
        <div class="space-y-6">
            <div>
                <flux:heading size="lg">{{ __('Delete Task') }}</flux:heading>
                <flux:text class="mt-2">
                    {{ __('Are you sure you want to delete this task? This action cannot be undone.') }}</flux:text>
            </div>

            <div class="flex gap-2">
                <flux:spacer />
                <flux:button wire:click="cancelDelete" variant="ghost">{{ __('Cancel') }}</flux:button>
                <flux:button wire:click="confirmDelete" variant="danger">{{ __('Delete') }}</flux:button>
            </div>
        </div>
    </flux:modal>

    <!-- Task Details Modal -->
    <flux:modal name="task-details" wire:model="showTaskModal">
        <div class="space-y-6">
            <div>
                <flux:heading size="lg">{{ $selectedTask?->title ?? 'Task Details' }}</flux:heading>
            </div>

            <div class="space-y-4">
                <div>
                    <flux:subheading>{{ __('Description') }}</flux:subheading>
                    <flux:text class="mt-1 whitespace-pre-wrap">
                        {{ $selectedTask?->description ?: __('No description provided') }}
                    </flux:text>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div>
                        <flux:subheading>{{ __('Status') }}</flux:subheading>
                        <flux:badge class="{{ $this->getTaskStatusBadgeClass($selectedTask?->status ?? '') }}">
                            {{ $selectedTask?->status ? ucfirst(str_replace('_', ' ', $selectedTask?->status)) : 'N/A' }}
                        </flux:badge>
                    </div>

                    <div>
                        <flux:subheading>{{ __('Due Date') }}</flux:subheading>
                        <flux:text>
                            {{ $selectedTask?->due_date ? $selectedTask->due_date->format('M d, Y') : __('No due date') }}
                        </flux:text>
                    </div>

                    <div>
                        <flux:subheading>{{ __('Project') }}</flux:subheading>
                        <flux:text>
                            {{ $selectedTask?->project->name ?? __('No Project') }}
                        </flux:text>
                    </div>

                    <div>
                        <flux:subheading>{{ __('Assigned To') }}</flux:subheading>
                        <flux:text>
                            {{ $selectedTask?->user->name ?? __('Unassigned') }}
                        </flux:text>
                    </div>
                </div>
            </div>

            <div class="flex gap-2">
                <flux:spacer />
                <flux:modal.close>
                    <flux:button variant="ghost">{{ __('Close') }}</flux:button>
                </flux:modal.close>
                <a href="{{ $selectedTask ? route('tasks.edit', $selectedTask) : '#' }}"
                    class="inline-flex items-center px-4 py-2 bg-sky-600 text-white rounded-lg hover:bg-sky-700">
                    {{ __('Edit Task') }}
                </a>
            </div>
        </div>
    </flux:modal>
</div>
