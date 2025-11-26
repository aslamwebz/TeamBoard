<?php

namespace App\Livewire\Workers;

use App\Models\WorkerProfile;
use App\Models\Project;
use App\Models\Task;
use App\Models\Timesheet;
use Livewire\Component;
use Livewire\WithPagination;

class Timesheets extends Component
{
    use WithPagination;

    public $workerId;
    public string $date = '';
    public string $hours_worked = '0.00';
    public string $activity_description = '';
    public string $entry_type = 'regular';
    public string $project_id = '';
    public string $task_id = '';
    public string $status = 'pending';
    public string $notes = '';
    public string $search = '';
    public string $entryTypeFilter = '';
    public string $statusFilter = '';
    public string $startDate = '';
    public string $endDate = '';

    protected $queryString = ['search', 'entryTypeFilter', 'statusFilter', 'startDate', 'endDate'];
    
    protected $rules = [
        'date' => 'required|date',
        'hours_worked' => 'required|numeric|min:0.01|max:24',
        'activity_description' => 'required|string|max:1000',
        'entry_type' => 'required|in:regular,overtime,vacation,sick_leave,holiday',
        'project_id' => 'nullable|exists:projects,id',
        'task_id' => 'nullable|exists:tasks,id',
        'status' => 'required|in:pending,approved,rejected',
        'notes' => 'nullable|string',
    ];

    public function mount($workerId)
    {
        $this->workerId = $workerId;
        $this->date = now()->format('Y-m-d');
    }

    public function addTimesheet()
    {
        $this->validate();

        $timesheet = new Timesheet();
        $timesheet->worker_profile_id = $this->workerId;
        $timesheet->date = $this->date;
        $timesheet->hours_worked = $this->hours_worked;
        $timesheet->activity_description = $this->activity_description;
        $timesheet->entry_type = $this->entry_type;
        $timesheet->project_id = $this->project_id ?: null;
        $timesheet->task_id = $this->task_id ?: null;
        $timesheet->status = $this->status;
        $timesheet->notes = $this->notes;
        $timesheet->save();

        $this->reset(['date', 'hours_worked', 'activity_description', 'entry_type', 'project_id', 'task_id', 'notes']);
        $this->date = now()->format('Y-m-d');
        
        session()->flash('message', 'Timesheet entry added successfully.');
    }

    public function deleteTimesheet($timesheetId)
    {
        $timesheet = Timesheet::find($timesheetId);
        if ($timesheet && $timesheet->worker_profile_id == $this->workerId) {
            $timesheet->delete();
            session()->flash('message', 'Timesheet entry deleted successfully.');
        }
    }

    public function render()
    {
        $query = Timesheet::where('worker_profile_id', $this->workerId)
                         ->with(['project', 'task']);

        // Apply filters
        if ($this->search) {
            $query->where('activity_description', 'like', '%' . $this->search . '%');
        }

        if ($this->entryTypeFilter) {
            $query->where('entry_type', $this->entryTypeFilter);
        }

        if ($this->statusFilter) {
            $query->where('status', $this->statusFilter);
        }

        if ($this->startDate) {
            $query->where('date', '>=', $this->startDate);
        }

        if ($this->endDate) {
            $query->where('date', '<=', $this->endDate);
        }

        $timesheets = $query->orderBy('date', 'desc')->paginate(10);
        
        $projects = Project::orderBy('name')->get();
        $tasks = Task::orderBy('title')->get();
        
        // Calculate totals
        $totalRegularHours = $query->where('entry_type', 'regular')->sum('hours_worked');
        $totalOvertimeHours = $query->where('entry_type', 'overtime')->sum('hours_worked');
        $totalLeaveHours = $query->whereIn('entry_type', ['vacation', 'sick_leave', 'holiday'])->sum('hours_worked');
        $totalHours = $totalRegularHours + $totalOvertimeHours + $totalLeaveHours;

        return view('livewire.workers.worker-timesheets', [
            'timesheets' => $timesheets,
            'projects' => $projects,
            'tasks' => $tasks,
            'totalRegularHours' => $totalRegularHours,
            'totalOvertimeHours' => $totalOvertimeHours,
            'totalLeaveHours' => $totalLeaveHours,
            'totalHours' => $totalHours,
        ]);
    }
}