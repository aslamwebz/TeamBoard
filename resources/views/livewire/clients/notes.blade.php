<div class="space-y-6">
    <flux:heading size="lg">{{ __('Notes') }}</flux:heading>
    
    <div class="bg-white dark:bg-zinc-800 rounded-lg border border-zinc-200 dark:border-zinc-700 p-6">
        <form wire:submit="saveNotes" class="space-y-4">
            <flux:field label="{{ __('Client Notes') }}" class="space-y-2">
                <flux:textarea 
                    wire:model="notes" 
                    placeholder="{{ __('Enter notes about this client...') }}"
                    rows="6" />
            </flux:field>
            
            <div class="flex justify-end">
                <flux:button type="submit" variant="primary">
                    {{ __('Save Notes') }}
                </flux:button>
            </div>
        </form>
    </div>
</div>