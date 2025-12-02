<?php

declare(strict_types=1);

namespace Database\Seeders\webz;

use App\Models\Note;
use Illuminate\Database\Seeder;

final class NoteSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Create random notes using factory
        Note::factory()->count(30)->create();
    }
}
