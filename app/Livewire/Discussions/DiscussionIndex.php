<?php

namespace App\Livewire\Discussions;

use App\Models\Discussion;
use App\Models\Project;
use App\Models\Task;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\WithPagination;

#[Layout('components.layouts.app')]
#[Title('Discussions')]
class DiscussionIndex extends Component
{
    use WithPagination;

    public $type = null; // project, task, etc.
    public $typeId = null;
    public $search = '';
    public $sortBy = 'latest';
    
    protected $queryString = ['type', 'typeId', 'search', 'sortBy'];

    public function render()
    {
        $query = Discussion::with(['user', 'comments', 'attachments'])
            ->where('title', 'like', '%' . $this->search . '%')
            ->orWhere('content', 'like', '%' . $this->search . '%');

        // Filter by type and type_id if provided
        if ($this->type && $this->typeId) {
            $query->where('type', $this->type)->where('type_id', $this->typeId);
        }

        // Apply sorting
        switch ($this->sortBy) {
            case 'latest':
                $query->latest();
                break;
            case 'oldest':
                $query->oldest();
                break;
            case 'popular':
                $query->withCount('comments')->orderBy('comments_count', 'desc');
                break;
            default:
                $query->latest();
                break;
        }

        $discussions = $query->paginate(10);

        return view('livewire.discussions.discussion-index', compact('discussions'));
    }

    public function createDiscussion($type = null, $typeId = null)
    {
        if ($type && $typeId) {
            return redirect()->route('discussions.create', ['type' => $type, 'type_id' => $typeId]);
        }
        
        return redirect()->route('discussions.create');
    }
}