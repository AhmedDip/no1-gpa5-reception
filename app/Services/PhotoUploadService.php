<?php
// app/Services/PhotoUploadService.php

namespace App\Services;

use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;

class PhotoUploadService
{
    /**
     * Store an uploaded photo using the convention:
     * {folder}/{Y-m-d}/{mobile}.{extension}
     *
     * Example: students/photos/2026-07-02/01712345678.jpg
     */
    public function store(UploadedFile $file, string $mobile, string $folder): string
    {
        $date      = now()->format('Y-m-d');
        $extension = strtolower($file->getClientOriginalExtension() ?: $file->extension());
        $mobile    = preg_replace('/[^0-9]/', '', $mobile); // safety: digits only in filename

        $filename = "{$mobile}.{$extension}";
        $path     = "{$folder}/{$date}";

        // storeAs overwrites if same name already exists in that folder (same day re-upload)
        return $file->storeAs($path, $filename, 'public');
    }

    /**
     * Delete a previously stored photo if it exists.
     */
    public function delete(?string $path): void
    {
        if ($path && Storage::disk('public')->exists($path)) {
            Storage::disk('public')->delete($path);
        }
    }
}
