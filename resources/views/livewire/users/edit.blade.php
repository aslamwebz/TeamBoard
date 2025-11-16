<div class="mx-auto max-w-2xl">
    <div class="mb-8">
        <h1 class="text-3xl font-bold text-foreground">{{ __('Edit User') }}</h1>
        <p class="text-muted-foreground">{{ __('Update user information and permissions') }}</p>
    </div>

    <form wire:submit="save" class="space-y-6">
        <div class="grid gap-6">
            <div>
                <flux:label>{{ __('Name') }}</flux:label>
                <flux:input 
                    wire:model="name" 
                    type="text" 
                    required
                    autofocus
                />
                @error('name')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <flux:label>{{ __('Email') }}</flux:label>
                <flux:input 
                    wire:model="email" 
                    type="email" 
                    required
                />
                @error('email')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <flux:label>{{ __('New Password') }}</flux:label>
                <flux:input 
                    wire:model="password" 
                    type="password" 
                    placeholder="{{ __('Leave blank to keep current password') }}"
                />
                @error('password')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <flux:label>{{ __('Confirm New Password') }}</flux:label>
                <flux:input 
                    wire:model="password_confirmation" 
                    type="password" 
                    placeholder="{{ __('Leave blank to keep current password') }}"
                />
                @error('password_confirmation')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>
        </div>

        <div class="flex items-center justify-end gap-4 pt-6">
            <flux:button 
                type="button" 
                wire:navigate 
                href="/users"
                variant="ghost"
            >
                {{ __('Cancel') }}
            </flux:button>
            <flux:button type="submit" disabled="{{ $this->processing }}">
                {{ __('Update User') }}
            </flux:button>
        </div>
    </form>
</div>
