<?php

declare(strict_types=1);

namespace App\Livewire\Contacts;

use App\Models\Contact;
use Illuminate\Contracts\View\View;
use Livewire\Component;

final class ContactEdit extends Component
{
    public Contact $contact;

    protected $rules = [
        'contact.first_name' => 'required|string|max:255',
        'contact.last_name' => 'required|string|max:255',
        'contact.email' => 'required|email|max:255|unique:contacts,email',
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

    public function mount(Contact $contact): void
    {
        // Fresh load the contact to ensure all attributes are available
        $this->contact = Contact::find($contact->id);

        // Ensure communication_preferences is initialized as array
        if (! isset($this->contact->communication_preferences) || is_null($this->contact->communication_preferences)) {
            $this->contact->communication_preferences = [];
        }
    }

    public function save(): void
    {
        $this->rules['contact.email'] = 'required|email|max:255|unique:contacts,email,'.$this->contact->id;
        $validated = $this->validate();

        // If setting as primary, unset the current primary contact for this client
        if ($validated['contact']['is_primary']) {
            $this->contact->client->contacts()->update(['is_primary' => false]);
        }

        $this->contact->update($validated['contact']);

        // If this is the primary contact, update the client record
        if ($validated['contact']['is_primary']) {
            $this->contact->client->update(['primary_contact_id' => $this->contact->id]);
        } elseif ($this->contact->is_primary && ! $validated['contact']['is_primary']) {
            // If this was the primary contact and is no longer primary, clear the client's primary contact
            if ($this->contact->client->primary_contact_id === $this->contact->id) {
                $this->contact->client->update(['primary_contact_id' => null]);
            }
        }

        session()->flash('message', 'Contact updated successfully.');

        $this->dispatch('contact-updated', contactId: $this->contact->id);
    }

    public function render(): View
    {
        return view('livewire.contacts.contact-edit');
    }
}
