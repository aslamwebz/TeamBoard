<div class="max-w-2xl mx-auto p-6">
    <div class="bg-white dark:bg-zinc-800 rounded-lg shadow-md p-6">
        <h1 class="text-2xl font-bold text-foreground mb-6">{{ __('Edit Task') }}: {{ $task->title }}</h1>
        
        @if(session()->has('message'))
            <div class="mb-4 p-4 bg-green-100 text-green-700 rounded-md dark:bg-green-900/30 dark:text-green-400">
                {{ session('message') }}
            </div>
        @endif

        <form wire:submit="updateTask" class="space-y-4">
            <div>
                <label for="title" class="block text-sm font-medium text-foreground mb-1">{{ __('Task Title') }}</label>
                <input 
                    type="text" 
                    id="title" 
                    wire:model="title" 
                    class="w-full px-3 py-2 border border-zinc-200 rounded-md dark:border-zinc-700 dark:bg-zinc-800 dark:text-zinc-300 @error('title') border-red-500 @enderror"
                    placeholder="{{ __('Enter task title') }}"
                />
                @error('title')
                    <div class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</div>
                @enderror
            </div>

            <div>
                <label for="description" class="block text-sm font-medium text-foreground mb-1">{{ __('Description') }}</label>
                <textarea 
                    id="description" 
                    wire:model="description" 
                    rows="4"
                    class="w-full px-3 py-2 border border-zinc-200 rounded-md dark:border-zinc-700 dark:bg-zinc-800 dark:text-zinc-300 @error('description') border-red-500 @enderror"
                    placeholder="{{ __('Enter task description') }}"
                ></textarea>
                @error('description')
                    <div class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</div>
                @enderror
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div>
                    <label for="status" class="block text-sm font-medium text-foreground mb-1">{{ __('Status') }}</label>
                    <select 
                        id="status" 
                        wire:model="status" 
                        class="w-full px-3 py-2 border border-zinc-200 rounded-md dark:border-zinc-700 dark:bg-zinc-800 dark:text-zinc-300 @error('status') border-red-500 @enderror"
                    >
                        <option value="todo">{{ __('To Do') }}</option>
                        <option value="in_progress">{{ __('In Progress') }}</option>
                        <option value="completed">{{ __('Completed') }}</option>
                        <option value="on_hold">{{ __('On Hold') }}</option>
                    </select>
                    @error('status')
                        <div class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</div>
                    @enderror
                </div>

                <div>
                    <label for="due_date" class="block text-sm font-medium text-foreground mb-1">{{ __('Due Date') }}</label>
                    <input 
                        type="date" 
                        id="due_date" 
                        wire:model="due_date" 
                        class="w-full px-3 py-2 border border-zinc-200 rounded-md dark:border-zinc-700 dark:bg-zinc-800 dark:text-zinc-300 @error('due_date') border-red-500 @enderror"
                    />
                    @error('due_date')
                        <div class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</div>
                    @enderror
                </div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div>
                    <label for="project_id" class="block text-sm font-medium text-foreground mb-1">{{ __('Project') }}</label>
                    <select 
                        id="project_id" 
                        wire:model="project_id" 
                        class="w-full px-3 py-2 border border-zinc-200 rounded-md dark:border-zinc-700 dark:bg-zinc-800 dark:text-zinc-300"
                    >
                        <option value="">{{ __('Select Project') }}</option>
                        @foreach($projects as $project)
                            <option value="{{ $project->id }}">{{ $project->name }}</option>
                        @endforeach
                    </select>
                </div>

                <div>
                    <label for="user_id" class="block text-sm font-medium text-foreground mb-1">{{ __('Assign To') }}</label>
                    <select 
                        id="user_id" 
                        wire:model="user_id" 
                        class="w-full px-3 py-2 border border-zinc-200 rounded-md dark:border-zinc-700 dark:bg-zinc-800 dark:text-zinc-300"
                    >
                        <option value="">{{ __('Unassigned') }}</option>
                        @foreach($users as $user)
                            <option value="{{ $user->id }}">{{ $user->name }}</option>
                        @endforeach
                    </select>
                </div>
            </div>

            <div class="flex items-center justify-end gap-3 pt-4">
                <a href="{{ route('tasks') }}" class="px-4 py-2 border border-zinc-300 rounded-md text-zinc-700 hover:bg-zinc-50 dark:border-zinc-600 dark:text-zinc-300 dark:hover:bg-zinc-700">
                    {{ __('Cancel') }}
                </a>
                <button 
                    type="submit" 
                    class="px-4 py-2 bg-blue-600 text-white rounded-md hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 dark:focus:ring-offset-zinc-900"
                >
                    {{ __('Update Task') }}
                </button>
            </div>
        </form>
    </div>
</div>