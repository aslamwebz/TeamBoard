<div class="max-w-7xl mx-auto p-6">
    <div class="mb-6">
        <a href="{{ route('projects') }}" class="inline-flex items-center text-sm text-zinc-600 hover:text-zinc-900 dark:text-zinc-400 dark:hover:text-zinc-200">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
            </svg>
            {{ __('Back to Projects') }}
        </a>
        <h1 class="text-3xl font-bold text-foreground mt-2">{{ $project->name }}</h1>
        <p class="text-muted-foreground">{{ $project->description }}</p>
    </div>

    <!-- Add Task Form -->
    <div class="mb-8 p-4 bg-white dark:bg-zinc-800 rounded-lg shadow">
        <h2 class="text-lg font-semibold text-foreground mb-3">{{ __('Add New Task') }}</h2>
        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
            <div>
                <input 
                    type="text" 
                    wire:model="newTaskTitle" 
                    placeholder="{{ __('Task title') }}" 
                    class="w-full px-3 py-2 border border-zinc-200 rounded-md dark:border-zinc-700 dark:bg-zinc-800 dark:text-zinc-300"
                />
                @error('newTaskTitle')
                    <div class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</div>
                @enderror
            </div>
            <div class="flex items-end">
                <button 
                    wire:click="addTask" 
                    class="w-full px-4 py-2 bg-blue-600 text-white rounded-md hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 dark:focus:ring-offset-zinc-900"
                >
                    {{ __('Add Task') }}
                </button>
            </div>
        </div>
        <div class="mt-2">
            <textarea 
                wire:model="newTaskDescription" 
                placeholder="{{ __('Task description (optional)') }}" 
                rows="2"
                class="w-full px-3 py-2 border border-zinc-200 rounded-md dark:border-zinc-700 dark:bg-zinc-800 dark:text-zinc-300 mt-2"
            ></textarea>
        </div>
    </div>

    <!-- Kanban Board -->
    <div class="grid grid-cols-1 md:grid-cols-4 gap-4">
        @php
            $statusColumns = [
                'todo' => ['title' => __('To Do'), 'color' => 'bg-zinc-100 dark:bg-zinc-700'],
                'in_progress' => ['title' => __('In Progress'), 'color' => 'bg-blue-100 dark:bg-blue-900/30'],
                'completed' => ['title' => __('Completed'), 'color' => 'bg-green-100 dark:bg-green-900/30'],
                'on_hold' => ['title' => __('On Hold'), 'color' => 'bg-red-100 dark:bg-red-900/30'],
            ];
        @endphp

        @foreach($statusColumns as $status => $column)
            <div class="{{ $column['color'] }} rounded-lg p-4 min-h-[500px]">
                <h3 class="font-semibold text-foreground mb-4 flex justify-between items-center">
                    <span>{{ $column['title'] }}</span>
                    <span class="bg-zinc-200 dark:bg-zinc-600 text-zinc-700 dark:text-zinc-300 text-xs font-medium px-2 py-1 rounded-full">
                        {{ $tasksByStatus->get($status, collect())->count() }}
                    </span>
                </h3>
                
                <div
                    class="space-y-3"
                    id="column-{{ $status }}"
                >
                    @forelse($tasksByStatus->get($status, collect()) as $task)
                        <div
                            data-task-id="{{ $task->id }}"
                            class="bg-white dark:bg-zinc-700 rounded-md shadow-sm p-4 cursor-move border border-zinc-200 dark:border-zinc-600 task-item"
                        >
                            <div class="flex justify-between items-start">
                                <h4 class="font-medium text-foreground">{{ $task->title }}</h4>
                                <button 
                                    wire:click="deleteTask({{ $task->id }})"
                                    class="text-red-500 hover:text-red-700"
                                >
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                                    </svg>
                                </button>
                            </div>
                            @if($task->description)
                                <p class="text-sm text-zinc-500 dark:text-zinc-400 mt-2">{{ Str::limit($task->description, 80) }}</p>
                            @endif
                            <div class="mt-3 flex justify-between items-center text-xs text-zinc-500 dark:text-zinc-400">
                                @if($task->due_date)
                                    <span>{{ $task->due_date->format('M d') }}</span>
                                @endif
                                <span class="ml-auto">{{ $task->user ? $task->user->name : 'Unassigned' }}</span>
                            </div>
                        </div>
                    @empty
                        <div class="text-center text-zinc-500 dark:text-zinc-400 py-8 text-sm">
                            {{ __('No tasks') }}
                        </div>
                    @endforelse
                </div>
            </div>
        @endforeach
    </div>

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
                onEnd: function (evt) {
                    // Get the task ID and the new column ID
                    const taskId = evt.item.getAttribute('data-task-id');

                    // Determine the new status based on the target column
                    const targetColumnId = evt.to.id;
                    let newStatus = '';

                    switch(targetColumnId) {
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
                    if(taskId && newStatus) {
                        // Use Livewire's $wire to call the method
                        Livewire.find(@this.id).call('updateTaskStatus', taskId, newStatus);
                    }
                }
            });
        });
    });
    </script>
</div>