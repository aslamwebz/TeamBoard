<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Models\DiscussionAttachment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

final class FilePreviewController extends Controller
{
    public function preview(Request $request, string $filename): \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
    {
        // Check if the user is authenticated
        if (! Auth::check()) {
            abort(403, 'Unauthorized');
        }

        // Verify the file exists in tenant storage by checking the database record first
        $attachment = DiscussionAttachment::where('filename', $filename)->first();
        if (! $attachment) {
            abort(404, 'File not found');
        }

        // Determine the correct storage path for the current tenant
        $path = 'discussions/'.$filename;

        // Check if file exists in tenant storage
        if (! Storage::disk('public')->exists($path)) {
            abort(404, 'File not found in storage');
        }

        // Get the file content and mime type
        Storage::disk('public')->get($path);
        $mimeType = Storage::disk('public')->mimeType($path);

        // Return a view that displays the file preview with download options
        return view('files.preview', [
            'attachment' => $attachment,
            'path' => $path,
            'mimeType' => $mimeType,
        ]);
    }
}
