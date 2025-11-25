<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;
use Stancl\Tenancy\Facades\Tenant;
use App\Models\DiscussionAttachment;

class TenantFileController extends Controller
{
    public function download(Request $request, $filename)
    {
        // Check if the user is authenticated
        if (!Auth::check()) {
            abort(403, 'Unauthorized');
        }

        // Verify the file exists in tenant storage by checking the database record first
        $attachment = DiscussionAttachment::where('filename', $filename)->first();
        if (!$attachment) {
            abort(404, 'File not found');
        }

        // Determine the correct storage path for the current tenant
        // With filesystem tenancy, the public disk root is overridden to tenant-specific path
        // So the path is just 'discussions/filename' relative to the public disk root
        $path = 'discussions/' . $filename;

        // Check if the file exists in the public disk (should be tenant-specific due to filesystem tenancy)
        if (!Storage::disk('public')->exists($path)) {
            \Log::error("File not found in tenant public disk: " . $path);
            \Log::error("Current tenant storage path: " . storage_path());
            abort(404, 'File not found in storage');
        }

        // Get the file content
        $fileContent = Storage::disk('public')->get($path);
        $mimeType = Storage::disk('public')->mimeType($path);

        // Return the file content with appropriate headers
        return response($fileContent)
            ->header('Content-Type', $mimeType)
            ->header('Content-Disposition', 'inline; filename="' . basename($path) . '"');
    }
}