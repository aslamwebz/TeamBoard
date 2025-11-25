<?php

declare(strict_types=1);

namespace App\Livewire\Contacts;

use App\Models\Contact;
use Livewire\Component;
use Livewire\Attributes\Validate;

class Edit extends Component
{
    public Contact $contact;
    
    #[Validate('required|string|max:255')]
    public string $first_name = '';
    
    #[Validate('required|string|max:255')]
    public string $last_name = '';
    
    #[Validate('required|email|max:255')]
    public string $email = '';
    
    #[Validate('nullable|string|max:255')]
    public string $position = '';
    
    #[Validate('nullable|string|max:255')]
    public string $job_title = '';
    
    #[Validate('nullable|string|max:255')]
    public string $department = '';
    
    #[Validate('nullable|string|max:20')]
    public string $phone = '';
    
    #[Validate('nullable|string|max:20')]
    public string $work_phone = '';
    
    #[Validate('nullable|string|max:20')]
    public string $mobile_phone = '';
    
    #[Validate('nullable|boolean')]
    public bool $is_primary = false;
    
    #[Validate('nullable|boolean')]
    public bool $is_billing_contact = false;
    
    #[Validate('nullable|boolean')]
    public bool $is_technical_contact = false;
    
    #[Validate('nullable|string')]
    public string $notes = '';
    
    public array $communication_preferences = [];

    public function mount(Contact $contact)
    {
        $this->contact = $contact;
        
        $this->first_name = $contact->first_name;
        $this->last_name = $contact->last_name;
        $this->email = $contact->email;
        $this->position = $contact->position;
        $this->job_title = $contact->job_title;
        $this->department = $contact->department;
        $this->phone = $contact->phone;
        $this->work_phone = $contact->work_phone;
        $this->mobile_phone = $contact->mobile_phone;
        $this->is_primary = $contact->is_primary;
        $this->is_billing_contact = $contact->is_billing_contact;
        $this->is_technical_contact = $contact->is_technical_contact;
        $this->notes = $contact->notes ?? '';
        $this->communication_preferences = $contact->communication_preferences ?? [];
    }

    public function save()
    {
        $validated = $this->validate();
        
        // If setting as primary, unset the current primary contact for this client
        if ($validated['is_primary']) {
            $this->contact->client->contacts()->update(['is_primary' => false]);
        }
        
        $this->contact->update($validated);
        
        // If this is the primary contact, update the client record
        if ($validated['is_primary']) {
            $this->contact->client->update(['primary_contact_id' => $this->contact->id]);
        } else if ($this->contact->is_primary && !$validated['is_primary']) {
            // If this was the primary contact and is no longer primary, clear the client's primary contact
            if ($this->contact->client->primary_contact_id === $this->contact->id) {
                $this->contact->client->update(['primary_contact_id' => null]);
            }
        }

        session()->flash('message', 'Contact updated successfully.');
        
        $this->dispatch('contact-updated', contactId: $this->contact->id);
    }

    public function render()
    {
        return view('livewire.contacts.edit');
    }
}