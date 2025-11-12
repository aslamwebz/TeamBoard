<?php

namespace App\Livewire;

use Livewire\Component;
use Illuminate\Support\Facades\Route;

class NavigationHandler extends Component
{
    /**
     * Preload the given URL when hovering over a navigation item
     */
    public function navigatingTo($url)
    {
        // This method is called when hovering over a navigation item
        // The actual preloading is handled by the wire:navigate.hover directive
        return true;
    }

    /**
     * Get all navigation routes for preloading
     */
    public function getNavigationRoutes()
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
        return <<<'blade'
            <div>
                @push('head')
                    @foreach($this->getNavigationRoutes() as $route)
                        <link rel="prefetch" href="{{ $route }}" as="document" />
                    @endforeach
                @endpush
            </div>
        blade;
    }
}
