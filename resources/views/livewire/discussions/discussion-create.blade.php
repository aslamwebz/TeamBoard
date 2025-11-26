<div class="max-w-3xl mx-auto p-6">
    <div class="bg-white dark:bg-zinc-800 rounded-lg border border-zinc-200 dark:border-zinc-700 p-6">
        <h1 class="text-2xl font-bold text-foreground mb-6">Create New Discussion</h1>

        @if(session()->has('message'))
            <div class="mb-4 p-4 bg-green-100 text-green-700 rounded-md dark:bg-green-900/30 dark:text-green-400">
                {{ session('message') }}
            </div>
        @endif

        <form wire:submit="createDiscussion" class="space-y-6">
            <div class="space-y-4">
                <div>
                    <flux:field label="Title" for="title" required>
                        <flux:input wire:model="title" id="title" placeholder="Discussion title" />
                    </flux:field>
                    @error('title')
                        <div class="mt-2 text-sm text-red-600 dark:text-red-400">{{ $message }}</div>
                    @enderror
                </div>

                <div>
                    <flux:field label="Content" for="content" required>
                        <flux:textarea wire:model="content" id="content" rows="6" placeholder="Start the discussion..." />
                    </flux:field>
                    @error('content')
                        <div class="mt-2 text-sm text-red-600 dark:text-red-400">{{ $message }}</div>
                    @enderror
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div>
                        <flux:field label="Type" for="type" required>
                            <flux:select wire:model.live="type" id="type">
                                <option value="">Select Type</option>
                                <option value="project">Project</option>
                                <option value="task">Task</option>
                                <option value="client">Client</option>
                            </flux:select>
                        </flux:field>
                        @error('type')
                            <div class="mt-2 text-sm text-red-600 dark:text-red-400">{{ $message }}</div>
                        @enderror
                    </div>

                    <div>
                        <flux:field label="Related Item" for="typeId" required>
                            <flux:select wire:model="typeId" id="typeId" :disabled="!$type">
                                <option value="">Select {{ ucfirst($type) }}</option>
                                @if($type === 'project')
                                    @foreach($projects as $project)
                                        <option value="{{ $project->id }}">{{ $project->name }}</option>
                                    @endforeach
                                @elseif($type === 'task')
                                    @foreach($tasks as $task)
                                        <option value="{{ $task->id }}">{{ $task->title }}</option>
                                    @endforeach
                                @endif
                            </flux:select>
                        </flux:field>
                        @error('typeId')
                            <div class="mt-2 text-sm text-red-600 dark:text-red-400">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div>
                    <flux:field label="Attachments" for="attachments">
                        <flux:input
                            type="file"
                            wire:model="attachments"
                            multiple
                            accept="image/*,application/pdf,.doc,.docx,.xls,.xlsx,.ppt,.pptx,.txt,.csv,.zip,.rar,.7z"
                            class="block w-full text-sm text-zinc-500
                                file:mr-4 file:py-2 file:px-4
                                file:rounded-md file:border-0
                                file:text-sm file:font-semibold
                                file:bg-blue-50 file:text-blue-700
                                hover:file:bg-blue-100
                                dark:file:bg-blue-900/30 dark:file:text-blue-400
                                dark:hover:file:bg-blue-800/30"
                        />
                        <p class="mt-1 text-sm text-muted-foreground">Accepts images, PDFs, documents and archives. Maximum size: 10MB each.</p>
                    </flux:field>
                    @error('attachments')
                        <div class="mt-2 text-sm text-red-600 dark:text-red-400">{{ $message }}</div>
                    @enderror
                </div>
            </div>

            <div class="flex justify-end gap-3 pt-4">
                <a href="{{ route('discussions.index') }}" class="inline-flex items-center gap-2 px-4 py-2 border border-zinc-300 rounded-md text-zinc-700 hover:bg-zinc-50 dark:border-zinc-600 dark:text-zinc-300 dark:hover:bg-zinc-700">
                    Cancel
                </a>
                <flux:button type="submit">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="h-4 w-4 mr-2">
                        <path d="M5 12h14"></path>
                        <path d="M12 5v14"></path>
                    </svg>
                    Create Discussion
                </flux:button>
            </div>
        </form>
    </div>
</div>