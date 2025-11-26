<div>
    <div class="sm:flex sm:items-center">
        <div class="sm:flex-auto">
            <h1 class="text-base font-semibold leading-6 text-gray-900">Expense Attachments</h1>
            <p class="mt-2 text-sm text-gray-700">Manage attachments for expense {{ $expense->title }}.</p>
        </div>
    </div>

    <!-- Add Attachment Form -->
    <div class="mt-6 bg-white shadow sm:rounded-lg">
        <div class="border-b border-gray-200 px-4 py-5 sm:px-6">
            <h3 class="text-lg font-medium leading-6 text-gray-900">Add Attachment</h3>
        </div>
        <div class="px-4 py-5 sm:p-6">
            <form wire:submit="addAttachment" class="space-y-4">
                <div>
                    <label for="attachments" class="block text-sm font-medium leading-6 text-gray-900">Choose files</label>
                    <div class="mt-2">
                        <input type="file" wire:model="newAttachment" multiple class="block w-full text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 dark:text-gray-400 focus:outline-none">
                        @error('newAttachment') <span class="text-red-600 text-sm">{{ $message }}</span> @enderror
                        <p class="mt-1 text-sm text-gray-500">Maximum file size: 10MB per file.</p>
                    </div>
                </div>

                <div class="flex justify-end">
                    <button type="submit" class="rounded-md bg-indigo-600 px-3 py-2 text-sm font-semibold text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">
                        Upload Attachments
                    </button>
                </div>
            </form>
        </div>
    </div>

    <!-- Attachment List -->
    <div class="mt-6 bg-white shadow sm:rounded-lg">
        <div class="border-b border-gray-200 px-4 py-5 sm:px-6">
            <h3 class="text-lg font-medium leading-6 text-gray-900">Attachments</h3>
        </div>
        <div class="px-4 py-5 sm:p-6">
            @if($attachments->count() > 0)
                <div class="overflow-hidden bg-white shadow sm:rounded-md">
                    <ul role="list" class="divide-y divide-gray-200">
                        @foreach($attachments as $attachment)
                            <li>
                                <div class="px-4 py-4 sm:px-6">
                                    <div class="flex items-center justify-between">
                                        <div class="text-sm font-medium text-indigo-600 truncate">
                                            <a href="{{ $attachment->getUrl() }}" target="_blank" class="hover:underline">
                                                {{ $attachment->original_name }}
                                            </a>
                                        </div>
                                        <div class="flex items-center">
                                            <div class="ml-4 text-sm text-gray-500">
                                                {{ number_format($attachment->size / 1024, 2) }} KB
                                            </div>
                                            <div class="ml-4">
                                                <button 
                                                    wire:click="deleteAttachment({{ $attachment->id }})" 
                                                    class="text-red-600 hover:text-red-900"
                                                    onclick="confirm('Are you sure you want to delete this attachment?') || event.stopImmediatePropagation()"
                                                >
                                                    Delete
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="mt-2 sm:flex sm:justify-between">
                                        <div class="sm:flex">
                                            <div class="text-sm text-gray-900">
                                                <p class="truncate">{{ $attachment->mime_type }}</p>
                                            </div>
                                        </div>
                                        <div class="mt-2 flex items-center text-sm text-gray-500 sm:mt-0">
                                            <p>Uploaded: {{ $attachment->created_at->format('M d, Y H:i') }}</p>
                                        </div>
                                    </div>
                                </div>
                            </li>
                        @endforeach
                    </ul>
                </div>
            @else
                <p class="text-sm text-gray-500">No attachments for this expense yet.</p>
            @endif
        </div>
    </div>

    <div class="mt-4">
        <a href="{{ route('expenses.show', $expense) }}" class="rounded-md bg-gray-600 px-3 py-2 text-sm font-semibold text-white shadow-sm hover:bg-gray-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-gray-600">
            Back to Expense
        </a>
    </div>
</div>