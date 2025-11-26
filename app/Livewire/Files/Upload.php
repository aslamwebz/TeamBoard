<?php

namespace App\Livewire\Files;

use App\Models\Discussion;
use App\Models\Project;
use App\Models\Task;
use App\Services\FileUploadService;
use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Component;
use Livewire\WithFileUploads;

#[Layout('components.layouts.app')]
#[Title('Upload Files')]
class Upload extends Component
{
    use WithFileUploads;

    public $files = [];
    public $type = null;  // project, task, discussion, client
    public $typeId = null;
    public $projectId = null;
    public $projects = [];
    public $tasks = [];
    public $discussions = [];
    public $clients = [];

    protected $rules = [
        'files.*' => 'required|file|max:10240|mimes:jpeg,png,gif,webp,svg,pdf,doc,docx,xls,xlsx,ppt,pptx,txt,csv,zip,rar,7z',
        'type' => 'required|in:project,task,discussion,client,general',
        'typeId' => 'nullable|integer',  // Make optional for general files
        'projectId' => 'nullable|integer',
    ];

    public function mount(): void
    {
        // Set default values if passed via query parameters
        if (request()->has('type')) {
            $this->type = request('type');
        }
        if (request()->has('type_id')) {
            $this->typeId = request('type_id');
        }
        if (request()->has('project_id')) {
            $this->projectId = request('project_id');
        }

        $this->loadData();
    }

    public function uploadFiles(): \Illuminate\Http\RedirectResponse
    {
        try {
            // Validate the non-file fields first
            $this->validate([
                'type' => 'required|in:project,task,discussion,client,general',
                'typeId' => 'nullable|integer',  // Make optional for general files
                'projectId' => 'nullable|integer',
            ]);




            // Validate files only if they exist to avoid temporary file issues
            if (!empty($this->files)) {
                $this->validate([
                    'files.*' => 'file|max:10240|mimes:jpeg,png,gif,webp,svg,pdf,doc,docx,xls,xlsx,ppt,pptx,txt,csv,zip,rar,7z'
                ]);
            }

            if (empty($this->files)) {
                throw new \Exception('No files selected for upload.');
            }


            $fileUploadService = new \App\Services\FileUploadService();
            $discussionId = null;
            $successCount = 0;
            $errorMessages = [];

            // Determine where to attach the files based on type
            if ($this->type === 'discussion' && $this->typeId) {
                $discussion = Discussion::find($this->typeId);
                if (!$discussion) {
                    throw new \Exception('Discussion not found.');
                }
                $discussionId = $discussion->id;
            } elseif ($this->type === 'task' && $this->typeId) {
                // Find the discussion related to this task
                $task = Task::find($this->typeId);
                if (!$task) {
                    throw new \Exception('Task not found.');
                }

                // Find or create a discussion for this task
                $discussion = Discussion::firstOrCreate([
                    'type' => 'task',
                    'type_id' => $task->id,
                    'project_id' => $task->project_id,
                ], [
                    'title' => "Discussions for task: {$task->title}",
                    'content' => "General discussion thread for task: {$task->title}",
                    'user_id' => Auth::id(),
                ]);

                $discussionId = $discussion->id;
            } elseif ($this->type === 'project' && $this->typeId) {
                $project = Project::find($this->typeId);
                if (!$project) {
                    throw new \Exception('Project not found.');
                }

                $discussion = Discussion::firstOrCreate([
                    'type' => 'project',
                    'type_id' => $project->id,
                    'project_id' => $project->id,
                ], [
                    'title' => "Files for project: {$project->name}",
                    'content' => "File attachments for project: {$project->name}",
                    'user_id' => Auth::id(),
                ]);

                $discussionId = $discussion->id;
            } elseif ($this->type === 'client' && $this->typeId) {
                $client = \App\Models\Client::find($this->typeId);
                if (!$client) {
                    throw new \Exception('Client not found.');
                }

                $discussion = Discussion::firstOrCreate([
                    'type' => 'client',
                    'type_id' => $client->id,
                    'project_id' => null,
                ], [
                    'title' => "Files for client: {$client->name}",
                    'content' => "File attachments for client: {$client->name}",
                    'user_id' => Auth::id(),
                ]);

                $discussionId = $discussion->id;
            } elseif ($this->type === 'general') {
                // For general files, don't associate with any specific entity
                $discussionId = null;
            } else {
                throw new \Exception('Invalid upload target specified.');
            }

            // Process each file
            if (!empty($this->files)) {
                foreach ($this->files as $file) {
                    if ($file && method_exists($file, 'getClientOriginalName')) {
                        try {
                            $fileUploadService->upload($file, Auth::id(), $discussionId, null);
                            $successCount++;
                        } catch (\Exception $e) {
                            $errorMessages[] = 'Failed to upload ' . $file->getClientOriginalName() . ': ' . $e->getMessage();
                            \Log::error('File upload failed', [
                                'file' => $file->getClientOriginalName(),
                                'error' => $e->getMessage(),
                                'trace' => $e->getTraceAsString()
                            ]);
                        }
                    }
                }
            }

            // Set success/error messages
            if ($successCount > 0) {
                session()->flash('success', "Successfully uploaded {$successCount} file(s).");
            }

            if (!empty($errorMessages)) {
                $this->addError('upload', implode(' ', $errorMessages));
                session()->flash('error', 'Some files failed to upload. Please check the errors below.');
            }

            // Reset the form on successful upload
            if (empty($errorMessages)) {
                $this->reset(['files']);
            }

            // Redirect back to appropriate location
            if ($this->type === 'discussion' && $this->typeId) {
                return redirect()->route('discussions.show', $this->typeId);
            } elseif ($this->type === 'task' && $this->typeId) {
                return redirect()->route('tasks.show', $this->typeId);
            } elseif ($this->type === 'project' && $this->typeId) {
                return redirect()->route('projects.show', $this->typeId);
            }

            return redirect()->route('files.index');
        } catch (\Exception $e) {
            \Log::error('Upload error: ' . $e->getMessage(), [
                'exception' => $e,
                'trace' => $e->getTraceAsString()
            ]);

            $this->addError('upload', 'An error occurred: ' . $e->getMessage());
            session()->flash('error', 'An error occurred while uploading files: ' . $e->getMessage());

            return back()->withInput();
        }
    }

