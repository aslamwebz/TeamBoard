<?php

declare(strict_types=1);

namespace App\Livewire\Workers;

use App\Models\Project;
use App\Models\Task;
use App\Models\Timesheet;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Livewire\WithPagination;

final class Timesheets extends Component
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

    private array $queryString = ['search', 'entryTypeFilter', 'statusFilter', 'startDate', 'endDate'];

    public function mount(int $workerId): void
    {
        $this->workerId = $workerId;

        // Authorization check
        if (Auth::user()->workerProfile?->id !== $workerId && ! Auth::user()->hasRole(['admin', 'manager'])) {
            abort(403, 'Unauthorized access to timesheets.');
        }

        $this->date = now()->format('Y-m-d');
    }

    public function addTimesheet(): void
    {
        if (Auth::user()->workerProfile?->id !== $this->workerId && ! Auth::user()->hasRole(['admin', 'manager'])) {
            abort(403, 'Unauthorized access to timesheets.');
        }

        if (! Auth::user()->hasRole(['admin', 'manager'])) {
            $this->status = 'pending';
        }

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

        $this->reset([
            'date',
            'hours_worked',
            'activity_description',
            'entry_type',
            'project_id',
            'task_id',
            'notes',
        ]);
        $this->date = now()->format('Y-m-d');

        session()->flash('message', 'Timesheet entry added successfully.');
    }

    public function deleteTimesheet(int $timesheetId): void
    {
        $timesheet = Timesheet::findOrFail($timesheetId);

        $this->authorize('delete', $timesheet);

        if ($timesheet->worker_profile_id === $this->workerId) {
            $timesheet->delete();
            session()->flash('message', 'Timesheet entry deleted successfully.');
        }
    }

    public function render(): View
    {
        $query = Timesheet::where('worker_profile_id', $this->workerId)
            ->with(['project', 'task']);

        // Apply filters
        if ($this->search !== '' && $this->search !== '0') {
            $query->where('activity_description', 'like', '%'.$this->search.'%');
        }

        if ($this->entryTypeFilter !== '' && $this->entryTypeFilter !== '0') {
            $query->where('entry_type', $this->entryTypeFilter);
        }

        if ($this->statusFilter !== '' && $this->statusFilter !== '0') {
            $query->where('status', $this->statusFilter);
        }

        if ($this->startDate !== '' && $this->startDate !== '0') {
            $query->where('date', '>=', $this->startDate);
        }

        if ($this->endDate !== '' && $this->endDate !== '0') {
            $query->where('date', '<=', $this->endDate);
        }

        $timesheets = $query->orderBy('date', 'desc')->paginate(10);

        $projects = Project::select('id', 'name')->orderBy('name')->limit(100)->get();
        $tasks = Task::select('id', 'title')->orderBy('title')->limit(100)->get();

        // Calculate totals with cloned queries
        $totalRegularHours = (clone $query)->where('entry_type', 'regular')->sum('hours_worked');
        $totalOvertimeHours = (clone $query)->where('entry_type', 'overtime')->sum('hours_worked');
        $totalLeaveHours = (clone $query)->whereIn('entry_type', ['vacation', 'sick_leave', 'holiday'])->sum('hours_worked');
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

    protected function rules(): array
    {
        return [
            'date' => 'required|date',
            'hours_worked' => 'required|numeric|min:0.01|max:24',
            'activity_description' => 'required|string|max:1000',
            'entry_type' => 'required|in:regular,overtime,vacation,sick_leave,holiday',
            'project_id' => 'nullable|exists:projects,id',
            'task_id' => 'nullable|exists:tasks,id',
            'status' => 'required|in:pending,approved,rejected',
            'notes' => 'nullable|string',
        ];
    }
}
