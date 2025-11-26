<?php

declare(strict_types=1);

namespace App\Livewire\Contacts;

use App\Models\Client;
use App\Models\Contact;
use Illuminate\Contracts\View\View;
use Livewire\Component;
use Livewire\WithPagination;

class ContactIndex extends Component
{
    use WithPagination;

    public Client $client;
    public $search = '';
    public $showDeleteModal = false;
    public $contactToDeleteId;

    protected $queryString = ['search'];

    public function mount(Client $client) : void
    {
        $this->client = $client;
    }

    public function render() : View
    {
        $contacts = $this->client->contacts()
            ->where(function($query) {
                $query->where('first_name', 'like', '%' . $this->search . '%')
                      ->orWhere('last_name', 'like', '%' . $this->search . '%')
                      ->orWhere('email', 'like', '%' . $this->search . '%')
                      ->orWhere('position', 'like', '%' . $this->search . '%');
            })
            ->orderBy('is_primary', 'desc')
            ->orderBy('created_at', 'desc')
            ->paginate(10);

        return view('livewire.contacts.contact-index', [
            'contacts' => $contacts
        ]);
    }

    public function deleteContact($id) : void
    {
        $this->contactToDeleteId = $id;
        $this->showDeleteModal = true;
    }

    public function confirmDelete() : void
    {
        $contact = Contact::find($this->contactToDeleteId);

        if ($contact && $contact->client->id === $this->client->id) {
            // If this was the primary contact, update the client
            if ($contact->is_primary) {
                $this->client->update(['primary_contact_id' => null]);
            }

            $contact->delete();
        }

        $this->showDeleteModal = false;
        $this->contactToDeleteId = null;
    }

    public function cancelDelete() : void
    {
        $this->showDeleteModal = false;
        $this->contactToDeleteId = null;
    }

    public function makePrimary($contactId) : void
    {
        $contact = $this->client->contacts()->findOrFail($contactId);

        // Set all other contacts to not primary
        $this->client->contacts()->update(['is_primary' => false]);

        // Set this contact as primary
        $contact->update(['is_primary' => true]);

        // Update client's primary contact
        $this->client->update(['primary_contact_id' => $contactId]);
    }
}