<?php declare(strict_types=1);

namespace App\Livewire\Users;

use App\Models\User;
use Illuminate\Contracts\View\View;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Component;

#[Layout('components.layouts.app')]
#[Title('User Details')]
class UserShow extends Component
{
    public User $user;
    public string $activeTab = 'projects';

    public function mount(User $user) : void
    {
        $this->user = $user;
    }

    public function changeTab($tab) : void
    {
        $this->activeTab = $tab;
    }

    public function render() : View
    {
        // Load related data to prevent lazy loading
        $this->user->load(['roles.permissions', 'permissions']);

        // Get all permissions for the user (direct + from roles)
        $userPermissions = $this->user->getAllPermissions();
        $userPermissionsCount = $userPermissions->count();

        return view('livewire.users.user-show', [
            'userPermissions' => $userPermissions,
            'userPermissionsCount' => $userPermissionsCount
        ]);
    }
}