    public function updatedType(): void
    {
        $this->typeId = null;
        $this->loadData();
    }

    protected function loadData(): void
    {
        $this->projects = [];
        $this->tasks = [];
        $this->discussions = [];
        $this->clients = [];

        if ($this->type === 'project') {
            $this->projects = Project::orderBy('name')->get();
        } elseif ($this->type === 'task') {
            $this->tasks = Task::when($this->projectId, function ($query) {
                $query->where('project_id', $this->projectId);
            })->orderBy('title')->get();
        } elseif ($this->type === 'discussion') {
            $this->discussions = Discussion::when($this->projectId, function ($query) {
                $query->where('project_id', $this->projectId);
            })->orderBy('title')->get();
        } elseif ($this->type === 'client') {
            $this->clients = \App\Models\Client::orderBy('name')->get();
        }
    }

    public function render(): \Illuminate\Contracts\View\View
    {
        return view('livewire.files.upload', [
            'projects' => Project::orderBy('name')->get(),
            'tasks' => $this->type === 'task' && $this->projectId
                ? Task::where('project_id', $this->projectId)->orderBy('title')->get()
                : collect(),
            'discussions' => $this->type === 'discussion' && $this->projectId
                ? Discussion::where('project_id', $this->projectId)->orderBy('title')->get()
                : collect(),
        ]);
    }

    public function updatedFiles(): void
    {
        // Don't validate files immediately to prevent temporary file metadata issues
        // Validation will happen during upload
    }
}
