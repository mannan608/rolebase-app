<?php

namespace App\Traits;

use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

/**
 * HandlesImages Trait
 *
 * Fully dynamic, reusable image upload/delete/replace utility.
 * Works with any model that has file fields stored via Laravel Storage.
 *
 * Usage in a controller:
 *   use HandlesImages;
 *
 *   $path = $this->uploadImage($request->file('logo'), 'universities/logos');
 *   $this->deleteImage($university->logo);
 *   $path = $this->replaceImage($request->file('logo'), $university->logo, 'universities/logos');
 */
trait HandlesImages
{
    /**
     * Upload a single image and return its storage path.
     *
     * @param  UploadedFile  $file
     * @param  string        $directory   Storage sub-directory (e.g. 'universities/logos')
     * @param  string        $disk        Storage disk (default: 'public')
     * @param  string|null   $filename    Custom filename without extension; auto-generated if null
     * @return string                     Relative path stored in DB
     */
    public function uploadImage(
        UploadedFile $file,
        string $directory,
        string $disk = 'public',
        ?string $filename = null
    ): string {
        $name = $filename
            ? $filename . '.' . $file->getClientOriginalExtension()
            : Str::uuid() . '.' . $file->getClientOriginalExtension();

        return $file->storeAs($directory, $name, $disk);
    }

    /**
     * Upload multiple images and return an array of paths.
     *
     * @param  UploadedFile[]  $files
     * @param  string          $directory
     * @param  string          $disk
     * @return string[]
     */
    public function uploadImages(
        array $files,
        string $directory,
        string $disk = 'public'
    ): array {
        return array_map(
            fn (UploadedFile $file) => $this->uploadImage($file, $directory, $disk),
            $files
        );
    }

    /**
     * Delete a single image from storage.
     *
     * @param  string|null  $path  Path stored in DB
     * @param  string       $disk
     * @return bool
     */
    public function deleteImage(?string $path, string $disk = 'public'): bool
    {
        if ($path && Storage::disk($disk)->exists($path)) {
            return Storage::disk($disk)->delete($path);
        }

        return false;
    }

    /**
     * Delete multiple images from storage.
     *
     * @param  string[]  $paths
     * @param  string    $disk
     * @return void
     */
    public function deleteImages(array $paths, string $disk = 'public'): void
    {
        foreach ($paths as $path) {
            $this->deleteImage($path, $disk);
        }
    }

    /**
     * Replace an existing image: deletes the old one, uploads the new one.
     *
     * @param  UploadedFile|null  $newFile      New upload; if null, returns the old path untouched
     * @param  string|null        $oldPath      Path of the existing image to delete
     * @param  string             $directory
     * @param  string             $disk
     * @return string|null                      New path, or old path if no new file was provided
     */
    public function replaceImage(
        ?UploadedFile $newFile,
        ?string $oldPath,
        string $directory,
        string $disk = 'public'
    ): ?string {
        if (! $newFile) {
            return $oldPath;
        }

        $this->deleteImage($oldPath, $disk);

        return $this->uploadImage($newFile, $directory, $disk);
    }

    /**
     * Get the public URL for a stored image.
     *
     * @param  string|null  $path
     * @param  string       $disk
     * @param  string|null  $fallback  URL to return when path is null / file missing
     * @return string
     */
    public function imageUrl(?string $path, string $disk = 'public', ?string $fallback = null): string
    {
        if ($path && Storage::disk($disk)->exists($path)) {
            return Storage::disk($disk)->url($path);
        }

        return $fallback ?? asset('images/placeholder.png');
    }

    /**
     * Resolve the final stored value for an image field during a model update.
     *
     * Decision matrix:
     *   - new file uploaded           → replace old, return new path
     *   - explicit delete requested   → delete old, return null
     *   - nothing changed             → return old path as-is
     *
     * @param  UploadedFile|null  $newFile
     * @param  string|null        $oldPath
     * @param  string             $directory
     * @param  bool               $deleteRequested  e.g. from a hidden "remove_logo" checkbox
     * @param  string             $disk
     * @return string|null
     */
    public function resolveImageUpdate(
        ?UploadedFile $newFile,
        ?string $oldPath,
        string $directory,
        bool $deleteRequested = false,
        string $disk = 'public'
    ): ?string {
        if ($newFile) {
            return $this->replaceImage($newFile, $oldPath, $directory, $disk);
        }

        if ($deleteRequested) {
            $this->deleteImage($oldPath, $disk);
            return null;
        }

        return $oldPath;
    }
}