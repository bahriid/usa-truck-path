<?php

namespace App\Services;

use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Log;

class FileUploadService
{
    /**
     * Upload a file to storage and optionally delete the old file
     *
     * @param UploadedFile $file
     * @param string $directory Directory within the 'public' disk
     * @param string|null $oldFilePath Path to old file to delete (optional)
     * @return string Stored file path
     */
    public function upload(UploadedFile $file, string $directory, ?string $oldFilePath = null): string
    {
        // Delete old file if provided
        if ($oldFilePath) {
            $this->delete($oldFilePath);
        }

        // Store new file
        return $file->store($directory, 'public');
    }

    /**
     * Delete a file from storage
     *
     * @param string $filePath
     * @return bool
     */
    public function delete(string $filePath): bool
    {
        try {
            if ($filePath && Storage::disk('public')->exists($filePath)) {
                return Storage::disk('public')->delete($filePath);
            }

            return false;
        } catch (\Exception $e) {
            Log::error('File deletion error: '.$e->getMessage().' | Path: '.$filePath);

            return false;
        }
    }

    /**
     * Handle multiple file uploads with conditional deletion
     * Useful for updating models with multiple file fields
     *
     * @param array $fileFields Array of file field names to check
     * @param \Illuminate\Http\Request $request
     * @param object $model Model with file paths (optional, for deletion)
     * @param array $directories Map of field names to directory paths
     * @return array Array of [field_name => stored_path]
     */
    public function handleMultipleUploads(array $fileFields, $request, $model = null, array $directories = []): array
    {
        $uploadedFiles = [];

        foreach ($fileFields as $field) {
            if ($request->hasFile($field)) {
                $directory = $directories[$field] ?? 'uploads';
                $oldFilePath = $model && isset($model->$field) ? $model->$field : null;

                $uploadedFiles[$field] = $this->upload(
                    $request->file($field),
                    $directory,
                    $oldFilePath
                );
            }
        }

        return $uploadedFiles;
    }

    /**
     * Delete multiple files from a model
     * Useful when deleting a model with multiple file attachments
     *
     * @param object $model
     * @param array $fileFields Array of field names containing file paths
     * @return void
     */
    public function deleteMultiple($model, array $fileFields): void
    {
        foreach ($fileFields as $field) {
            if (isset($model->$field) && $model->$field) {
                $this->delete($model->$field);
            }
        }
    }

    /**
     * Get file URL for display
     *
     * @param string|null $filePath
     * @return string|null
     */
    public function getUrl(?string $filePath): ?string
    {
        if (!$filePath) {
            return null;
        }

        return Storage::disk('public')->url($filePath);
    }

    /**
     * Check if file exists in storage
     *
     * @param string $filePath
     * @return bool
     */
    public function exists(string $filePath): bool
    {
        return Storage::disk('public')->exists($filePath);
    }
}
