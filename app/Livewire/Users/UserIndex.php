<?php declare(strict_types=1);

namespace App\Livewire\Users;

use App\Models\User;
use Livewire\Component;
use Livewire\WithPagination;

class UserIndex extends Component
{
    use WithPagination;

    public $search = '';
    public $role = 'all';
    public $perPage = 10;

    protected $queryString = [
        'search' => ['except' => ''],
        'role' => ['except' => 'all'],
        'perPage' => ['except' => 10],
    ];

    public function deleteUser($userId)
    {
        $user = User::find($userId);
        if ($user) {
            $user->delete();
            session()->flash('message', 'User deleted successfully.');
        }
    }

    public function render()
    {
        $query = User::query();

        if ($this->search) {
            $query->where(function ($q) {
                $q
                    ->where('name', 'like', '%' . $this->search . '%')
                    ->orWhere('email', 'like', '%' . $this->search . '%');
            });
        }

        if ($this->role === 'with-permissions') {
            $query->whereHas('roles.permissions') // Users with roles that have permissions
                  ->orWhereHas('permissions'); // Or users with direct permissions
        } elseif ($this->role === 'without-permissions') {
            $query->whereDoesntHave('roles.permissions') // Users without roles that have permissions
                  ->whereDoesntHave('permissions'); // And without direct permissions
        }

        $users = $query
            ->with(['projects', 'tasks', 'clients', 'roles.permissions', 'permissions'])
            ->orderBy('name', 'asc')
            ->paginate($this->perPage);

        // Pre-calculate permissions count for each user
        foreach ($users as $user) {
            $user->permissions_count = $user->getAllPermissions()->count();
        }

        return view('livewire.users.index', [
            'users' => $users
        ]);
    }
}
