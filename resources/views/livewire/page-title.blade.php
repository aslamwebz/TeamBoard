<div>
    @if ($icon)
        <div class="flex items-center gap-3">
            <flux:icon name="{{ $icon }}" class="h-5 w-5 text-gray-600 dark:text-gray-400"></flux:icon>
            <h1 class="text-xl font-semibold text-gray-900 dark:text-white">{{ $title }}</h1>
        </div>
    @else
        <h1 class="text-xl font-semibold text-gray-900 dark:text-white">{{ $title }}</h1>
    @endif
</div>
