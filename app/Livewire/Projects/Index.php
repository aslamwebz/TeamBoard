<?php declare(strict_types=1);

namespace App\Livewire\Projects;

use App\Models\Project;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Component;
use Livewire\WithPagination;

#[Layout('components.layouts.app')]
#[Title('Projects')]
class Index extends Component
{
    use WithPagination;

    public $search = '';
    public $statusFilter = '';
    public $showDeleteModal = false;
    public $projectToDeleteId;

    protected $queryString = ['search', 'statusFilter'];

    public function render()
    {
        $projects = Project::query()
            ->with(['client', 'tasks', 'users'])
            ->where('name', 'like', '%' . $this->search . '%')
            ->when($this->statusFilter, function ($query) {
                $query->where('status', $this->statusFilter);
            })
            ->paginate(9);

        return view('livewire.projects.index', [
            'projects' => $projects
        ]);
    }

    public function deleteProject($id)
    {
        $this->projectToDeleteId = $id;
        $this->showDeleteModal = true;
    }

    public function confirmDelete()
    {
        $project = Project::find($this->projectToDeleteId);
        if ($project) {
            $project->delete();
        }

        $this->showDeleteModal = false;
        $this->projectToDeleteId = null;
    }

    public function cancelDelete()
    {
        $this->showDeleteModal = false;
        $this->projectToDeleteId = null;
    }

    public function updateStatusFilter($status)
    {
        $this->statusFilter = $status;
        $this->resetPage();
    }
}
