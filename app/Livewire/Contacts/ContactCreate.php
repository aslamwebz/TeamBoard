<?php

declare(strict_types=1);

namespace App\Livewire\Contacts;

use App\Models\Client;
use App\Models\Contact;
use Illuminate\Contracts\View\View;
use Livewire\Component;

final class ContactCreate extends Component
{
    public Client $client;

    public Contact $contact;

    public function mount(Client $client): void
    {
        $this->client = $client;
        $this->contact = new Contact();

        // Ensure communication_preferences is initialized as array
        $this->contact->communication_preferences = [];
    }

    public function save(): void
    {
        $validated = $this->validate();

        // If setting as primary, unset the current primary contact
        if ($validated['contact']['is_primary']) {
            $this->client->contacts()->update(['is_primary' => false]);
        }

        $contact = $this->client->contacts()->create($validated['contact']);

        // If this is the primary contact, update the client record
        if ($validated['contact']['is_primary']) {
            $this->client->update(['primary_contact_id' => $contact->id]);
        }

        session()->flash('message', 'Contact created successfully.');

        // Reset form
        $this->contact = new Contact();

        $this->dispatch('contact-created', contactId: $contact->id);
    }

    public function render(): View
    {
        return view('livewire.contacts.contact-create');
    }
}
