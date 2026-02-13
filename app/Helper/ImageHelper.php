<?php

use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Intervention\Image\Drivers\Gd\Driver;
use Intervention\Image\ImageManager;

/**
 * Store image with advanced processing
 *
 * @param  \Illuminate\Http\UploadedFile  $file  The uploaded file
 * @param  string  $path  The storage path (e.g., 'products', 'users/avatars')
 * @param  int|null  $width  Desired width (optional)
 * @param  int|null  $height  Desired height (optional)
 * @param  string|null  $format  Output format (png, jpg, webp) - defaults to webp
 * @return string The stored file path
 */
if (! function_exists('storeImage')) {
    function storeImage($file, $path, $width = null, $height = null, $format = null)
    {
        try {
            // Create image manager with GD driver
            $manager = new ImageManager(new Driver);

            // Generate random filename
            $filename = Str::random(15);

            // Set default format to webp if not specified
            $format = $format ?: 'webp';

            // Ensure the storage path exists
            $storagePath = storage_path('app/public/'.$path);
            if (! file_exists($storagePath)) {
                mkdir($storagePath, 0755, true);
            }

            // Read the uploaded image
            $image = $manager->read($file->getPathname());

            // Resize image smartly if width or height is provided
            if ($width || $height) {
                if ($width && $height) {
                    // Both width and height provided - resize with aspect ratio constraint
                    $image->resize($width, $height, function ($constraint) {
                        $constraint->aspectRatio();
                        $constraint->upsize(); // Prevent upsizing
                    });
                } elseif ($width) {
                    // Only width provided - resize maintaining aspect ratio
                    $image->resize($width, null, function ($constraint) {
                        $constraint->aspectRatio();
                        $constraint->upsize();
                    });
                } else {
                    // Only height provided - resize maintaining aspect ratio
                    $image->resize(null, $height, function ($constraint) {
                        $constraint->aspectRatio();
                        $constraint->upsize();
                    });
                }
            }

            // Convert to specified format and save
            $fullPath = $storagePath.'/'.$filename.'.'.$format;

            switch (strtolower($format)) {
                case 'jpg':
                case 'jpeg':
                    $image->toJpeg(85)->save($fullPath);
                    break;
                case 'png':
                    $image->toPng()->save($fullPath);
                    break;
                case 'webp':
                default:
                    $image->toWebp(85)->save($fullPath);
                    break;
            }

            // Return the relative path for storage
            return $path.'/'.$filename.'.'.$format;

        } catch (\Exception $e) {
            Log::error('Image storage failed: '.$e->getMessage());
            throw new \Exception('Failed to store image: '.$e->getMessage());
        }
    }
}

/**
 * Delete image from storage
 *
 * @param  string  $imagePath  The image path to delete
 * @return bool Success status
 */
if (! function_exists('deleteImage')) {
    function deleteImage($imagePath)
    {
        try {
            if (empty($imagePath)) {
                return false;
            }

            // Check if file exists in storage/app/public
            $fullPath = storage_path('app/public/'.$imagePath);

            if (file_exists($fullPath)) {
                unlink($fullPath);

                return true;
            }

            // Also check in public directory for backward compatibility
            $publicPath = public_path($imagePath);
            if (file_exists($publicPath)) {
                unlink($publicPath);

                return true;
            }

            return false;

        } catch (\Exception $e) {
            Log::error('Image deletion failed: '.$e->getMessage());

            return false;
        }
    }
}

/**
 * Get full URL for stored image
 *
 * @param  string  $imagePath  The stored image path
 * @param  bool  $secure  Whether to use secure storage (default: true)
 * @param  string  $type  Type of image ('normal', 'user') for fallback handling
 * @return string $name Full URL to the image
 */
if (! function_exists('customAsset')) {
    function customAsset($path, $secure = true, $type = 'normal', $name = null)
    {
        $colors = ['green', 'red', 'orange', 'blue', 'purple', 'pink', 'yellow', 'silver'];
        $bgColor = $colors[array_rand($colors)];
        $placeHolderImage = 'https://placehold.co/400x400/'.$bgColor.'/white?text=No+Image';

        if (empty($path)) {
            // Handle user type - return UI Avatars
            if ($type === 'user') {
                $displayName = $name ?: 'User';

                return 'https://ui-avatars.com/api/?background=random&name='.urlencode($displayName);
            }

            // Return placeholder for other types
            return $placeHolderImage;
        }

        // Check if file exists
        $fileExists = false;
        if ($secure) {
            $fullPath = storage_path('app/public/'.$path);
            $fileExists = file_exists($fullPath);
        } else {
            $publicPath = public_path($path);
            $fileExists = file_exists($publicPath);
        }

        if ($fileExists) {
            return $secure ? asset(Storage::url($path)) : asset($path);
        }

        // File not found - return fallbacks
        if ($type === 'user') {
            $displayName = $name ?: 'User';

            return 'https://ui-avatars.com/api/?background=random&name='.urlencode($displayName);
        }

        return $placeHolderImage;
    }


function formatDuration(?string $duration): ?string
{
    // Return null if empty/invalid
    if (empty($duration) || !is_string($duration)) {
        return null;
    }

    $parts = explode(':', $duration);
    if (count($parts) < 2) { // Need at least HH:MM
        return null;
    }

    $hours = isset($parts[0]) ? (int) $parts[0] : 0;
    $minutes = isset($parts[1]) ? (int) $parts[1] : 0;
    $seconds = isset($parts[2]) ? (int) $parts[2] : 0;

    $formatted = [];
    if ($hours > 0) $formatted[] = "{$hours}h";
    if ($minutes > 0 || $hours > 0) $formatted[] = "{$minutes}m";
    if ($seconds > 0 || empty($formatted)) $formatted[] = "{$seconds}s";

    return implode(' ', $formatted);
}
}
