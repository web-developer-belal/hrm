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

/**
 * Store document file (PDF, DOC, DOCX, etc.)
 *
 * @param  \Illuminate\Http\UploadedFile  $file  The uploaded file
 * @param  string  $path  The storage path (e.g., 'documents', 'contracts')
 * @param  string|null  $customName  Custom filename (optional, without extension)
 * @return array ['path' => string, 'original_name' => string, 'size' => int, 'extension' => string]
 */
// if (! function_exists('storeDocument')) {
//     function storeDocument($file, $path, $customName = null)
//     {
//         try {
//             // Get original file information
//             $originalName = $file->getClientOriginalName();
//             $extension = $file->getClientOriginalExtension();
//             $size = $file->getSize(); // in bytes

//             // Generate filename
//             if ($customName) {
//                 // Use custom name if provided
//                 $filename = Str::slug($customName) . '_' . Str::random(8);
//             } else {
//                 // Use original name with random suffix
//                 $baseFilename = pathinfo($originalName, PATHINFO_FILENAME);
//                 $filename = Str::slug($baseFilename) . '_' . Str::random(8);
//             }

//             // Ensure the storage path exists
//             $storagePath = storage_path('app/public/' . $path);
//             if (!file_exists($storagePath)) {
//                 mkdir($storagePath, 0755, true);
//             }

//             // Full file path with extension
//             $fullFilename = $filename . '.' . $extension;
//             $fullPath = $storagePath . '/' . $fullFilename;

//             // Move uploaded file
//             move_uploaded_file($file->getPathname(), $fullPath);

//             // Return file information
//             return [
//                 'path' => $path . '/' . $fullFilename,
//                 'original_name' => $originalName,
//                 'size' => $size,
//                 'extension' => $extension,
//                 'filename' => $fullFilename
//             ];

//         } catch (\Exception $e) {
//             Log::error('Document storage failed: ' . $e->getMessage());
//             throw new \Exception('Failed to store document: ' . $e->getMessage());
//         }
//     }
// }
/**
 * Store document file (PDF, DOC, DOCX, etc.)
 */
if (! function_exists('storeDocument')) {
    function storeDocument($file, $path, $customName = null)
    {
        try {
            $originalName = $file->getClientOriginalName();
            $extension = $file->getClientOriginalExtension();
            $size = $file->getSize();

            if ($customName) {
                $filename = Str::slug($customName) . '_' . Str::random(8);
            } else {
                $baseFilename = pathinfo($originalName, PATHINFO_FILENAME);
                $filename = Str::slug($baseFilename) . '_' . Str::random(8);
            }

            $storagePath = storage_path('app/public/' . $path);
            if (!file_exists($storagePath)) {
                mkdir($storagePath, 0755, true);
            }

            $fullFilename = $filename . '.' . $extension;
            $fullPath = $storagePath . '/' . $fullFilename;

            // Use copy with getPathname (same as storeImage approach)
            copy($file->getPathname(), $fullPath);

            return [
                'path' => $path . '/' . $fullFilename,
                'original_name' => $originalName,
                'size' => $size,
                'extension' => $extension,
                'filename' => $fullFilename
            ];

        } catch (\Exception $e) {
            Log::error('Document storage failed: ' . $e->getMessage());
            throw new \Exception('Failed to store document: ' . $e->getMessage());
        }
    }
}
/**
 * Delete document from storage
 *
 * @param  string  $documentPath  The document path to delete
 * @return bool Success status
 */
if (! function_exists('deleteDocument')) {
    function deleteDocument($documentPath)
    {
        try {
            if (empty($documentPath)) {
                return false;
            }

            // Check if file exists in storage/app/public
            $fullPath = storage_path('app/public/' . $documentPath);

            if (file_exists($fullPath)) {
                unlink($fullPath);
                return true;
            }

            // Also check in public directory for backward compatibility
            $publicPath = public_path($documentPath);
            if (file_exists($publicPath)) {
                unlink($publicPath);
                return true;
            }

            return false;

        } catch (\Exception $e) {
            Log::error('Document deletion failed: ' . $e->getMessage());
            return false;
        }
    }
}

/**
 * Get full URL for stored document
 *
 * @param  string  $documentPath  The stored document path
 * @param  bool  $secure  Whether to use secure storage (default: true)
 * @return string|null Full URL to the document or null if not found
 */
if (! function_exists('documentAsset')) {
    function documentAsset($path, $secure = true)
    {
        if (empty($path)) {
            return null;
        }

        // Check if file exists
        $fileExists = false;
        if ($secure) {
            $fullPath = storage_path('app/public/' . $path);
            $fileExists = file_exists($fullPath);
        } else {
            $publicPath = public_path($path);
            $fileExists = file_exists($publicPath);
        }

        if ($fileExists) {
            return $secure ? asset(Storage::url($path)) : asset($path);
        }

        return null;
    }
}

/**
 * Get document file size in human readable format
 *
 * @param  string  $documentPath  The document path
 * @return string|null Formatted file size (e.g., "2.5 MB")
 */
if (! function_exists('getDocumentSize')) {
    function getDocumentSize($documentPath)
    {
        try {
            if (empty($documentPath)) {
                return null;
            }

            $fullPath = storage_path('app/public/' . $documentPath);

            if (!file_exists($fullPath)) {
                return null;
            }

            $bytes = filesize($fullPath);
            $units = ['B', 'KB', 'MB', 'GB', 'TB'];

            for ($i = 0; $bytes > 1024 && $i < count($units) - 1; $i++) {
                $bytes /= 1024;
            }

            return round($bytes, 2) . ' ' . $units[$i];

        } catch (\Exception $e) {
            Log::error('Get document size failed: ' . $e->getMessage());
            return null;
        }
    }
}

/**
 * Check if document exists
 *
 * @param  string  $documentPath  The document path
 * @return bool
 */
if (! function_exists('documentExists')) {
    function documentExists($documentPath)
    {
        if (empty($documentPath)) {
            return false;
        }

        $fullPath = storage_path('app/public/' . $documentPath);
        return file_exists($fullPath);
    }
}

/**
 * Get document icon based on extension
 *
 * @param  string  $extension  File extension
 * @return string Icon class or emoji
 */
if (! function_exists('getDocumentIcon')) {
    function getDocumentIcon($extension)
    {
        $icons = [
            'pdf' => '📄',
            'doc' => '📝',
            'docx' => '📝',
            'txt' => '📃',
            'jpeg' => '📷',
            'jpg' => '📷',
            'webp' => '📷',
        ];

        return $icons[strtolower($extension)] ?? '📎';
    }
}

}
