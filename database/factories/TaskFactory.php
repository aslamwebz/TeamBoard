<?php

namespace Database\Factories;

use App\Models\Project;
use App\Models\ProjectPhase;
use App\Models\Task;
use Illuminate\Database\Eloquent\Factories\Factory;

class TaskFactory extends Factory
{
    protected $model = Task::class;

    public function definition(): array
    {
        return [
            'title' => fake()->sentence(3),
            'description' => fake()->optional()->paragraph(),
            'status' => fake()->randomElement(['todo', 'in_progress', 'completed', 'on_hold']),
            'due_date' => fake()->optional()->date(),
            'project_id' => Project::factory(),
            'project_phase_id' => ProjectPhase::factory(),
            'dependencies' => json_encode([]), // Make sure this is always a valid JSON array
            'order' => fake()->numberBetween(1, 100), // Always provide a default order
        ];
    }

    public function withProject(Project $project): static
    {
        return $this->state(fn (array $attributes) => [
            'project_id' => $project->id,
        ]);
    }

    public function withPhase(ProjectPhase $phase): static
    {
        return $this->state(fn (array $attributes) => [
            'project_phase_id' => $phase->id,
        ]);
    }

    public function withDependencies(array $dependencies): static
    {
        return $this->state(fn (array $attributes) => [
            'dependencies' => json_encode($dependencies),
        ]);
    }
}