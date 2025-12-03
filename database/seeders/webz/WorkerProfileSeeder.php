<?php declare(strict_types=1);

namespace Database\Seeders\webz;

use App\Models\User;
use App\Models\WorkerProfile;
use Illuminate\Database\Seeder;

final class WorkerProfileSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $users = User::all();

        if ($users->isEmpty()) {
            $this->command->warn('No users found. Please run UserSeeder first.');

            return;
        }

        foreach ($users as $user) {
            WorkerProfile::factory()->create([
                'user_id' => $user->id,
                'employee_id' => 'EMP000-' . $user->id,
            ]);
        }
    }
}
