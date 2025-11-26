<?php

namespace App\Livewire\Teams;

use App\Models\Team;
use Illuminate\Contracts\View\View;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Component;
use Livewire\WithPagination;

#[Layout('components.layouts.app')]
#[Title('Teams')]
class TeamIndex extends Component
{
    use WithPagination;

    public $search = '';
    public $showDeleteModal = false;
    public $confirmingDelete = false;
    public $teamToDeleteId;

    protected $queryString = ['search'];

    public function render() : View
    {
        $teams = Team::query()
            ->where(function ($query) {
                $query
                    ->where('name', 'like', '%' . $this->search . '%')
                    ->orWhere('description', 'like', '%' . $this->search . '%');
            })
            ->with(['users', 'projects', 'clients'])
            ->orderBy('name')
            ->paginate(10);

        return view('livewire.teams.team-index', [
            'teams' => $teams,
        ]);
    }

    public function confirmDelete($teamId) : void
    {
        $this->teamToDeleteId = $teamId;
        $this->confirmingDelete = true;
        $this->showDeleteModal = true;
    }

    public function delete() : void
    {
        $team = Team::findOrFail($this->teamToDeleteId);
        $team->delete();

        $this->showDeleteModal = false;
        $this->confirmingDelete = false;
        $this->teamToDeleteId = null;

        session()->flash('message', 'Team deleted successfully.');
    }

    public function cancelDelete() : void
    {
        $this->showDeleteModal = false;
        $this->confirmingDelete = false;
        $this->teamToDeleteId = null;
    }
}
