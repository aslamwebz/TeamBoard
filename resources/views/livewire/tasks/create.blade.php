<div class="max-w-3xl mx-auto p-6">
    <div class="bg-white dark:bg-zinc-800 rounded-lg border border-zinc-200 dark:border-zinc-700 p-6">
        <h1 class="text-2xl font-bold text-foreground mb-6">{{ __('Create New Task') }}</h1>

        @if(session()->has('message'))
            <div class="mb-4 p-4 bg-green-100 text-green-700 rounded-md dark:bg-green-900/30 dark:text-green-400">
                {{ session('message') }}
            </div>
        @endif

        <form wire:submit="createTask" class="space-y-6">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div class="space-y-4">
                    <div>
                        <flux:field label="Task Title" for="title" required>
                            <flux:input wire:model="title" id="title" placeholder="Enter task title" />
                        </flux:field>
                        @error('title')
                            <div class="mt-2 text-sm text-red-600 dark:text-red-400">{{ $message }}</div>
                        @enderror
                    </div>

                    <div>
                        <flux:field label="Project" for="project_id" required>
                            <flux:select wire:model.live="project_id" id="project_id">
                                <option value="">Select Project</option>
                                @foreach($projects as $project)
                                    <option value="{{ $project->id }}">{{ $project->name }}</option>
                                @endforeach
                            </flux:select>
                        </flux:field>
                    </div>

                    <div>
                        <flux:field label="Project Phase" for="project_phase_id">
                            <flux:select wire:model="project_phase_id" id="project_phase_id">
                                <option value="">No Phase</option>
                                @foreach($phases as $phase)
                                    <option value="{{ $phase->id }}">{{ $phase->name }}</option>
                                @endforeach
                            </flux:select>
                        </flux:field>
                    </div>

                    <div>
                        <flux:field label="Due Date" for="due_date">
                            <flux:input type="date" wire:model="due_date" id="due_date" />
                        </flux:field>
                        @error('due_date')
                            <div class="mt-2 text-sm text-red-600 dark:text-red-400">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="space-y-4">
                    <div>
                        <flux:field label="Status" for="status" required>
                            <flux:select wire:model="status" id="status">
                                <option value="todo">To Do</option>
                                <option value="in_progress">In Progress</option>
                                <option value="completed">Completed</option>
                                <option value="on_hold">On Hold</option>
                            </flux:select>
                        </flux:field>
                        @error('status')
                            <div class="mt-2 text-sm text-red-600 dark:text-red-400">{{ $message }}</div>
                        @enderror
                    </div>

                    <div>
                        <flux:field label="Assign To" for="user_id">
                            <flux:select wire:model="user_id" id="user_id">
                                <option value="">Unassigned</option>
                                @foreach($users as $user)
                                    <option value="{{ $user->id }}">{{ $user->name }}</option>
                                @endforeach
                            </flux:select>
                        </flux:field>
                    </div>
                </div>
            </div>

            <div>
                <flux:field label="Description" for="description">
                    <flux:textarea wire:model="description" id="description" rows="4" placeholder="Enter task description" />
                </flux:field>
                @error('description')
                    <div class="mt-2 text-sm text-red-600 dark:text-red-400">{{ $message }}</div>
                @enderror
            </div>

            <div class="flex items-center justify-end gap-3 pt-4">
                <a href="{{ route('tasks') }}" class="inline-flex items-center gap-2 px-4 py-2 border border-zinc-300 rounded-md text-zinc-700 hover:bg-zinc-50 dark:border-zinc-600 dark:text-zinc-300 dark:hover:bg-zinc-700">
                    {{ __('Cancel') }}
                </a>
                <button
                    type="submit"
                    class="inline-flex items-center gap-2 px-4 py-2 bg-blue-600 text-white rounded-md hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 dark:focus:ring-offset-zinc-900"
                >
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="h-4 w-4">
                        <path d="M12 20h9"></path>
                        <path d="M16.5 3.5a2.121 2.121 0 0 1 3 3L7 19l-4 1 1-4L16.5 3.5z"></path>
                    </svg>
                    {{ __('Create Task') }}
                </button>
            </div>
        </form>
    </div>
</div>