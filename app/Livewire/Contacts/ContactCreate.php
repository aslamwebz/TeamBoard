<?php

declare(strict_types=1);

namespace App\Livewire\Contacts;

use App\Models\Client;
use App\Models\Contact;
use Livewire\Component;
use Livewire\Attributes\Validate;

class ContactCreate extends Component
{
    public Client $client;
    
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

    public function mount(Client $client)
    {
        $this->client = $client;
    }

    public function save()
    {
        $validated = $this->validate();
        
        // If setting as primary, unset the current primary contact
        if ($validated['is_primary']) {
            $this->client->contacts()->update(['is_primary' => false]);
        }
        
        $contact = $this->client->contacts()->create($validated);
        
        // If this is the primary contact, update the client record
        if ($validated['is_primary']) {
            $this->client->update(['primary_contact_id' => $contact->id]);
        }

        session()->flash('message', 'Contact created successfully.');
        
        // Reset form
        $this->resetExcept('client');
        
        $this->dispatch('contact-created', contactId: $contact->id);
    }

    public function render()
    {
        return view('livewire.contacts.create');
    }
}