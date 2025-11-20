<div class="space-y-6">
    <!-- Header -->
    <div class="flex items-center justify-between">
        <div>
            <h1 class="text-3xl font-bold text-foreground">{{ __('Contacts') }}</h1>
            <p class="text-muted-foreground">{{ __('Manage contacts for :client', ['client' => $client->name ?? $client->company_name]) }}</p>
        </div>
        <flux:button wire:click="$dispatch('open-modal', 'create-contact')" variant="primary">
            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="h-4 w-4 mr-2">
                <path d="M5 12h14"></path>
                <path d="M12 5v14"></path>
            </svg>
            {{ __('New Contact') }}
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

    <!-- Contacts Table -->
    <div class="bg-white dark:bg-zinc-800 rounded-lg border border-zinc-200 dark:border-zinc-700 overflow-hidden">
        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-zinc-200 dark:divide-zinc-700">
                <thead class="bg-zinc-50 dark:bg-zinc-700/50">
                    <tr>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-zinc-500 dark:text-zinc-400 uppercase tracking-wider">
                            {{ __('Contact') }}
                        </th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-zinc-500 dark:text-zinc-400 uppercase tracking-wider">
                            {{ __('Position') }}
                        </th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-zinc-500 dark:text-zinc-400 uppercase tracking-wider">
                            {{ __('Email') }}
                        </th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-zinc-500 dark:text-zinc-400 uppercase tracking-wider">
                            {{ __('Phone') }}
                        </th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-zinc-500 dark:text-zinc-400 uppercase tracking-wider">
                            {{ __('Type') }}
                        </th>
                        <th scope="col" class="px-6 py-3 text-right text-xs font-medium text-zinc-500 dark:text-zinc-400 uppercase tracking-wider">
                            {{ __('Actions') }}
                        </th>
                    </tr>
                </thead>
                <tbody class="bg-white dark:bg-zinc-800 divide-y divide-zinc-200 dark:divide-zinc-700">
                    @forelse($contacts as $contact)
                        <tr class="hover:bg-zinc-50 dark:hover:bg-zinc-700/50">
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="flex items-center">
                                    <div class="flex-shrink-0 h-10 w-10">
                                        <div class="h-10 w-10 rounded-full bg-gradient-to-r from-blue-500 to-purple-600 flex items-center justify-center text-white font-medium">
                                            {{ substr($contact->first_name, 0, 1) }}
                                        </div>
                                    </div>
                                    <div class="ml-4">
                                        <div class="text-sm font-medium text-foreground">{{ $contact->full_name }}</div>
                                        <div class="text-sm text-zinc-500 dark:text-zinc-400">
                                            {{ $contact->job_title ?: $contact->position }}
                                        </div>
                                    </div>
                                </div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-foreground">
                                {{ $contact->position }}
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-foreground">
                                <a href="mailto:{{ $contact->email }}" class="text-blue-600 hover:text-blue-800 dark:text-blue-400 dark:hover:text-blue-300">
                                    {{ $contact->email }}
                                </a>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-foreground">
                                {{ $contact->phone ? $contact->phone : ($contact->mobile_phone ?: $contact->work_phone) }}
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-foreground">
                                <div class="space-y-1">
                                    @if($contact->is_primary)
                                        <flux:badge variant="outline" class="text-blue-700 dark:text-blue-400">Primary</flux:badge>
                                    @endif
                                    @if($contact->is_billing_contact)
                                        <flux:badge variant="outline" class="text-green-700 dark:text-green-400">Billing</flux:badge>
                                    @endif
                                    @if($contact->is_technical_contact)
                                        <flux:badge variant="outline" class="text-purple-700 dark:text-purple-400">Technical</flux:badge>
                                    @endif
                                </div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                <div class="flex items-center justify-end space-x-2">
                                    @if(!$contact->is_primary)
                                        <flux:button 
                                            variant="ghost" 
                                            size="sm" 
                                            wire:click="makePrimary({{ $contact->id }})"
                                            title="{{ __('Make Primary Contact') }}">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="h-4 w-4">
                                                <path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z" />
                                                <path d="M12 8v4" />
                                                <path d="M12 16h.01" />
                                            </svg>
                                        </flux:button>
                                    @endif
                                    
                                    <flux:button 
                                        variant="ghost" 
                                        size="sm" 
                                        wire:click="$dispatch('open-modal', {name: 'edit-contact', params: {contact: {{ $contact->id }}}})"
                                        title="{{ __('Edit Contact') }}">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="h-4 w-4">
                                            <path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7" />
                                            <path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z" />
                                        </svg>
                                    </flux:button>
                                    
                                    <flux:button 
                                        variant="ghost" 
                                        size="sm" 
                                        color="red"
                                        wire:click="deleteContact({{ $contact->id }})"
                                        title="{{ __('Delete Contact') }}">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="h-4 w-4">
                                            <path d="M3 6h18" />
                                            <path d="M19 6v14c0 1-1 2-2 2H7c-1 0-2-1-2-2V6" />
                                            <path d="M8 6V4c0-1 1-2 2-2h4c1 0 2 1 2 2v2" />
                                        </svg>
                                    </flux:button>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="px-6 py-12 text-center">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="mx-auto h-12 w-12 text-zinc-400">
                                    <path d="M17 3a2.85 2.83 0 1 1 4 4L7.5 20.5 2 22l1.5-5.5Z" />
                                </svg>
                                <h3 class="mt-2 text-sm font-medium text-foreground">{{ __('No contacts') }}</h3>
                                <p class="mt-1 text-sm text-zinc-500 dark:text-zinc-400">
                                    {{ __('Get started by creating a new contact.') }}</p>
                                <div class="mt-6">
                                    <flux:button
                                        wire:click="$dispatch('open-modal', 'create-contact')"
                                        variant="primary">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="h-4 w-4 mr-2">
                                            <path d="M5 12h14"></path>
                                            <path d="M12 5v14"></path>
                                        </svg>
                                        {{ __('New Contact') }}
                                    </flux:button>
                                </div>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    <!-- Pagination -->
    <div class="mt-6">
        {{ $contacts->links() }}
    </div>

    <!-- Delete Confirmation Modal -->
    <flux:modal name="delete-contact" wire:model="showDeleteModal">
        <div class="space-y-6">
            <div>
                <flux:heading size="lg">{{ __('Delete Contact') }}</flux:heading>
                <flux:text class="mt-2">{{ __('Are you sure you want to delete this contact? This action cannot be undone.') }}</flux:text>
            </div>

            <div class="flex gap-2">
                <flux:spacer />
                <flux:button variant="outline" wire:click="cancelDelete">{{ __('Cancel') }}</flux:button>
                <flux:button variant="danger" wire:click="confirmDelete">{{ __('Delete') }}</flux:button>
            </div>
        </div>
    </flux:modal>
</div>
