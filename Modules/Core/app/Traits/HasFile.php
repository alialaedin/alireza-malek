<?php

namespace Modules\Core\Traits;

use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Spatie\MediaLibrary\MediaCollections\Exceptions\FileDoesNotExist;
use Spatie\MediaLibrary\MediaCollections\Exceptions\FileIsTooBig;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

trait HasFile
{
  /**
   * This property maps collection names to the corresponding file input names.
   * It needs to be defined in the model for dynamic file handling.
   *
   * Example:
   * protected $collectionNames = [
   *     'post_images' => 'image',
   *     'post_logos' => 'logo',
   * ];
   */
  protected array $collectionNames = [];

  /**
   * @throws Exception
   */
  public function bootHasFile(): void
  {
    if (empty($this->collectionNames)) {
      throw new Exception("Collection names are not defined.");
    }
  }

  public function registerCustomMediaCollections(): void
  {
    if (method_exists($this, 'addMediaCollection')) {
      foreach ($this->collectionNames as $collectionName) {
        $this->addMediaCollection($collectionName)->singleFile();
      }
    }
  }

  public function uploadFiles(Request $request): void
  {
    foreach ($this->collectionNames as $collectionName => $fileInputName) {
      $this->processFileUpload($request, $collectionName, $fileInputName);
    }
  }

  protected function processFileUpload(Request $request, string $collectionName, string $fileField): void
  {
    if ($request->hasFile($fileField) && $request->file($fileField)->isValid()) {
      try {
        $this->clearMediaCollection($collectionName);
        $this->addMedia($request->file($fileField))->toMediaCollection($collectionName);
      } catch (FileDoesNotExist | FileIsTooBig $e) {
        Log::error("File upload failed for collection '$collectionName': " . $e->getMessage());
      }
    } else {
      Log::warning("No valid file uploaded for collection '$collectionName'.");
    }
  }

  public function getFirstMediaFile(string $collectionName): ?Media
  {
    return $this->getFirstMedia($collectionName);
  }

  public function getMediaUrl(string $collectionName): ?string
  {
    $media = $this->getFirstMedia($collectionName);
    return $media?->getUrl() ?? null;
  }
}
