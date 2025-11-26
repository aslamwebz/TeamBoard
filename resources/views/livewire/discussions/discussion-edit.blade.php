<div class="max-w-3xl mx-auto p-6">
    <div class="bg-white dark:bg-zinc-800 rounded-lg border border-zinc-200 dark:border-zinc-700 p-6">
        <div class="mb-6">
            <a href="{{ route('discussions.show', $discussion) }}" class="inline-flex items-center text-sm text-zinc-600 hover:text-zinc-900 dark:text-zinc-400 dark:hover:text-zinc-200 mb-4">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                </svg>
                Back to Discussion
            </a>
            <h1 class="text-2xl font-bold text-foreground">Edit Discussion</h1>
        </div>

        @if(session()->has('message'))
            <div class="mb-4 p-4 bg-green-100 text-green-700 rounded-md dark:bg-green-900/30 dark:text-green-400">
                {{ session('message') }}
            </div>
        @endif

        <form wire:submit="updateDiscussion" class="space-y-6">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div class="space-y-4">
                    <div>
                        <flux:field label="Discussion Title" for="title" required>
                            <flux:input wire:model="title" id="title" placeholder="Enter discussion title" />
                        </flux:field>
                        @error('title')
                            <div class="mt-2 text-sm text-red-600 dark:text-red-400">{{ $message }}</div>
                        @enderror
                    </div>

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
                            <flux:select wire:model.live="typeId" id="typeId">
                                <option value="">Select {{ ucfirst($type) }}</option>
                                @if($type === 'project')
                                    @foreach($projects as $project)
                                        <option value="{{ $project->id }}">{{ $project->name }}</option>
                                    @endforeach
                                @elseif($type === 'task')
                                    @foreach(\App\Models\Task::all() as $task)
                                        <option value="{{ $task->id }}">{{ $task->title }}</option>
                                    @endforeach
                                @elseif($type === 'client')
                                    @foreach(\App\Models\Client::all() as $client)
                                        <option value="{{ $client->id }}">{{ $client->name }}</option>
                                    @endforeach
                                @endif
                            </flux:select>
                        </flux:field>
                        @error('typeId')
                            <div class="mt-2 text-sm text-red-600 dark:text-red-400">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="space-y-4">
                    <div>
                        <flux:field label="Project Phase" for="projectPhaseId">
                            <flux:select wire:model="projectPhaseId" id="projectPhaseId">
                                <option value="">No Phase</option>
                                @foreach($phases as $phase)
                                    <option value="{{ $phase->id }}">{{ $phase->name }}</option>
                                @endforeach
                            </flux:select>
                        </flux:field>
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
                        </flux:field>
                    </div>
                </div>
            </div>

            <div>
                <flux:field label="Content" for="content" required>
                    <flux:textarea 
                        wire:model="content" 
                        id="content" 
                        rows="8" 
                        placeholder="Enter discussion content (mention users with @username)" 
                    />
                </flux:field>
                @error('content')
                    <div class="mt-2 text-sm text-red-600 dark:text-red-400">{{ $message }}</div>
                @enderror
            </div>

            <div class="flex justify-end gap-3 pt-4">
                <a href="{{ route('discussions.show', $discussion) }}" class="inline-flex items-center gap-2 px-4 py-2 border border-zinc-300 rounded-md text-zinc-700 hover:bg-zinc-50 dark:border-zinc-600 dark:text-zinc-300 dark:hover:bg-zinc-700">
                    Cancel
                </a>
                <flux:button type="submit">
                    Update Discussion
                </flux:button>
            </div>
        </form>
    </div>
</div>