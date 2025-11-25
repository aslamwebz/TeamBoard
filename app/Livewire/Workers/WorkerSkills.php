<?php

namespace App\Livewire\Workers;

use App\Models\WorkerProfile;
use App\Models\Skill;
use Livewire\Component;

class WorkerSkills extends Component
{
    public $workerId;
    public $selectedSkills = [];
    public $proficiency = [];
    public $notes = [];

    public function mount($workerId)
    {
        $this->workerId = $workerId;
        $this->loadSkills();
    }

    public function loadSkills()
    {
        $worker = WorkerProfile::with('skills')->find($this->workerId);
        $this->selectedSkills = $worker->skills->pluck('id')->toArray();
        
        foreach ($worker->skills as $skill) {
            $this->proficiency[$skill->id] = $skill->pivot->proficiency_level;
            $this->notes[$skill->id] = $skill->pivot->notes ?? '';
        }
    }

    public function updateSkills()
    {
        $worker = WorkerProfile::find($this->workerId);
        
        // Prepare skills with their pivot data
        $skillsData = [];
        foreach ($this->selectedSkills as $skillId) {
            $skillsData[$skillId] = [
                'proficiency_level' => $this->proficiency[$skillId] ?? 1,
                'notes' => $this->notes[$skillId] ?? '',
            ];
        }
        
        // Sync the skills with pivot data
        $worker->skills()->sync($skillsData);
        
        $this->dispatch('skills-updated');
        session()->flash('message', 'Skills updated successfully.');
    }

    public function removeSkill($skillId)
    {
        $worker = WorkerProfile::find($this->workerId);
        $worker->skills()->detach($skillId);
        $this->loadSkills();
    }

    public function render()
    {
        $worker = WorkerProfile::with('skills', 'skills.workerSkills')->find($this->workerId);
        $allSkills = Skill::orderBy('name')->get();
        
        return view('livewire.workers.worker-skills', [
            'worker' => $worker,
            'allSkills' => $allSkills,
        ]);
    }
}