<?php

namespace App\Livewire\Discussions;

use App\Models\Discussion;
use App\Models\Project;
use App\Models\ProjectPhase;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\WithFileUploads;

#[Layout('components.layouts.app')]
#[Title('Edit Discussion')]
class DiscussionEdit extends Component
{
    use WithFileUploads;

    public Discussion $discussion;
    public $title;
    public $content;
    public $type;
    public $typeId;
    public $projectPhaseId;
    public $attachments = [];

    public $projects = [];
    public $phases = [];
    public $users = [];

    protected $rules = [
        'title' => 'required|string|max:255',
        'content' => 'required|string',
        'type' => 'required|in:project,task,client',
        'typeId' => 'required|integer',
        'projectPhaseId' => 'nullable|exists:project_phases,id',
        'attachments.*' => 'nullable|file|max:10240', // Max 10MB
    ];

    public function mount(Discussion $discussion)
    {
        $this->discussion = $discussion->load(['project', 'user', 'phase', 'attachments']);
        $this->title = $discussion->title;
        $this->content = $discussion->content;
        $this->type = $discussion->type;
        $this->typeId = $discussion->type_id;
        $this->projectPhaseId = $discussion->project_phase_id;

        $this->projects = Project::all();
        
        // Load phases for the current project
        if ($discussion->type === 'project' && $discussion->type_id) {
            $this->phases = ProjectPhase::where('project_id', $discussion->type_id)->get();
        }
        
        $this->users = User::all();
    }

    public function updateDiscussion()
    {
        $validatedData = $this->validate();

        $this->discussion->update([
            'title' => $this->title,
            'content' => $this->content,
            'type' => $this->type,
            'type_id' => $this->typeId,
            'project_phase_id' => $this->projectPhaseId,
        ]);

        // Process attachments if any
        foreach ($this->attachments as $attachment) {
            $fileUploadService = new \App\Services\FileUploadService();
            $fileUploadService->upload($attachment, Auth::id(), $this->discussion->id, null);
        }

        session()->flash('message', 'Discussion updated successfully.');

        return redirect()->route('discussions.show', $this->discussion);
    }

    public function updatedTypeId()
    {
        // When type ID changes (e.g., project changes), reload phases
        if ($this->type === 'project' && $this->typeId) {
            $this->phases = ProjectPhase::where('project_id', $this->typeId)->get();
            $this->projectPhaseId = null; // Reset phase selection
        }
    }

    public function render()
    {
        return view('livewire.discussions.edit');
    }
}