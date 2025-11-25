<div class="space-y-4">
    <!-- Header -->
    <div class="flex items-center justify-between">
        <div>
            <h2 class="text-lg font-semibold text-foreground">{{ __('Contacts') }}</h2>
            <p class="text-sm text-muted-foreground">{{ __('Manage contacts for :client', ['client' => $client->name ?? $client->company_name]) }}</p>
        </div>
        <flux:button wire:click="$dispatch('open-modal', 'create-contact')" variant="primary" size="sm">
            {{ __('Add Contact') }}
        </flux:button>
    </div>

    <!-- Search -->
    <div class="flex flex-col sm:flex-row gap-4">
        <div class="flex-1">
            <flux:input 
                type="text" 
                wire:model.live="search" 
                placeholder="{{ __('Search contacts...') }}" />
        </div>
    </div>

    <!-- Contacts List -->
    <div class="space-y-3">
        @forelse($contacts as $contact)
            <div class="bg-white dark:bg-zinc-800 rounded-lg border border-zinc-200 dark:border-zinc-700 p-4">
                <div class="flex items-center justify-between">
                    <div class="flex items-center">
                        <div class="flex-shrink-0 h-10 w-10 rounded-full bg-gradient-to-r from-blue-500 to-purple-600 flex items-center justify-center text-white font-medium">
                            {{ substr($contact->first_name, 0, 1) }}
                        </div>
                        <div class="ml-4">
                            <div class="font-medium text-foreground">{{ $contact->full_name }}</div>
                            <div class="text-sm text-zinc-500 dark:text-zinc-400">
                                {{ $contact->position }} @if($contact->job_title) • {{ $contact->job_title }} @endif
                            </div>
                            <div class="text-sm text-zinc-500 dark:text-zinc-400">
                                <a href="mailto:{{ $contact->email }}" class="hover:text-blue-600 dark:hover:text-blue-400">{{ $contact->email }}</a>
                                @if($contact->phone)
                                    • {{ $contact->phone }}
                                @endif
                            </div>
                        </div>
                    </div>
                    <div class="flex items-center space-x-2">
                        @if($contact->is_primary)
                            <flux:badge variant="outline" class="text-blue-700 dark:text-blue-400">Primary</flux:badge>
                        @endif
                        @if($contact->is_billing_contact)
                            <flux:badge variant="outline" class="text-green-700 dark:text-green-400">Billing</flux:badge>
                        @endif
                        @if($contact->is_technical_contact)
                            <flux:badge variant="outline" class="text-purple-700 dark:text-purple-400">Technical</flux:badge>
                        @endif
                        <div class="flex space-x-1">
                            @if(!$contact->is_primary)
                                <flux:button 
                                    variant="ghost" 
                                    size="sm" 
                                    title="{{ __('Make Primary Contact') }}"
                                    wire:click="makePrimary({{ $contact->id }})">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="h-4 w-4">
                                        <path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z" />
                                    </svg>
                                </flux:button>
                            @endif
                            <flux:button 
                                variant="ghost" 
                                size="sm" 
                                title="{{ __('Edit Contact') }}"
                                wire:click="$dispatch('open-modal', {name: 'edit-contact', params: {contact: {{ $contact->id }}}})">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="h-4 w-4">
                                    <path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7" />
                                    <path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z" />
                                </svg>
                            </flux:button>
                            <flux:button 
                                variant="ghost" 
                                size="sm" 
                                color="red"
                                title="{{ __('Delete Contact') }}"
                                wire:click="deleteContact({{ $contact->id }})">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="h-4 w-4">
                                    <path d="M3 6h18" />
                                    <path d="M19 6v14c0 1-1 2-2 2H7c-1 0-2-1-2-2V6" />
                                </svg>
                            </flux:button>
                        </div>
                    </div>
                </div>
            </div>
        @empty
            <div class="bg-white dark:bg-zinc-800 rounded-lg border border-zinc-200 dark:border-zinc-700 p-8 text-center">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="mx-auto h-12 w-12 text-zinc-400">
                    <path d="M17 3a2.85 2.83 0 1 1 4 4L7.5 20.5 2 22l1.5-5.5Z" />
                </svg>
                <h3 class="mt-2 text-sm font-medium text-foreground">{{ __('No contacts') }}</h3>
                <p class="mt-1 text-sm text-zinc-500 dark:text-zinc-400">
                    {{ __('No contacts for this client yet.') }}</p>
            </div>
        @endforelse
    </div>

    <!-- Pagination -->
    @if($contacts->hasPages())
        <div class="mt-4">
            {{ $contacts->links() }}
        </div>
    @endif
</div>
