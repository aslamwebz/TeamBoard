@aware(['showModal' => false])

<!-- File Preview Modal -->
@if($showModal)
    <div 
        x-data="{ open: true }"
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
                                    {{ $file->original_name }}
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
                                @if($file->isImage())
                                    <!-- Image preview -->
                                    <div class="flex justify-center">
                                        <img 
                                            src="{{ $file->getUrl() }}" 
                                            alt="{{ $file->original_name }}"
                                            class="max-w-full max-h-[70vh] object-contain rounded-lg"
                                        >
                                    </div>
                                @elseif($file->mime_type === 'application/pdf')
                                    <!-- PDF preview -->
                                    <div class="flex justify-center">
                                        <iframe 
                                            src="{{ $file->getUrl() }}" 
                                            class="w-full h-[70vh] border border-zinc-200 dark:border-zinc-700 rounded-lg"
                                            type="application/pdf"
                                        >
                                            <p>Your browser doesn't support PDF previews. <a href="{{ $file->getUrl() }}" class="text-blue-600 hover:underline">Download the PDF</a> instead.</p>
                                        </iframe>
                                    </div>
                                @elseif(in_array($file->mime_type, ['text/plain', 'text/csv']))
                                    <!-- Text file preview -->
                                    <div class="bg-zinc-50 dark:bg-zinc-900 p-4 rounded-lg border border-zinc-200 dark:border-zinc-700 max-h-[70vh] overflow-auto">
                                        <pre class="whitespace-pre-wrap text-sm font-mono">{{ Str::limit(file_get_contents(storage_path('app/public/discussions/' . $file->filename)), 2000) }}</pre>
                                    </div>
                                @else
                                    <!-- Generic file display -->
                                    <div class="text-center py-8">
                                        <div class="mx-auto flex justify-center">
                                            @if(Str::contains($file->mime_type, 'pdf'))
                                                <svg xmlns="http://www.w3.org/2000/svg" width="96" height="96" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" class="text-red-500">
                                                    <path d="M14.5 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V7.5L14.5 2z"/>
                                                    <polyline points="14 2 14 8 20 8"/>
                                                    <path d="M16 13H8"/>
                                                    <path d="M16 17H8"/>
                                                    <path d="M10 9H8"/>
                                                </svg>
                                            @elseif(Str::contains($file->mime_type, 'word'))
                                                <svg xmlns="http://www.w3.org/2000/svg" width="96" height="96" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" class="text-blue-500">
                                                    <path d="M14.5 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V7.5L14.5 2z"/>
                                                    <polyline points="14 2 14 8 20 8"/>
                                                    <line x1="16" y1="13" x2="8" y2="13"/>
                                                    <line x1="16" y1="17" x2="8" y2="17"/>
                                                    <line x1="10" y1="9" x2="8" y2="9"/>
                                                </svg>
                                            @elseif(Str::contains($file->mime_type, 'excel'))
                                                <svg xmlns="http://www.w3.org/2000/svg" width="96" height="96" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" class="text-green-500">
                                                    <path d="M14.5 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V7.5L14.5 2z"/>
                                                    <polyline points="14 2 14 8 20 8"/>
                                                    <path d="M8 13h2"/>
                                                    <path d="M8 17h2"/>
                                                    <path d="M14 13h-2"/>
                                                    <path d="M14 17h-2"/>
                                                    <path d="M8 9h6"/>
                                                </svg>
                                            @elseif(Str::contains($file->mime_type, 'archive'))
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
                                    href="{{ $file->getUrl() }}" 
                                    target="_blank"
                                    class="inline-flex items-center gap-2 px-4 py-2 bg-blue-600 text-white rounded-md hover:bg-blue-700"
                                >
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="h-4 w-4">
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
            </div>
        </div>
    </div>
@endif