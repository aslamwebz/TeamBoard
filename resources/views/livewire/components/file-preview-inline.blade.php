<div class="file-preview inline-block">
    @if($attachment->isImage())
        <!-- Image preview -->
        <div class="relative group"
             onclick="window.open('{{ route('tenant.file.preview.page', ['filename' => $attachment->filename]) }}', '_blank')"
             style="cursor: pointer;">
            <img
                src="{{ $attachment->getUrl() }}"
                alt="{{ $attachment->original_name }}"
                class="
                    @if($size === 'small') w-12 h-12
                    @elseif($size === 'large') w-24 h-24
                    @else w-16 h-16
                    @endif
                    object-cover rounded hover:opacity-80 transition-opacity"
            >
            <div class="absolute inset-0 bg-black bg-opacity-50 flex items-center justify-center opacity-0 group-hover:opacity-100 transition-opacity rounded">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="text-white h-6 w-6">
                    <eye class="lucide lucide-eye h-6 w-6"/>
                </svg>
            </div>
        </div>
    @elseif($attachment->mime_type === 'application/pdf')
        <!-- PDF preview -->
        <div class="relative group"
             onclick="window.open('{{ route('tenant.file.preview.page', ['filename' => $attachment->filename]) }}', '_blank')"
             style="cursor: pointer;">
            <div class="
                bg-red-100 dark:bg-red-900/30
                border border-red-200 dark:border-red-800
                rounded-lg p-3 flex flex-col items-center justify-center
                @if($size === 'small') w-12 h-12
                @elseif($size === 'large') w-24 h-24
                @else w-16 h-16
                @endif
                hover:bg-red-200/50 dark:hover:bg-red-900/50 transition-colors"
            >
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="text-red-500 h-5 w-5">
                    <path d="M14.5 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V7.5L14.5 2z"/>
                    <polyline points="14 2 14 8 20 8"/>
                    <path d="M16 13H8"/>
                    <path d="M16 17H8"/>
                    <path d="M10 9H8"/>
                </svg>
                <span class="text-xs mt-1 text-red-600 dark:text-red-400">PDF</span>
            </div>
            <div class="absolute inset-0 bg-black bg-opacity-50 flex items-center justify-center opacity-0 group-hover:opacity-100 transition-opacity rounded">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="text-white h-6 w-6">
                    <eye class="lucide lucide-eye h-6 w-6"/>
                </svg>
            </div>
        </div>
    @else
        <!-- Generic file preview -->
        <div class="relative group"
             onclick="window.open('{{ route('tenant.file.preview.page', ['filename' => $attachment->filename]) }}', '_blank')"
             style="cursor: pointer;">
            <div class="
                bg-gray-100 dark:bg-gray-800/50
                border border-gray-200 dark:border-gray-700
                rounded-lg p-3 flex flex-col items-center justify-center
                @if($size === 'small') w-12 h-12
                @elseif($size === 'large') w-24 h-24
                @else w-16 h-16
                @endif
                hover:bg-gray-200/50 dark:hover:bg-gray-800/70 transition-colors"
            >
                @if(Str::contains($attachment->mime_type, 'word'))
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="text-blue-500 h-5 w-5">
                        <path d="M14.5 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V7.5L14.5 2z"/>
                        <polyline points="14 2 14 8 20 8"/>
                        <line x1="16" y1="13" x2="8" y2="13"/>
                        <line x1="16" y1="17" x2="8" y2="17"/>
                        <line x1="10" y1="9" x2="8" y2="9"/>
                    </svg>
                    <span class="text-xs mt-1 text-blue-600 dark:text-blue-400">DOC</span>
                @elseif(Str::contains($attachment->mime_type, 'excel'))
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="text-green-500 h-5 w-5">
                        <path d="M14.5 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V7.5L14.5 2z"/>
                        <polyline points="14 2 14 8 20 8"/>
                        <path d="M8 13h2"/>
                        <path d="M8 17h2"/>
                        <path d="M14 13h-2"/>
                        <path d="M14 17h-2"/>
                        <path d="M8 9h6"/>
                    </svg>
                    <span class="text-xs mt-1 text-green-600 dark:text-green-400">XLS</span>
                @elseif(Str::contains($attachment->mime_type, 'archive'))
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="text-orange-500 h-5 w-5">
                        <polyline points="14 2 14 8 20 8"/>
                        <line x1="16" y1="13" x2="8" y2="13"/>
                        <line x1="16" y1="17" x2="8" y2="17"/>
                        <path d="M8 21h12a2 2 0 0 0 2-2V7a2 2 0 0 0-2-2H8a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2z"/>
                    </svg>
                    <span class="text-xs mt-1 text-orange-600 dark:text-orange-400">ZIP</span>
                @else
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="text-gray-500 h-5 w-5">
                        <path d="M14.5 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V7.5L14.5 2z"/>
                        <polyline points="14 2 14 8 20 8"/>
                    </svg>
                    <span class="text-xs mt-1 text-gray-600 dark:text-gray-400">{{ strtoupper($attachment->getExtension()) }}</span>
                @endif
            </div>
        </div>
    @endif
</div>