<?php

namespace App\Livewire;

use Livewire\Component;
use Illuminate\Support\Facades\Route;

class NavigationHandler extends Component
{
    /**
     * Preload the given URL when hovering over a navigation item
     */
    public function navigatingTo($url): bool
    {
        // This method is called when hovering over a navigation item
        // The actual preloading is handled by the wire:navigate.hover directive
        return true;
    }

    /**
     * Get all navigation routes for preloading
     */
    public function getNavigationRoutes(): array
    {
        return [
            route('dashboard'),
            route('projects'),
            route('tasks'),
            route('users'),
            route('billing'),
            route('features'),
            route('pricing'),
        ];
    }

    public function render()
    {
        return view('livewire.navigation-handler');
    }
}
