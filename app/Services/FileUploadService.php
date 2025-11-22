<?php

namespace App\Services;

use App\Models\DiscussionAttachment;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;

class FileUploadService
{
    protected $allowedMimeTypes = [
        // Images
        'image/jpeg',
        'image/png',
        'image/gif',
        'image/webp',
        'image/svg+xml',
        // Documents
        'application/pdf',
        'application/msword',
        'application/vnd.openxmlformats-officedocument.wordprocessingml.document',
        'application/vnd.ms-excel',
        'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet',
        'application/vnd.ms-powerpoint',
        'application/vnd.openxmlformats-officedocument.presentationml.presentation',
        'text/plain',
        'text/csv',
        // Archives
        'application/zip',
        'application/x-rar-compressed',
        'application/x-7z-compressed',
        'application/x-tar',
        'application/gzip',
        // Others
        'application/json',
    ];

    protected $maxFileSize = 10 * 1024 * 1024;  // 10MB in bytes

    public function upload($file, $userId, $discussionId = null, $commentId = null)
    {
        try {
            // Validate file
            if (!$this->isValidFile($file)) {
                throw new \InvalidArgumentException('Invalid file type or size');
            }

            // Generate unique filename
            $originalName = $file->getClientOriginalName();
            $extension = $file->getClientOriginalExtension();
            $filename = uniqid() . '_' . time() . '.' . $extension;

            // Ensure the directory exists
            $directory = 'discussions';
            if (!Storage::disk('public')->exists($directory)) {
                Storage::disk('public')->makeDirectory($directory, 0755, true);
            }

            // Store the file in the public disk
            $path = $file->storeAs($directory, $filename, 'public');

            if (!$path) {
                throw new \Exception('Failed to store file');
            }

            // Create attachment record - store just the filename, not the full path
            $attachment = DiscussionAttachment::create([
                'filename' => $filename,  // Store just the filename
                'original_name' => $originalName,
                'mime_type' => $file->getMimeType(),
                'size' => $file->getSize(),
                'discussion_id' => $discussionId,
                'comment_id' => $commentId,
                'user_id' => $userId,
            ]);

            return $attachment;
        } catch (\Exception $e) {
            \Log::error('File upload failed: ' . $e->getMessage(), [
                'file' => $file->getClientOriginalName(),
                'user_id' => $userId,
                'exception' => $e
            ]);
            throw $e;
        }
    }

    public function isValidFile($file): bool
    {
        if (!$file instanceof UploadedFile) {
            return false;
        }

        // Check file size
        if ($file->getSize() > $this->maxFileSize) {
            return false;
        }

        // Check MIME type
        if (!in_array($file->getMimeType(), $this->allowedMimeTypes)) {
            return false;
        }

        return true;
    }

    public function deleteAttachment(DiscussionAttachment $attachment): bool
    {
        // Delete the physical file from public disk
        $filePath = 'discussions/' . $attachment->filename;
        if (Storage::disk('public')->exists($filePath)) {
            Storage::disk('public')->delete($filePath);
        }

        // Delete the database record
        return $attachment->delete();
    }

    public function getMaxFileSize(): int
    {
        return $this->maxFileSize;
    }

    public function getFormattedMaxFileSize(): string
    {
        $bytes = $this->maxFileSize;
        $units = ['B', 'KB', 'MB', 'GB'];

        for ($i = 0; $bytes > 1024 && $i < count($units) - 1; $i++) {
            $bytes /= 1024;
        }

        return round($bytes, 2) . ' ' . $units[$i];
    }

    public function getAllowedFileTypes(): array
    {
        return $this->allowedMimeTypes;
    }
}
