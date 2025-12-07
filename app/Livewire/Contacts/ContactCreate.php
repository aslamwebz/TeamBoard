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

    protected $rules = [
        'contact.first_name' => 'required|string|max:255',
        'contact.last_name' => 'required|string|max:255',
        'contact.email' => 'required|email|max:255',
        'contact.position' => 'nullable|string|max:255',
        'contact.job_title' => 'nullable|string|max:255',
        'contact.department' => 'nullable|string|max:255',
        'contact.phone' => 'nullable|string|max:20',
        'contact.work_phone' => 'nullable|string|max:20',
        'contact.mobile_phone' => 'nullable|string|max:20',
        'contact.is_primary' => 'nullable|boolean',
        'contact.is_billing_contact' => 'nullable|boolean',
        'contact.is_technical_contact' => 'nullable|boolean',
        'contact.notes' => 'nullable|string',
        'contact.communication_preferences' => 'nullable|array',
    ];

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
