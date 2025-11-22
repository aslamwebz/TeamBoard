<div>
    <flux:field label="Attachments" for="files">
        <x-filepond 
            wire:model="files"
            :acceptedFileTypes="$acceptedFileTypes"
            :maxFileSize="$maxFileSize"
            :multiple="$multiple"
            allowFileTypeValidation
            allowFileSizeValidation
            allowMultiple="true"
        />
        <p class="mt-1 text-sm text-muted-foreground">Accepts images, PDFs, documents and archives. Maximum size: {{ $maxFileSize }}MB each.</p>
    </flux:field>
    
    @error('files')
        <div class="mt-2 text-sm text-red-600 dark:text-red-400">{{ $message }}</div>
    @enderror
</div>