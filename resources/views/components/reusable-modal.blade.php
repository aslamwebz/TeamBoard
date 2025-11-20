@props([
    'name',
    'showProperty',
    'title',
    'description' => '',
    'items' => collect([]),
    'selectedItemsProperty' => 'selectedItems', // Name of the property in the parent component
    'onSubmit' => '',
    'submitLabel' => 'Submit',
    'cancelLabel' => 'Cancel',
    'type' => 'assign', // assign, confirm, etc.
])

<flux:modal :name="$name" :wire:model="$showProperty" class="min-w-[32rem]">
    <div class="space-y-6">
        <div>
            <flux:heading size="lg">{{ $title }}</flux:heading>
            @if($description)
                <flux:text class="mt-2">{{ $description }}</flux:text>
            @endif
        </div>

        @if($type === 'assign' && $items->count() > 0)
            <div class="space-y-3 max-h-64 overflow-y-auto">
                @foreach ($items as $item)
                    <label
                        class="flex items-center gap-3 p-3 border border-zinc-200 dark:border-zinc-700 rounded-lg cursor-pointer hover:bg-zinc-50 dark:hover:bg-zinc-700/50">
                        <input type="checkbox"
                               :wire:model{{ sprintf("=\"%s\"", $selectedItemsProperty) }}
                               :value="{{ $item->id }}"
                               class="rounded text-blue-600">
                        <div class="flex-1">
                            <h4 class="font-medium text-foreground">{{ $item->name ?? $item->title ?? $item->email ?? $item->id }}</h4>
                            @if(isset($item->description))
                                <p class="text-sm text-zinc-500 dark:text-zinc-400">{{ Str::limit($item->description, 60) }}</p>
                            @elseif(isset($item->company_name))
                                <p class="text-sm text-zinc-500 dark:text-zinc-400">{{ $item->company_name }}</p>
                            @endif
                        </div>
                    </label>
                @endforeach
            </div>
        @elseif($type === 'assign' && $items->count() === 0)
            <div class="text-center py-8">
                <flux:text class="text-zinc-500 dark:text-zinc-400">No items available to assign</flux:text>
            </div>
        @endif

        <div class="flex gap-2">
            <flux:spacer />
            <flux:modal.close>
                <flux:button variant="ghost">{{ $cancelLabel }}</flux:button>
            </flux:modal.close>
            @if($onSubmit)
                <flux:button wire:click="{{ $onSubmit }}" variant="primary">
                    {{ $submitLabel }}
                </flux:button>
            @endif
        </div>
    </div>
</flux:modal>
