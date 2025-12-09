<?php

declare(strict_types=1);

namespace App\Traits;

trait ModalTrait
{
    public $showDeleteModal = false;

    public $showAssignModal = false;

    public $modalType;

    public $modalData = [];

    public $selectedItem;

    /**
     * Show a modal by type
     */
    public function showModal($type, $data = [], $itemId = null): void
    {
        $this->modalType = $type;
        $this->modalData = $data;
        $this->selectedItem = $itemId;

        switch ($type) {
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
    public function hideModal(): void
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
