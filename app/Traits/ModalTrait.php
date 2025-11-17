<?php

namespace App\Traits;

trait ModalTrait
{
    public $showDeleteModal = false;
    public $showAssignModal = false;
    public $modalType = null;
    public $modalData = [];
    public $selectedItem = null;

    /**
     * Show a modal by type
     */
    public function showModal($type, $data = [], $itemId = null)
    {
        $this->modalType = $type;
        $this->modalData = $data;
        $this->selectedItem = $itemId;
        
        switch($type) {
            case 'delete':
                $this->showDeleteModal = true;
                break;
            case 'assign':
                $this->showAssignModal = true;
                break;
            default:
                // Handle other modal types as needed
                break;
        }
    }

    /**
     * Hide all modals
     */
    public function hideModal()
    {
        $this->showDeleteModal = false;
        $this->showAssignModal = false;
        $this->modalType = null;
        $this->modalData = [];
        $this->selectedItem = null;
    }

    /**
     * Get available items for assignment based on type
     */
    public function getAvailableItems($type, $currentItems, $allItems)
    {
        return $allItems->whereNotIn('id', $currentItems->pluck('id'));
    }
}