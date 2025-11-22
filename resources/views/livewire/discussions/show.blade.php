<div class="max-w-7xl mx-auto p-6">
    <div class="flex items-center gap-4 mb-6">
        <a href="{{ route('discussions.index') }}" class="inline-flex items-center text-sm text-zinc-600 hover:text-zinc-900 dark:text-zinc-400 dark:hover:text-zinc-200">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
            </svg>
            Back to Discussions
        </a>
    </div>
    
    <div class="flex flex-col lg:flex-row gap-6">
        <!-- Main Content -->
        <div class="flex-1">
            <div class="bg-white dark:bg-zinc-800 rounded-lg border border-zinc-200 dark:border-zinc-700 p-6 mb-6">
                <div class="flex items-start justify-between">
                    <div>
                        <h1 class="text-3xl font-bold text-foreground">{{ $discussion->title }}</h1>
                        <div class="flex items-center gap-4 mt-3 text-sm text-muted-foreground">
                            <div class="flex items-center gap-2">
                                <img src="{{ $discussion->user->profile_photo_url ?? 'https://ui-avatars.com/api/?name=' . urlencode($discussion->user->name) }}" 
                                     alt="{{ $discussion->user->name }}" 
                                     class="w-6 h-6 rounded-full">
                                <span>{{ $discussion->user->name }}</span>
                            </div>
                            <span>{{ $discussion->created_at->format('M d, Y \a\t g:i A') }}</span>
                            <span>•</span>
                            @php
                                $typeLabels = [
                                    'project' => 'Project',
                                    'task' => 'Task', 
                                    'client' => 'Client'
                                ];
                            @endphp
                            <span>
                                Related to {{ $typeLabels[$discussion->type] ?? ucfirst($discussion->type) }}: 
                                @if($discussion->type === 'project')
                                    <a href="{{ route('projects.show', $discussion->project) }}" class="text-blue-600 hover:text-blue-800 dark:text-blue-400 dark:hover:text-blue-300">
                                        {{ $discussion->project->name ?? 'Unknown Project' }}
                                    </a>
                                @elseif($discussion->type === 'task')
                                    <a href="{{ route('tasks.show', $discussion->type_id) }}" class="text-blue-600 hover:text-blue-800 dark:text-blue-400 dark:hover:text-blue-300">
                                        {{ \App\Models\Task::find($discussion->type_id)?->title ?? 'Unknown Task' }}
                                    </a>
                                @elseif($discussion->type === 'client')
                                    <a href="{{ route('clients.show', $discussion->type_id) }}" class="text-blue-600 hover:text-blue-800 dark:text-blue-400 dark:hover:text-blue-300">
                                        {{ \App\Models\Client::find($discussion->type_id)?->name ?? 'Unknown Client' }}
                                    </a>
                                @endif
                            </span>
                        </div>
                        @if($discussion->phase)
                            <div class="mt-2 inline-flex items-center gap-2 px-2.5 py-0.5 rounded-full text-xs font-medium bg-blue-100 text-blue-800 dark:bg-blue-900/30 dark:text-blue-400">
                                Phase: {{ $discussion->phase->name }}
                            </div>
                        @endif
                    </div>
                    {{-- Simple edit/delete buttons instead of dropdown --}}
                    <div class="flex gap-2">
                        <a href="{{ route('discussions.edit', $discussion) }}"
                           class="inline-flex items-center gap-2 px-3 py-1.5 text-sm border border-zinc-300 rounded-md hover:bg-zinc-50 dark:border-zinc-600 dark:text-zinc-300 dark:hover:bg-zinc-700">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="h-3 w-3">
                                <path d="M17 3a2.85 2.83 0 1 1 4 4L7.5 20.5 2 22l1.5-5.5L17 3z"></path>
                            </svg>
                            Edit
                        </a>
                        <button type="button"
                                wire:click="deleteDiscussion"
                                onclick="confirm('Are you sure you want to delete this discussion?') || event.stopImmediatePropagation()"
                                class="inline-flex items-center gap-2 px-3 py-1.5 text-sm bg-red-600 text-white rounded-md hover:bg-red-700">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="h-3 w-3">
                                <path d="M3 6h18"></path>
                                <path d="M19 6v14c0 1-1 2-2 2H7c-1 0-2-1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"></path>
                                <line x1="10" y1="11" x2="10" y2="17"></line>
                                <line x1="14" y1="11" x2="14" y2="17"></line>
                            </svg>
                            Delete
                        </button>
                    </div>
                </div>
            </div>

            <!-- Discussion Content -->
            <div class="bg-white dark:bg-zinc-800 rounded-lg border border-zinc-200 dark:border-zinc-700 p-6 mb-6">
                <div class="prose dark:prose-invert max-w-none">
                    {!! $discussion->formatContentWithMentions(nl2br(e($discussion->content))) !!}
                </div>
            </div>

            <!-- Discussion Attachments -->
            @if($discussion->attachments->count() > 0)
                <div class="bg-white dark:bg-zinc-800 rounded-lg border border-zinc-200 dark:border-zinc-700 p-6 mb-6">
                    <h2 class="text-xl font-semibold text-foreground mb-4">Discussion Attachments</h2>
                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
                        @foreach($discussion->attachments as $attachment)
                            <div class="flex items-center p-3 bg-zinc-50 dark:bg-zinc-700/50 rounded-lg">
                                <div class="mr-3">
                                    @if($attachment->isImage())
                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="h-6 w-6 text-blue-500">
                                            <rect x="3" y="3" width="18" height="18" rx="2" ry="2"></rect>
                                            <circle cx="8.5" cy="8.5" r="1.5"></circle>
                                            <path d="M21 15l-5-5L5 21"></path>
                                        </svg>
                                    @else
                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="h-6 w-6 text-gray-500">
                                            <path d="M14.5 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V7.5L14.5 2z"></path>
                                            <polyline points="14 2 14 8 20 8"></polyline>
                                        </svg>
                                    @endif
                                </div>
                                <div class="flex-1 min-w-0">
                                    <p class="text-sm font-medium text-foreground truncate">{{ $attachment->original_name }}</p>
                                    <p class="text-xs text-muted-foreground">{{ $attachment->getFormattedSize() }}</p>
                                </div>
                                <a href="{{ $attachment->getUrl() }}" class="ml-2 text-blue-600 hover:text-blue-800 dark:text-blue-400 dark:hover:text-blue-300">
                                    Download
                                </a>
                            </div>
                        @endforeach
                    </div>
                </div>
            @endif>

            <!-- Comments Section -->
            <div class="bg-white dark:bg-zinc-800 rounded-lg border border-zinc-200 dark:border-zinc-700 p-6">
                <h2 class="text-xl font-semibold text-foreground mb-6">Comments ({{ $discussion->getCommentCount() }})</h2>
                
                <!-- Add Comment Form -->
                <form wire:submit="addComment" class="mb-8">
                    <div class="flex gap-4">
                        <img src="{{ Auth::user()->profile_photo_url ?? 'https://ui-avatars.com/api/?name=' . urlencode(Auth::user()->name) }}" 
                             alt="{{ Auth::user()->name }}" 
                             class="w-10 h-10 rounded-full flex-shrink-0">
                             
                        <div class="flex-1">
                            <div class="bg-zinc-50 dark:bg-zinc-700/30 rounded-lg p-4">
                                <flux:textarea 
                                    wire:model="newComment" 
                                    placeholder="Add a comment... (mention users with @username)" 
                                    rows="3" 
                                    class="w-full bg-transparent border-0 focus:ring-0 p-0 resize-none"
                                />
                                @error('newComment')
                                    <div class="mt-2 text-sm text-red-600 dark:text-red-400">{{ $message }}</div>
                                @enderror
                            </div>
                            
                            <div class="flex justify-between items-center mt-3">
                                <div class="flex items-center gap-2">
                                    <input
                                        type="file"
                                        wire:model="attachments"
                                        multiple
                                        accept="image/*,application/pdf,.doc,.docx,.xls,.xlsx,.ppt,.pptx,.txt,.csv,.zip,.rar,.7z"
                                        class="block w-full text-sm text-zinc-500
                                            file:mr-4 file:py-1 file:px-2
                                            file:rounded-md file:border-0
                                            file:text-sm file:font-semibold
                                            file:bg-blue-50 file:text-blue-700
                                            hover:file:bg-blue-100
                                            dark:file:bg-blue-900/30 dark:file:text-blue-400
                                            dark:hover:file:bg-blue-800/30"
                                    />
                                    <span class="text-xs text-muted-foreground">Max file size: 10MB each</span>
                                </div>
                                
                                <flux:button type="submit" size="sm">
                                    Post Comment
                                </flux:button>
                            </div>
                        </div>
                    </div>
                </form>
                
                <!-- Comments List -->
                <div class="space-y-6">
                    @forelse($discussion->comments as $comment)
                        <div class="flex gap-3">
                            <img src="{{ $comment->user?->profile_photo_url ?? 'https://ui-avatars.com/api/?name=' . urlencode($comment->user?->name ?? 'User') }}"
                                 alt="{{ $comment->user?->name ?? 'User' }}"
                                 class="w-10 h-10 rounded-full flex-shrink-0">
                                 
                            <div class="flex-1">
                                <div class="bg-zinc-50 dark:bg-zinc-700/30 rounded-lg p-4">
                                    <div class="flex items-center justify-between mb-1">
                                        <div class="flex items-center gap-2">
                                            <span class="font-medium text-foreground">{{ $comment->user?->name ?? 'User' }}</span>
                                            <span class="text-xs text-muted-foreground">{{ $comment->created_at->format('M d, Y g:i A') }}</span>
                                        </div>
                                    </div>
                                    
                                    <div class="text-foreground">
                                        {!! $discussion->formatContentWithMentions(nl2br(e($comment->content))) !!}
                                    </div>
                                </div>
                                
                                <!-- Comment Attachments -->
                                @if($comment->attachments->count() > 0)
                                    <div class="mt-3 ml-4 pl-4 border-l-2 border-zinc-200 dark:border-zinc-600">
                                        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-2">
                                            @foreach($comment->attachments as $attachment)
                                                <div class="flex items-center p-2 bg-white dark:bg-zinc-800 rounded text-xs shadow-sm">
                                                    @if($attachment->isImage())
                                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="h-4 w-4 text-blue-500 mr-2">
                                                            <rect x="3" y="3" width="18" height="18" rx="2" ry="2"></rect>
                                                            <circle cx="8.5" cy="8.5" r="1.5"></circle>
                                                            <path d="M21 15l-5-5L5 21"></path>
                                                        </svg>
                                                    @else
                                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="h-4 w-4 text-gray-500 mr-2">
                                                            <path d="M14.5 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V7.5L14.5 2z"></path>
                                                            <polyline points="14 2 14 8 20 8"></polyline>
                                                        </svg>
                                                    @endif
                                                    <span class="truncate">{{ $attachment->original_name }}</span>
                                                    <a href="{{ $attachment->getUrl() }}" class="ml-1 text-blue-600 hover:text-blue-800 dark:text-blue-400 dark:hover:text-blue-300">
                                                        Download
                                                    </a>
                                                </div>
                                            @endforeach
                                        </div>
                                    </div>
                                @endif
                                
                                <!-- Reply Button -->
                                <div class="mt-3">
                                    <button 
                                        wire:click="startReply({{ $comment->id }})"
                                        class="text-xs text-blue-600 hover:text-blue-800 dark:text-blue-400 dark:hover:text-blue-300">
                                        Reply
                                    </button>
                                </div>
                                
                                <!-- Reply Form -->
                                @if($replyingTo === $comment->id)
                                    <form wire:submit="replyToComment" class="mt-3 ml-6 pl-4 border-l-2 border-zinc-200 dark:border-zinc-600">
                                        <div class="flex flex-col gap-2">
                                            <flux:textarea
                                                wire:model="replyContent"
                                                placeholder="Write your reply..."
                                                rows="2"
                                                class="flex-1"
                                            />
                                            <div class="flex items-center gap-2">
                                                <input
                                                    type="file"
                                                    wire:model="attachments"
                                                    multiple
                                                    accept="image/*,application/pdf,.doc,.docx,.xls,.xlsx,.ppt,.pptx,.txt,.csv,.zip,.rar,.7z"
                                                    class="block w-full text-sm text-zinc-500
                                                        file:mr-4 file:py-1 file:px-2
                                                        file:rounded-md file:border-0
                                                        file:text-sm file:font-semibold
                                                        file:bg-blue-50 file:text-blue-700
                                                        hover:file:bg-blue-100
                                                        dark:file:bg-blue-900/30 dark:file:text-blue-400
                                                        dark:hover:file:bg-blue-800/30"
                                                />
                                                <span class="text-xs text-muted-foreground">Max 10MB each</span>
                                            </div>
                                            <div class="flex gap-2">
                                                <flux:button type="submit" size="sm">Reply</flux:button>
                                                <flux:button type="button" variant="outline" size="sm" wire:click="cancelReply">Cancel</flux:button>
                                            </div>
                                        </div>
                                        @error('replyContent')
                                            <div class="mt-2 text-sm text-red-600 dark:text-red-400">{{ $message }}</div>
                                        @enderror
                                    </form>
                                @endif
                                
                                <!-- Replies -->
                                @if($comment->replies->count() > 0)
                                    <div class="mt-3 ml-6 pl-4 border-l-2 border-zinc-200 dark:border-zinc-600 space-y-4">
                                        @foreach($comment->replies as $reply)
                                            <div class="flex gap-3">
                                                <img src="{{ $reply->user?->profile_photo_url ?? 'https://ui-avatars.com/api/?name=' . urlencode($reply->user?->name ?? 'User') }}"
                                                     alt="{{ $reply->user?->name ?? 'User' }}"
                                                     class="w-8 h-8 rounded-full flex-shrink-0">
                                                     
                                                <div class="flex-1">
                                                    <div class="bg-zinc-100 dark:bg-zinc-700/50 rounded-lg p-3">
                                                        <div class="flex items-center justify-between mb-1">
                                                            <div class="flex items-center gap-2">
                                                                <span class="font-medium text-foreground text-sm">{{ $reply->user?->name ?? 'User' }}</span>
                                                                <span class="text-xs text-muted-foreground">{{ $reply->created_at->format('M d, Y g:i A') }}</span>
                                                            </div>
                                                        </div>
                                                        
                                                        <div class="text-sm text-foreground">
                                                            {!! $discussion->formatContentWithMentions(nl2br(e($reply->content))) !!}
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>
                                @endif
                            </div>
                        </div>
                    @empty
                        <div class="text-center py-8 text-sm text-muted-foreground">
                            <svg xmlns="http://www.w3.org/2000/svg" class="mx-auto h-12 w-12 text-zinc-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 10h.01M12 10h.01M16 10h.01M9 16H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-5l-5 5v-5z" />
                            </svg>
                            <h3 class="mt-2 font-medium">No comments yet</h3>
                            <p class="mt-1">Be the first to add a comment.</p>
                        </div>
                    @endforelse
                </div>
            </div>
        </div>

        <!-- Sidebar -->
        <div class="lg:w-80 space-y-6">
            <!-- Discussion Info -->
            <div class="bg-white dark:bg-zinc-800 rounded-lg border border-zinc-200 dark:border-zinc-700 p-6">
                <h3 class="text-lg font-semibold text-foreground mb-4">Discussion Details</h3>
                <div class="space-y-3">
                    <div>
                        <h4 class="text-sm font-medium text-zinc-500 dark:text-zinc-400">Type</h4>
                        <p class="mt-1">
                            <flux:badge class="{{ $typeColors[$discussion->type] ?? 'bg-zinc-100 text-zinc-800 dark:bg-zinc-700 dark:text-zinc-300' }}">
                                {{ ucfirst($discussion->type) }}
                            </flux:badge>
                        </p>
                    </div>
                    
                    @if($discussion->phase)
                    <div>
                        <h4 class="text-sm font-medium text-zinc-500 dark:text-zinc-400">Phase</h4>
                        <p class="mt-1 text-foreground">{{ $discussion->phase->name }}</p>
                    </div>
                    @endif
                    
                    <div>
                        <h4 class="text-sm font-medium text-zinc-500 dark:text-zinc-400">Created</h4>
                        <p class="mt-1 text-foreground">{{ $discussion->created_at->format('M d, Y g:i A') }}</p>
                    </div>
                    
                    <div>
                        <h4 class="text-sm font-medium text-zinc-500 dark:text-zinc-400">Updated</h4>
                        <p class="mt-1 text-foreground">{{ $discussion->updated_at->format('M d, Y g:i A') }}</p>
                    </div>
                    
                    @if($discussion->project)
                    <div>
                        <h4 class="text-sm font-medium text-zinc-500 dark:text-zinc-400">Project</h4>
                        <p class="mt-1">
                            <a href="{{ route('projects.show', $discussion->project) }}" class="text-blue-600 hover:text-blue-800 dark:text-blue-400 dark:hover:text-blue-300">
                                {{ $discussion->project->name }}
                            </a>
                        </p>
                    </div>
                    @endif
                </div>
            </div>

            <!-- All Attachments -->
            <div class="bg-white dark:bg-zinc-800 rounded-lg border border-zinc-200 dark:border-zinc-700 p-6">
                <h3 class="text-lg font-semibold text-foreground mb-4">All Files</h3>
                @if($allAttachments->count() > 0)
                    <div class="space-y-3 max-h-96 overflow-y-auto">
                        @foreach($allAttachments as $attachment)
                            <div class="flex items-center p-2 bg-zinc-50 dark:bg-zinc-700/30 rounded">
                                <div class="mr-2 flex-shrink-0">
                                    @if($attachment->isImage())
                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="h-4 w-4 text-blue-500">
                                            <rect x="3" y="3" width="18" height="18" rx="2" ry="2"></rect>
                                            <circle cx="8.5" cy="8.5" r="1.5"></circle>
                                            <path d="M21 15l-5-5L5 21"></path>
                                        </svg>
                                    @else
                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="h-4 w-4 text-gray-500">
                                            <path d="M14.5 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V7.5L14.5 2z"></path>
                                            <polyline points="14 2 14 8 20 8"></polyline>
                                        </svg>
                                    @endif
                                </div>
                                <div class="flex-1 min-w-0">
                                    <p class="text-sm font-medium text-foreground truncate">{{ $attachment->original_name }}</p>
                                    <p class="text-xs text-muted-foreground">{{ $attachment->getFormattedSize() }}</p>
                                </div>
                                <a href="{{ $attachment->getUrl() }}" class="ml-1 text-blue-600 hover:text-blue-800 dark:text-blue-400 dark:hover:text-blue-300">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="h-3 w-3">
                                        <path d="M21 15v4a2 2 0 01-2 2H5a2 2 0 01-2-2v-4"></path>
                                        <polyline points="7 10 12 15 17 10"></polyline>
                                        <line x1="12" y1="15" x2="12" y2="3"></line>
                                    </svg>
                                </a>
                            </div>
                        @endforeach
                    </div>
                @else
                    <p class="text-sm text-muted-foreground">No files attached to this discussion or its comments.</p>
                @endif
            </div>
            
            <!-- Related Discussions -->
            <div class="bg-white dark:bg-zinc-800 rounded-lg border border-zinc-200 dark:border-zinc-700 p-6">
                <h3 class="text-lg font-semibold text-foreground mb-4">Related Discussions</h3>
                @if($relatedDiscussions->count() > 0)
                    <div class="space-y-2">
                        @foreach($relatedDiscussions as $related)
                            @if($related->id !== $discussion->id)
                                <div>
                                    <a href="{{ route('discussions.show', $related) }}" class="text-sm font-medium text-blue-600 hover:text-blue-800 dark:text-blue-400 dark:hover:text-blue-300 block truncate">
                                        {{ $related->title }}
                                    </a>
                                    <p class="text-xs text-muted-foreground">{{ $related->created_at->diffForHumans() }}</p>
                                </div>
                            @endif
                        @endforeach
                    </div>
                @else
                    <p class="text-sm text-muted-foreground">No related discussions found.</p>
                @endif
            </div>
        </div>
    </div>
</div>