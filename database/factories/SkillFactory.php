<?php

declare(strict_types=1);

namespace Database\Factories;

use App\Models\Skill;
use Illuminate\Database\Eloquent\Factories\Factory;

final class SkillFactory extends Factory
{
    protected $model = Skill::class;

    public function definition(): array
    {
        return [
            'name' => fake()->words(2, true),
            'category' => fake()->randomElement(['technical', 'soft', 'management', 'creative', 'finance', 'marketing', 'sales', 'service']),
            'description' => fake()->optional()->sentence(),
        ];
    }
}
