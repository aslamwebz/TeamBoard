<div class="space-y-6">
    <div class="flex items-center justify-between">
        <flux:heading size="lg">{{ __('Attachments') }}</flux:heading>
        
        <flux:button wire:click="uploadForm = true" variant="primary" class="flex items-center gap-2">
            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="h-4 w-4">
                <path d="M21.2 8.4c.4-.4.4-1 0-1.4l-7-7a1 1 0 0 0-1.4 0l-7 7c-.4.4-.4 1 0 1.4.4.4 1 .4 1.4 0L4 7.8V14a6 6 0 0 0 12 0V4.2l1.6 1.6c.4.4 1 .4 1.4 0z" />
                <path d="M10 2v8.283a4 4 0 0 0 8 0V2" />
            </svg>
            {{ __('Upload File') }}
        </flux:button>
    </div>

    <!-- Upload Form -->
    @if($uploadForm)
    <div class="bg-white dark:bg-zinc-800 rounded-lg border border-zinc-200 dark:border-zinc-700 p-6">
        <form wire:submit="addAttachments" class="space-y-4">
            <div class="grid grid-cols-1 gap-4 md:grid-cols-2">
                <flux:field label="{{ __('Files') }}" class="space-y-2 md:col-span-2">
                    <flux:input 
                        type="file" 
                        wire:model="files"
                        multiple
                        accept="*/*" 
                        :invalid="$errors->has('files')" />
                    @error('files')
                        <flux:div class="text-red-600 dark:text-red-400 text-sm mt-1">{{ $message }}</flux:div>
                    @enderror
                </flux:field>
                
                <flux:field label="{{ __('Type') }}" class="space-y-2">
                    <flux:select 
                        wire:model="attachment_type"
                        :invalid="$errors->has('attachment_type')">
                        <option value="contract">{{ __('Contract') }}</option>
                        <option value="nda">{{ __('NDA') }}</option>
                        <option value="onboarding">{{ __('Onboarding Doc') }}</option>
                        <option value="invoice">{{ __('Invoice') }}</option>
                        <option value="document">{{ __('Document') }}</option>
                        <option value="other">{{ __('Other') }}</option>
                    </flux:select>
                    @error('attachment_type')
                        <flux:div class="text-red-600 dark:text-red-400 text-sm mt-1">{{ $message }}</flux:div>
                    @enderror
                </flux:field>
                
                <flux:field label="{{ __('Description') }}" class="space-y-2">
                    <flux:input 
                        wire:model="description" 
                        type="text" 
                        placeholder="{{ __('Enter description (optional)') }}"
                        :invalid="$errors->has('description')" />
                    @error('description')
                        <flux:div class="text-red-600 dark:text-red-400 text-sm mt-1">{{ $message }}</flux:div>
                    @enderror
                </flux:field>
            </div>
            
            <div class="flex justify-end space-x-3 pt-4">
                <flux:button type="button" variant="outline" wire:click="$set('uploadForm', false)">
                    {{ __('Cancel') }}
                </flux:button>
                <flux:button type="submit" variant="primary">
                    {{ __('Upload Files') }}
                </flux:button>
            </div>
        </form>
    </div>
    @endif

    <!-- Attachments List -->
    @if($attachments->count() > 0)
        <div class="bg-white dark:bg-zinc-800 rounded-lg border border-zinc-200 dark:border-zinc-700 overflow-hidden">
            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-zinc-200 dark:divide-zinc-700">
                    <thead class="bg-zinc-50 dark:bg-zinc-700/50">
                        <tr>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-zinc-500 dark:text-zinc-400 uppercase tracking-wider">
                                {{ __('File') }}
                            </th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-zinc-500 dark:text-zinc-400 uppercase tracking-wider">
                                {{ __('Type') }}
                            </th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-zinc-500 dark:text-zinc-400 uppercase tracking-wider">
                                {{ __('Size') }}
                            </th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-zinc-500 dark:text-zinc-400 uppercase tracking-wider">
                                {{ __('Uploaded') }}
                            </th>
                            <th scope="col" class="px-6 py-3 text-right text-xs font-medium text-zinc-500 dark:text-zinc-400 uppercase tracking-wider">
                                {{ __('Actions') }}
                            </th>
                        </tr>
                    </thead>
                    <tbody class="bg-white dark:bg-zinc-800 divide-y divide-zinc-200 dark:divide-zinc-700">
                        @foreach($attachments as $attachment)
                            <tr class="hover:bg-zinc-50 dark:hover:bg-zinc-700/50">
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="flex items-center">
                                        <div class="flex-shrink-0 h-8 w-8">
                                            @if(str_contains($attachment->mime_type, 'image'))
                                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="h-6 w-6 text-blue-500">
                                                    <rect width="18" height="18" x="3" y="3" rx="2" ry="2" />
                                                    <circle cx="9" cy="9" r="2" />
                                                    <path d="m21 15-3.086-3.086a2 2 0 0 0-2.828 0L6 21" />
                                                </svg>
                                            @elseif(str_contains($attachment->mime_type, 'pdf'))
                                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="h-6 w-6 text-red-500">
                                                    <path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z" />
                                                    <polyline points="14 2 14 8 20 8" />
                                                    <path d="M16 13H8" />
                                                    <path d="M16 17H8" />
                                                    <path d="M10 9H8" />
                                                </svg>
                                            @elseif(str_contains($attachment->mime_type, 'wordprocessing'))
                                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="h-6 w-6 text-blue-500">
                                                    <path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z" />
                                                    <polyline points="14 2 14 8 20 8" />
                                                    <line x1="16" y1="13" x2="8" y2="13" />
                                                    <line x1="16" y1="17" x2="8" y2="17" />
                                                    <line x1="10" y1="9" x2="8" y2="9" />
                                                </svg>
                                            @elseif(str_contains($attachment->mime_type, 'spreadsheet'))
                                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="h-6 w-6 text-green-500">
                                                    <path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z" />
                                                    <polyline points="14 2 14 8 20 8" />
                                                    <line x1="16" y1="13" x2="8" y2="13" />
                                                    <line x1="16" y1="17" x2="8" y2="17" />
                                                    <line x1="10" y1="9" x2="8" y2="9" />
                                                </svg>
                                            @else
                                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="h-6 w-6 text-gray-500">
                                                    <path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z" />
                                                    <polyline points="14 2 14 8 20 8" />
                                                </svg>
                                            @endif
                                        </div>
                                        <div class="ml-4">
                                            <div class="text-sm font-medium text-foreground">{{ $attachment->name }}</div>
                                            <a href="{{ $attachment->download_url }}" target="_blank" class="text-sm text-blue-600 hover:text-blue-800 dark:text-blue-400 dark:hover:text-blue-300">
                                                {{ __('Download') }}
                                            </a>
                                        </div>
                                    </div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-foreground">
                                    <flux:badge>
                                        {{ ucfirst(str_replace('_', ' ', $attachment->type)) }}
                                    </flux:badge>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-foreground">
                                    {{ $attachment->formatted_size }}
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-foreground">
                                    {{ $attachment->uploaded_at->format('M j, Y') }}
                                    <div class="text-xs text-zinc-500 dark:text-zinc-400">
                                        {{ $attachment->uploader?->name ?? 'System' }}
                                    </div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                    <flux:button 
                                        variant="ghost" 
                                        size="sm" 
                                        color="red"
                                        wire:click="deleteAttachment({{ $attachment->id }})"
                                        title="{{ __('Delete Attachment') }}">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="h-4 w-4">
                                            <path d="M3 6h18" />
                                            <path d="M19 6v14c0 1-1 2-2 2H7c-1 0-2-1-2-2V6" />
                                            <path d="M8 6V4c0-1 1-2 2-2h4c1 0 2 1 2 2v2" />
                                        </svg>
                                    </flux:button>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    @else
        <!-- Empty State -->
        <div class="bg-white dark:bg-zinc-800 rounded-lg border border-zinc-200 dark:border-zinc-700 p-12 text-center">
            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="mx-auto h-12 w-12 text-zinc-400">
                <path d="M21.2 8.4c.4-.4.4-1 0-1.4l-7-7a1 1 0 0 0-1.4 0l-7 7c-.4.4-.4 1 0 1.4.4.4 1 .4 1.4 0L4 7.8V14a6 6 0 0 0 12 0V4.2l1.6 1.6c.4.4 1 .4 1.4 0z" />
                <path d="M10 2v8.283a4 4 0 0 0 8 0V2" />
            </svg>
            <h3 class="mt-2 text-sm font-medium text-foreground">{{ __('No attachments') }}</h3>
            <p class="mt-1 text-sm text-zinc-500 dark:text-zinc-400">
                {{ __('Get started by uploading a file.') }}</p>
            <div class="mt-6">
                <flux:button wire:click="uploadForm = true" variant="primary">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="h-4 w-4 mr-2">
                        <path d="M21.2 8.4c.4-.4.4-1 0-1.4l-7-7a1 1 0 0 0-1.4 0l-7 7c-.4.4-.4 1 0 1.4.4.4 1 .4 1.4 0L4 7.8V14a6 6 0 0 0 12 0V4.2l1.6 1.6c.4.4 1 .4 1.4 0z" />
                        <path d="M10 2v8.283a4 4 0 0 0 8 0V2" />
                    </svg>
                    {{ __('Upload File') }}
                </flux:button>
            </div>
        </div>
    @endif
</div>
