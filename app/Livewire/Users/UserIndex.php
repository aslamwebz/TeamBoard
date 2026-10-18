<?php

declare(strict_types=1);

namespace App\Livewire\Users;

use App\Models\User;
use Illuminate\Contracts\View\View;
use Livewire\Component;
use Livewire\WithPagination;

final class UserIndex extends Component
{
    use WithPagination;

    public $search = '';

    public $role = 'all';

    public $perPage = 10;

    private array $queryString = [
        'search' => ['except' => ''],
        'role' => ['except' => 'all'],
        'perPage' => ['except' => 10],
    ];

    public function deleteUser($userId): void
    {
        $user = User::findOrFail($userId);
        $this->authorize('delete', $user);

        $user->delete();
        session()->flash('message', 'User deleted successfully.');
    }

    public function render(): View
    {
        $query = User::query();

        if ($this->search) {
            $query->where(function ($q): void {
                $q
                    ->where('name', 'like', '%'.$this->search.'%')
                    ->orWhere('email', 'like', '%'.$this->search.'%');
            });
        }

        if ($this->role === 'with-permissions') {
            $query
                ->whereHas('roles.permissions')  // Users with roles that have permissions
                ->orWhereHas('permissions');  // Or users with direct permissions
        } elseif ($this->role === 'without-permissions') {
            $query
                ->whereDoesntHave('roles.permissions')  // Users without roles that have permissions
                ->whereDoesntHave('permissions');  // And without direct permissions
        }

        $users = $query
            ->withCount(['projects', 'tasks', 'clients'])
            ->with(['roles.permissions', 'permissions'])
            ->selectRaw('users.*,
                (SELECT COUNT(*) FROM projects 
                 INNER JOIN user_projects ON projects.id = user_projects.project_id 
                 WHERE user_projects.user_id = users.id AND projects.status IN ("planning", "in_progress")) as active_projects,
                (SELECT COUNT(*) FROM tasks 
                 INNER JOIN user_tasks ON tasks.id = user_tasks.task_id 
                 WHERE user_tasks.user_id = users.id AND tasks.status = "completed") as completed_tasks')
            ->orderBy('name', 'asc')
            ->paginate($this->perPage);

        // Pre-calculate permissions count from eager-loaded relations to avoid N+1 queries
        foreach ($users as $user) {
            $user->setAttribute('permissions_count', $user->roles->flatMap->permissions->merge($user->permissions)->unique('id')->count());
        }

        return view('livewire.users.user-index', [
            'users' => $users,
        ]);
    }
}
