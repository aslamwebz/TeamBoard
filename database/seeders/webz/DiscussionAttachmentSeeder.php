<?php

declare(strict_types=1);

namespace Database\Seeders\webz;

use App\Models\DiscussionAttachment;
use Illuminate\Database\Seeder;

final class DiscussionAttachmentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Create random discussion attachments using factory
        DiscussionAttachment::factory()->count(40)->create();
    }
}
