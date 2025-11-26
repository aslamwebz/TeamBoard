<?php

namespace App\Livewire\Discussions;

use App\Models\Discussion;
use App\Models\Project;
use App\Models\Task;
use App\Services\ActivityService;
use App\Services\FileUploadService;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\WithFileUploads;

#[Layout('components.layouts.app')]
#[Title('Create Discussion')]
class DiscussionCreate extends Component
{
    use WithFileUploads;

    public $title = '';
    public $content = '';
    public $type = '';
    public $typeId = '';
    public $attachments = [];

    public $projects = [];
    public $tasks = [];

    protected $rules = [
        'title' => 'required|string|max:255',
        'content' => 'required|string',
        'type' => 'required|in:project,task,client',
        'typeId' => 'required|integer',
        'attachments.*' => 'nullable|file|max:10240', // Max 10MB
    ];

    public function mount()
    {
        $this->projects = Project::all();
        $this->tasks = Task::all();
        
        // Set default values if passed via query string
        if (request()->has('type')) {
            $this->type = request('type');
        }
        if (request()->has('type_id')) {
            $this->typeId = request('type_id');
        }
    }

    public function createDiscussion()
    {
        $this->validate();

        $discussion = Discussion::create([
            'title' => $this->title,
            'content' => $this->content,
            'type' => $this->type,
            'type_id' => $this->typeId,
            'project_id' => $this->type === 'project' ? $this->typeId : ($this->type === 'task' ? \App\Models\Task::find($this->typeId)?->project_id : null),
            'user_id' => Auth::id(),
        ]);

        // Process attachments if any
        // Validate that attachments contain valid files before processing
        if (!empty($this->attachments) && is_array($this->attachments)) {
            foreach ($this->attachments as $attachment) {
                if ($attachment && method_exists($attachment, 'getClientOriginalName')) {
                    $this->processAttachment($attachment, $discussion->id, null);
                }
            }
        }

        // Log activity
        $activityService = new ActivityService();
        $activityService->logDiscussionCreated($discussion);

        session()->flash('message', 'Discussion created successfully.');

        return redirect()->route('discussions.show', $discussion);
    }

    private function processAttachment($file, $discussionId, $commentId = null)
    {
        $fileUploadService = new \App\Services\FileUploadService();
        $fileUploadService->upload($file, Auth::id(), $discussionId, $commentId);
    }

    public function updatedAttachments()
    {
        // Validate each attachment as it's added
        $this->validateOnly('attachments.*');
    }

    public function render()
    {
        return view('livewire.discussions.discussion-create');
    }
}