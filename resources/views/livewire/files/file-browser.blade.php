<flux:modal name="file-browser" wire:model="showModal" maxWidth="2xl">
    <div class="space-y-6">
        <div>
            <flux:heading size="lg">File Browser</flux:heading>
            <flux:text class="mt-2">Upload and manage files for your discussions</flux:text>
        </div>

        <!-- Upload Section -->
        <div class="border border-zinc-200 dark:border-zinc-700 rounded-lg p-4">
            <flux:field label="Upload Files">
                <input
                    type="file"
                    wire:model="files"
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
                <p class="mt-1 text-sm text-muted-foreground">Max file size: {{ $maxFileSize / 1024 / 1024 }}MB each</p>
            </flux:field>

            @if($files && $files->count() > 0)
                <div class="mt-3 grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-2">
                    @foreach($files as $file)
                        <div class="flex items-center p-2 bg-zinc-50 dark:bg-zinc-700/30 rounded text-xs">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="h-4 w-4 text-gray-500 mr-2">
                                <path d="M14.5 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V7.5L14.5 2z"/><polyline points="14 2 14 8 20 8"/>
                            </svg>
                            <span class="truncate">{{ $file->getClientOriginalName() }}</span>
                        </div>
                    @endforeach
                </div>
            @endif
        </div>

        <!-- Selected Files -->
        @if(count($selectedFiles) > 0)
            <div>
                <flux:subheading>Selected Files</flux:subheading>
                <div class="mt-2 space-y-2">
                    @foreach($selectedFiles as $index => $fileId)
                        @php
                            $attachment = \App\Models\DiscussionAttachment::find($fileId);
                        @endphp
                        @if($attachment)
                            <div class="flex items-center justify-between p-2 bg-blue-50 dark:bg-blue-900/20 rounded">
                                <div class="flex items-center">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="h-4 w-4 text-blue-500 mr-2">
                                        <path d="M14.5 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V7.5L14.5 2z"/><polyline points="14 2 14 8 20 8"/>
                                    </svg>
                                    <span class="text-sm">{{ $attachment->original_name }}</span>
                                </div>
                                <flux:button
                                    type="button"
                                    variant="outline"
                                    size="sm"
                                    color="red"
                                    wire:click="removeSelectedFile({{ $index }})"
                                >
                                    Remove
                                </flux:button>
                            </div>
                        @endif
                    @endforeach
                </div>
            </div>
        @endif

        <div class="flex gap-2">
            <flux:spacer />
            <flux:button
                variant="outline"
                wire:click="closeModal"
            >
                Cancel
            </flux:button>
            <flux:button
                variant="primary"
                wire:click="uploadFiles"
                :disabled="$files->isEmpty()"
            >
                Upload
            </flux:button>
        </div>
    </div>
</flux:modal>