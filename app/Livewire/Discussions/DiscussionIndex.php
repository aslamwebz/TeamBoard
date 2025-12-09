<?php

declare(strict_types=1);

namespace App\Livewire\Discussions;

use App\Models\Discussion;
use App\Models\Project;
use App\Models\Task;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Component;
use Livewire\WithPagination;

#[Layout('components.layouts.app')]
#[Title('Discussions')]
final class DiscussionIndex extends Component
{
    use WithPagination;

    public $type; // project, task, etc.

    public $typeId;

    public $search = '';

    public $sortBy = 'latest';

    private array $queryString = ['type', 'typeId', 'search', 'sortBy'];

    public function render(): View
    {
        $query = Discussion::with(
            [
                'user',
                'comments',
                'attachments',
            ])
            ->where('title', 'like', '%'.$this->search.'%')
            ->orWhere('content', 'like', '%'.$this->search.'%');

        // Filter by type and type_id if provided
        if ($this->type && $this->typeId) {
            $query->where('type', $this->type)->where('type_id', $this->typeId);
        }

        // Apply sorting
        match ($this->sortBy) {
            'latest' => $query->latest(),
            'oldest' => $query->oldest(),
            'popular' => $query->withCount('comments')->orderBy('comments_count', 'desc'),
            default => $query->latest(),
        };

        $discussions = $query->paginate(10);

        return view('livewire.discussions.discussion-index', ['discussions' => $discussions]);
    }

    public function createDiscussion($type = null, $typeId = null): RedirectResponse
    {
        if ($type && $typeId) {
            return redirect()->route('discussions.create',
                [
                    'type' => $type,
                    'type_id' => $typeId,
                ]);
        }

        return redirect()->route('discussions.create');
    }
}
