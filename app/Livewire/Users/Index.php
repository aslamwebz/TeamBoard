<?php declare(strict_types=1);

namespace App\Livewire\Users;

use App\Models\User;
use Livewire\Component;
use Livewire\WithPagination;

class Index extends Component
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

        if ($this->role !== 'all') {
            // Add role filtering when role system is implemented
        }

        $users = $query
            ->with(['projects', 'tasks', 'clients'])
            ->orderBy('name', 'asc')
            ->paginate($this->perPage);

        return view('livewire.users.index', [
            'users' => $users
        ]);
    }
}
