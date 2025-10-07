<?php

namespace Modules\Core\Helpers;

use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;

class File
{
  /**
   * Upload a single file to storage.
   *
   * @param UploadedFile $file
   * @param string $path Storage directory (e.g., 'public/uploads')
   * @param string|null $disk Storage disk (default: 'public')
   * @param string|null $filename Optional custom filename (with extension)
   * @return string The stored file path
   */
  public static function uploadSingle(UploadedFile $file, string $path, ?string $disk = 'public', ?string $filename = null): string
  {
    $filename = $filename ?? self::generateFilename($file);

    return $file->storeAs($path, $filename, $disk);
  }

  /**
   * Upload multiple files to storage.
   *
   * @param UploadedFile[] $files
   * @param string $path Storage directory (e.g., 'public/uploads')
   * @param string|null $disk Storage disk (default: 'public')
   * @return array Array of stored file paths
   */
  public static function uploadMultiple(array $files, string $path, ?string $disk = 'public'): array
  {
    $storedPaths = [];

    foreach ($files as $file) {
      if ($file instanceof UploadedFile) {
        $storedPaths[] = self::uploadSingle($file, $path, $disk);
      }
    }

    return $storedPaths;
  }

  /**
   * Delete a file from storage.
   *
   * @param string $filePath The file path relative to the disk root (e.g., 'uploads/single/file.jpg')
   * @param string|null $disk Storage disk (default: 'public')
   * @return bool True if file was deleted, false otherwise
   */
  public static function delete(string $filePath, ?string $disk = 'public'): bool
  {
    if (Storage::disk($disk)->exists($filePath)) {
      return Storage::disk($disk)->delete($filePath);
    }

    return false;
  }

  /**
   * Generate a unique filename for uploaded file.
   *
   * @param UploadedFile $file
   * @return string
   */
  protected static function generateFilename(UploadedFile $file): string
  {
    return time() . '_' . uniqid() . '.' . $file->getClientOriginalExtension();
  }
}
