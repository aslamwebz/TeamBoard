<?php

namespace App\Http\Controllers;

use App\Models\DiscussionAttachment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Vish4395\LaravelFileViewer\LaravelFileViewer;

class FilePreviewPageController extends Controller
{
    public function show(Request $request, $filename)
    {
        // Get the file from the database
        $attachment = DiscussionAttachment::where('filename', $filename)->firstOrFail();

        // In a tenant environment with filesystem tenancy, verify the file exists
        $path = 'discussions/' . $filename;

        // Debug logging to help troubleshoot
        \Log::info("Attempting to access file: " . $path);
        \Log::info("Storage path (public disk): " . storage_path('app/public/' . $path));
        \Log::info("Tenant-specific storage exists: " . (Storage::disk('public')->exists($path) ? 'YES' : 'NO'));

        // Verify the file exists in the public disk (which should be tenant-specific due to filesystem tenancy)
        if (!Storage::disk('public')->exists($path)) {
            \Log::error("File not found: " . $path);
            abort(404, 'File not found in storage');
        }

        // The file path for LaravelFileViewer should be relative to the storage disk
        // Since we're using public disk, the path should be 'discussions/' . $filename
        $filePath = 'discussions/' . $filename;

        // Use the attachment's getUrl method which handles tenant-specific URLs properly
        $fileUrl = $attachment->getUrl();

        // Debug logging
        \Log::info("Serving file with URL: " . $fileUrl);

        // Use the LaravelFileViewer package to get the appropriate preview
        $previewView = LaravelFileViewer::show(
            $attachment->original_name,
            $filePath,
            $fileUrl,
            'public'
        );

        // Return the preview view directly
        return $previewView;
    }
}