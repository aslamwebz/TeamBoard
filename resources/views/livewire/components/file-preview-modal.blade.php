<div>
    @if ($showPreviewModal && $file)
        <div x-data="{ open: @entangle('showPreviewModal') }" x-show="open" x-on:keydown.escape.window="open = false; $wire.closePreview()"
            class="fixed inset-0 z-50 overflow-y-auto" style="display: block;">
            <div class="flex items-center justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0">
                <!-- Background overlay -->
                <div x-show="open" x-transition:enter="ease-out duration-300" x-transition:enter-start="opacity-0"
                    x-transition:enter-end="opacity-100" x-transition:leave="ease-in duration-200"
                    x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0"
                    class="fixed inset-0 bg-white/90 dark:bg-zinc-900/80 backdrop-blur-sm transition-opacity" aria-hidden="true"></div>

                <!-- Modal panel -->
                <div x-show="open" x-transition:enter="ease-out duration-300"
                    x-transition:enter-start="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
                    x-transition:enter-end="opacity-100 translate-y-0 sm:scale-95"
                    x-transition:leave="ease-in duration-200"
                    x-transition:leave-start="opacity-100 translate-y-0 sm:scale-95"
                    x-transition:leave-end="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
                    class="inline-block bg-white dark:bg-zinc-800 rounded-xl text-left overflow-hidden shadow-2xl transform transition-all sm:my-8 sm:max-w-6xl sm:w-full max-h-[90vh] w-full flex flex-col max-w-5xl">
                    <div class="bg-white dark:bg-zinc-800 p-6 flex flex-col h-full">
                        <!-- Header with file info and close button -->
                        <div class="flex items-center justify-between pb-4 border-b border-zinc-200 dark:border-zinc-700 mb-4">
                            <div class="flex-1 min-w-0">
                                <h3 class="text-xl font-semibold text-foreground truncate">
                                    {{ $file->original_name }}
                                </h3>
                                <p class="text-sm text-muted-foreground mt-1">
                                    {{ $file->getFormattedSize() }} • Uploaded {{ $file->created_at->format('M d, Y') }}
                                </p>
                            </div>
                            <button x-on:click="open = false; $wire.closePreview()" type="button"
                                class="ml-4 p-2 rounded-lg text-gray-500 hover:text-gray-700 dark:text-gray-400 dark:hover:text-gray-200 hover:bg-gray-100 dark:hover:bg-zinc-700 focus:outline-none focus:ring-2 focus:ring-blue-500">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                    viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                    stroke-linecap="round" stroke-linejoin="round" class="h-5 w-5">
                                    <line x1="18" y1="6" x2="6" y2="18"></line>
                                    <line x1="6" y1="6" x2="18" y2="18"></line>
                                </svg>
                            </button>
                        </div>

                        <!-- Preview content area -->
                        <div class="flex-1 overflow-auto max-h-[60vh] bg-white dark:bg-zinc-800">
                            @if ($file)
                                @php
                                    $filePath = 'discussions/' . $file->filename;
                                    $fileUrl = $file->getUrl();
                                    $fileName = $file->original_name;
                                    $type = Storage::disk('public')->mimeType($filePath);

                                    // Determine the appropriate view based on file type
                                    $viewData = [
                                        'fileName' => $fileName,
                                        'fileUrl' => $fileUrl,
                                        'type' => $type,
                                        'fileData' => [],
                                        'metadata' => ['size' => Storage::disk('public')->size($filePath)],
                                        'iconClass' => 'fa-solid fa-file',
                                        'filesizenyteformat' => '',
                                    ];

                                    // Format file size
                                    $size = Storage::disk('public')->size($filePath);
                                    $base = log($size) / log(1024);
                                    $suffixes = [' bytes', ' KB', ' MB', ' GB', ' TB'];
                                    $viewData['filesizenyteformat'] =
                                        round(pow(1024, $base - floor($base)), 2) . $suffixes[floor($base)];

                                    // Set icon based on file type
                                    switch (explode('/', $type)[0]) {
                                        case 'image':
                                            $viewData['iconClass'] = 'fa-solid fa-file-image';
                                            echo view(
                                                'laravel-file-viewer::previewFileImage',
                                                $viewData,
                                            )->render();
                                            break;
                                        case 'audio':
                                            $viewData['iconClass'] = 'fa-solid fa-file-audio';
                                            echo view(
                                                'laravel-file-viewer::previewFileAudio',
                                                $viewData,
                                            )->render();
                                            break;
                                        case 'video':
                                            $viewData['iconClass'] = 'fa-solid fa-file-video';
                                            echo view(
                                                'laravel-file-viewer::previewFileVideo',
                                                $viewData,
                                            )->render();
                                            break;
                                        case 'application':
                                            $subtype = explode('/', $type)[1];
                                            if (
                                                $subtype ===
                                                    'vnd.openxmlformats-officedocument.wordprocessingml.document' ||
                                                $subtype === 'msword'
                                            ) {
                                                $viewData['iconClass'] = 'fa-solid fa-file-word';
                                                echo view(
                                                    'laravel-file-viewer::previewFileDocxjs',
                                                    $viewData,
                                                )->render();
                                            } else {
                                                // For PDF and other application types
                                                if ($subtype === 'pdf') {
                                                    $viewData['iconClass'] = 'fa-solid fa-file-pdf';
                                                }
                                                echo view(
                                                    'laravel-file-viewer::previewFileOffice',
                                                    $viewData,
                                                )->render();
                                            }
                                            break;
                                        default:
                                            echo view(
                                                'laravel-file-viewer::previewFileOffice',
                                                $viewData,
                                            )->render();
                                            break;
                                    }
                                @endphp
                            @endif
                        </div>

                        <!-- Action buttons -->
                        <div class="mt-6 flex justify-end gap-3 pt-4 border-t border-zinc-200 dark:border-zinc-700">
                            <a href="{{ $file->getPreviewUrl() }}" target="_blank"
                                class="inline-flex items-center gap-2 px-4 py-2.5 bg-blue-600 text-white rounded-lg hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 transition-colors">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                    viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                    stroke-linecap="round" stroke-linejoin="round" class="h-4 w-4">
                                    <path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4"></path>
                                    <polyline points="7 10 12 15 17 10"></polyline>
                                    <line x1="12" y1="15" x2="12" y2="3"></line>
                                </svg>
                                Download File
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endif
</div>
