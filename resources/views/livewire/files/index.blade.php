<div class="max-w-7xl mx-auto p-6">
    <div class="mb-6">
        <h1 class="text-3xl font-bold text-foreground">{{ __('File Browser') }}</h1>
        <p class="text-muted-foreground">{{ __('Browse, search, and manage all project files') }}</p>
    </div>

    <!-- Controls -->
    <div class="bg-white dark:bg-zinc-800 rounded-lg border border-zinc-200 dark:border-zinc-700 p-4 mb-6">
        <div class="flex flex-col md:flex-row gap-4">
            <div class="flex-1">
                <flux:field label="Search Files" for="search">
                    <flux:input
                        wire:model.live="search"
                        placeholder="Search by filename, type, or discussion..."
                        icon="magnifying-glass"
                    />
                </flux:field>
            </div>

            <div>
                <flux:field label="File Type" for="type">
                    <flux:select wire:model.live="type" id="type">
                        <option value="">All Types</option>
                        <option value="image">Images</option>
                        <option value="document">Documents</option>
                        <option value="archive">Archives</option>
                        <option value="spreadsheet">Spreadsheets</option>
                        <option value="presentation">Presentations</option>
                    </flux:select>
                </flux:field>
            </div>

            <div class="flex items-end">
                <flux:button :href="route('files.upload')" variant="primary">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="h-4 w-4 mr-2">
                        <path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4"></path>
                        <polyline points="17 8 12 3 7 8"></polyline>
                        <line x1="12" y1="3" x2="12" y2="15"></line>
                    </svg>
                    {{ __('Upload Files') }}
                </flux:button>
            </div>
        </div>
    </div>

    <!-- File Grid -->
    @if($files->count() > 0)
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6">
            @foreach($files as $file)
                <div class="bg-white dark:bg-zinc-800 rounded-lg border border-zinc-200 dark:border-zinc-700 overflow-hidden hover:shadow-md transition-shadow">
                    <div class="p-4">
                        <div class="flex flex-col items-center text-center">
                            <!-- File Icon -->
                            <div class="mb-3 cursor-pointer" wire:click="openPreview({{ $file->id }})">
                                @if($file->isImage())
                                    <div class="flex justify-center">
                                        <img src="{{ $file->getUrl() }}"
                                             alt="{{ $file->original_name }}"
                                             class="w-16 h-16 object-cover rounded-lg border border-zinc-200 dark:border-zinc-700 hover:opacity-80 transition-opacity">
                                    </div>
                                @else
                                    <div class="flex justify-center">
                                        @if(Str::contains($file->mime_type, 'pdf'))
                                            <svg xmlns="http://www.w3.org/2000/svg" width="64" height="64" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" class="text-red-500 hover:opacity-80 transition-opacity">
                                                <path d="M14.5 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V7.5L14.5 2z"/>
                                                <polyline points="14 2 14 8 20 8"/>
                                                <path d="M16 13H8"/>
                                                <path d="M16 17H8"/>
                                                <path d="M10 9H8"/>
                                            </svg>
                                        @elseif(Str::contains($file->mime_type, 'word'))
                                            <svg xmlns="http://www.w3.org/2000/svg" width="64" height="64" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" class="text-blue-500 hover:opacity-80 transition-opacity">
                                                <path d="M14.5 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V7.5L14.5 2z"/>
                                                <polyline points="14 2 14 8 20 8"/>
                                                <line x1="16" y1="13" x2="8" y2="13"/>
                                                <line x1="16" y1="17" x2="8" y2="17"/>
                                                <line x1="10" y1="9" x2="8" y2="9"/>
                                            </svg>
                                        @elseif(Str::contains($file->mime_type, 'excel'))
                                            <svg xmlns="http://www.w3.org/2000/svg" width="64" height="64" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" class="text-green-500 hover:opacity-80 transition-opacity">
                                                <path d="M14.5 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V7.5L14.5 2z"/>
                                                <polyline points="14 2 14 8 20 8"/>
                                                <path d="M8 13h2"/>
                                                <path d="M8 17h2"/>
                                                <path d="M14 13h-2"/>
                                                <path d="M14 17h-2"/>
                                                <path d="M8 9h6"/>
                                            </svg>
                                        @elseif(Str::contains($file->mime_type, 'archive'))
                                            <svg xmlns="http://www.w3.org/2000/svg" width="64" height="64" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" class="text-orange-500 hover:opacity-80 transition-opacity">
                                                <polyline points="14 2 14 8 20 8"/>
                                                <line x1="16" y1="13" x2="8" y2="13"/>
                                                <line x1="16" y1="17" x2="8" y2="17"/>
                                                <path d="M8 21h12a2 2 0 0 0 2-2V7a2 2 0 0 0-2-2H8a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2z"/>
                                            </svg>
                                        @else
                                            <svg xmlns="http://www.w3.org/2000/svg" width="64" height="64" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" class="text-zinc-500 hover:opacity-80 transition-opacity">
                                                <path d="M14.5 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V7.5L14.5 2z"/>
                                                <polyline points="14 2 14 8 20 8"/>
                                            </svg>
                                        @endif
                                    </div>
                                @endif
                            </div>

                            <!-- File Info -->
                            <h3 class="font-medium text-foreground text-sm truncate w-full">{{ $file->original_name }}</h3>
                            <p class="text-xs text-muted-foreground mt-1">{{ $file->getFormattedSize() }}</p>
                            <p class="text-xs text-muted-foreground">{{ $file->created_at->format('M d, Y') }}</p>

                            @if($file->discussion)
                                <p class="text-xs text-blue-600 dark:text-blue-400 mt-1 truncate w-full">
                                    From: {{ Str::limit($file->discussion->title, 20) }}
                                </p>
                            @endif

                            <!-- Actions -->
                            <div class="mt-3 flex gap-2">
                                <button 
                                    wire:click="openPreview({{ $file->id }})"
                                    class="inline-flex items-center gap-2 px-3 py-1.5 text-xs bg-blue-600 text-white rounded-md hover:bg-blue-700"
                                >
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="h-3 w-3">
                                        <eye class="lucide lucide-eye h-3 w-3"/>
                                    </svg>
                                    Preview
                                </button>
                                <a href="{{ $file->getPreviewUrl() }}"
                                   class="inline-flex items-center gap-2 px-3 py-1.5 text-xs bg-gray-600 text-white rounded-md hover:bg-gray-700">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="h-3 w-3">
                                        <path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4"></path>
                                        <polyline points="7 10 12 15 17 10"></polyline>
                                        <line x1="12" y1="15" x2="12" y2="3"></line>
                                    </svg>
                                    Download
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>

        <!-- Pagination -->
        <div class="mt-6">
            {{ $files->links() }}
        </div>
    @else
        <div class="text-center py-12">
            <svg xmlns="http://www.w3.org/2000/svg" class="mx-auto h-12 w-12 text-zinc-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 13h6m-3-3v6m-9 1V7a2 2 0 012-2h6l2 2h6a2 2 0 012 2v8a2 2 0 01-2 2H5a2 2 0 01-2-2z" />
            </svg>
            <h3 class="mt-2 text-sm font-medium text-foreground">No files</h3>
            <p class="mt-1 text-sm text-muted-foreground">Get started by uploading a new file.</p>
            <div class="mt-6">
                <a href="{{ route('files.upload') }}"
                   class="inline-flex items-center gap-2 px-4 py-2 bg-blue-600 text-white rounded-md hover:bg-blue-700">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M15 13l-3-3m0 0l-3 3m3-3v12" />
                    </svg>
                    Upload a File
                </a>
            </div>
        </div>
    @endif

    <!-- File Preview Modal -->
    @if($showPreviewModal)
        @php
            $previewFile = $this->previewFile;
        @endphp
        @if($previewFile)
        <div
            x-data="{ open: @entangle('showPreviewModal') }"
            x-show="open"
            x-on:keydown.escape.window="open = false; $wire.closePreview()"
            class="fixed inset-0 z-50 overflow-y-auto"
            style="display: block;"
        >
            <div class="flex items-center justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0">
                <!-- Background overlay -->
                <div
                    x-show="open"
                    x-transition:enter="ease-out duration-300"
                    x-transition:enter-start="opacity-0"
                    x-transition:enter-end="opacity-100"
                    x-transition:leave="ease-in duration-200"
                    x-transition:leave-start="opacity-100"
                    x-transition:leave-end="opacity-0"
                    class="fixed inset-0 bg-zinc-900 bg-opacity-75 transition-opacity"
                    aria-hidden="true"
                ></div>

                <!-- Modal panel -->
                <div
                    x-show="open"
                    x-transition:enter="ease-out duration-300"
                    x-transition:enter-start="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
                    x-transition:enter-end="opacity-100 translate-y-0 sm:scale-95"
                    x-transition:leave="ease-in duration-200"
                    x-transition:leave-start="opacity-100 translate-y-0 sm:scale-95"
                    x-transition:leave-end="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
                    class="inline-block bg-white dark:bg-zinc-800 rounded-lg text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:max-w-4xl sm:w-full"
                >
                    <div class="bg-white dark:bg-zinc-800 px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
                        <div class="sm:flex sm:items-start">
                            <div class="w-full">
                                <div class="flex justify-between items-center mb-4">
                                    <h3 class="text-lg leading-6 font-medium text-foreground">
                                        {{ $previewFile->original_name }}
                                    </h3>
                                    <button
                                        x-on:click="open = false; $wire.closePreview()"
                                        type="button"
                                        class="text-gray-400 hover:text-gray-600 dark:hover:text-gray-200 focus:outline-none"
                                    >
                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="h-6 w-6">
                                            <line x1="18" y1="6" x2="6" y2="18"></line>
                                            <line x1="6" y1="6" x2="18" y2="18"></line>
                                        </svg>
                                    </button>
                                </div>

                                <!-- Preview content -->
                                <div class="mt-4">
                                    @if($previewFile->isImage())
                                        <!-- Image preview -->
                                        <div class="flex justify-center">
                                            <img
                                                src="{{ $previewFile->getUrl() }}"
                                                alt="{{ $previewFile->original_name }}"
                                                class="max-w-full max-h-[70vh] object-contain rounded-lg"
                                            >
                                        </div>
                                    @elseif($previewFile->mime_type === 'application/pdf')
                                        <!-- PDF preview -->
                                        <div class="flex justify-center">
                                            <iframe
                                                src="{{ $previewFile->getUrl() }}"
                                                class="w-full h-[70vh] border border-zinc-200 dark:border-zinc-700 rounded-lg"
                                                type="application/pdf"
                                            >
                                                <p>Your browser doesn't support PDF previews. <a href="{{ $previewFile->getPreviewUrl() }}" class="text-blue-600 hover:underline">Download the PDF</a> instead.</p>
                                            </iframe>
                                        </div>
                                    @elseif(in_array($previewFile->mime_type, ['text/plain', 'text/csv']))
                                        <!-- Text file preview -->
                                        <div class="bg-zinc-50 dark:bg-zinc-900 p-4 rounded-lg border border-zinc-200 dark:border-zinc-700 max-h-[70vh] overflow-auto">
                                            <pre class="whitespace-pre-wrap text-sm font-mono">{{ Str::limit(file_get_contents(storage_path('app/public/discussions/' . $previewFile->filename)), 2000) }}</pre>
                                        </div>
                                    @else
                                        <!-- Generic file display -->
                                        <div class="text-center py-8">
                                            <div class="mx-auto flex justify-center">
                                                @if(Str::contains($previewFile->mime_type, 'pdf'))
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="96" height="96" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" class="text-red-500">
                                                        <path d="M14.5 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V7.5L14.5 2z"/>
                                                        <polyline points="14 2 14 8 20 8"/>
                                                        <path d="M16 13H8"/>
                                                        <path d="M16 17H8"/>
                                                        <path d="M10 9H8"/>
                                                    </svg>
                                                @elseif(Str::contains($previewFile->mime_type, 'word'))
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="96" height="96" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" class="text-blue-500">
                                                        <path d="M14.5 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V7.5L14.5 2z"/>
                                                        <polyline points="14 2 14 8 20 8"/>
                                                        <line x1="16" y1="13" x2="8" y2="13"/>
                                                        <line x1="16" y1="17" x2="8" y2="17"/>
                                                        <line x1="10" y1="9" x2="8" y2="9"/>
                                                    </svg>
                                                @elseif(Str::contains($previewFile->mime_type, 'excel'))
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="96" height="96" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" class="text-green-500">
                                                        <path d="M14.5 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V7.5L14.5 2z"/>
                                                        <polyline points="14 2 14 8 20 8"/>
                                                        <path d="M8 13h2"/>
                                                        <path d="M8 17h2"/>
                                                        <path d="M14 13h-2"/>
                                                        <path d="M14 17h-2"/>
                                                        <path d="M8 9h6"/>
                                                    </svg>
                                                @elseif(Str::contains($previewFile->mime_type, 'archive'))
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="96" height="96" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" class="text-orange-500">
                                                        <polyline points="14 2 14 8 20 8"/>
                                                        <line x1="16" y1="13" x2="8" y2="13"/>
                                                        <line x1="16" y1="17" x2="8" y2="17"/>
                                                        <path d="M8 21h12a2 2 0 0 0 2-2V7a2 2 0 0 0-2-2H8a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2z"/>
                                                    </svg>
                                                @else
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="96" height="96" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" class="text-zinc-500">
                                                        <path d="M14.5 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V7.5L14.5 2z"/>
                                                        <polyline points="14 2 14 8 20 8"/>
                                                    </svg>
                                                @endif
                                            </div>
                                            <p class="mt-4 text-foreground">This file type cannot be previewed. Please download to view.</p>
                                        </div>
                                    @endif
                                </div>

                                <div class="mt-6 flex justify-end gap-3">
                                    <a
                                        href="{{ $previewFile->getPreviewUrl() }}"
                                        target="_blank"
                                        class="inline-flex items-center gap-2 px-4 py-2 bg-blue-600 text-white rounded-md hover:bg-blue-700"
                                    >
                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="h-4 w-4">
                                            <path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4"></path>
                                            <polyline points="7 10 12 15 17 10"></polyline>
                                            <line x1="12" y1="15" x2="12" y2="3"></line>
                                        </svg>
                                        Preview
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @endif
    @endif
</div>