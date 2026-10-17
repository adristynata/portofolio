<?php

namespace App\Traits;

use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;

trait HandlesImageUpload
{
    /**
     * Store uploaded image to disk if writable, or convert to compressed Base64 data URI for serverless environments (Vercel).
     */
    protected function storeImage(UploadedFile $file, string $folder = 'uploads', int $maxWidth = 1280, int $quality = 85): string
    {
        // 1. Try storing on public disk (works on localhost and writable servers)
        try {
            $path = $file->store($folder, 'public');
            if ($path && $path !== false && Storage::disk('public')->exists($path)) {
                return $path;
            }
        } catch (\Throwable $e) {
            // Read-only filesystem on serverless (e.g. Vercel)
        }

        // 2. Fallback: Compress and encode as Base64 Data URI
        $realPath = $file->getRealPath();
        $mime = $file->getMimeType();

        if (extension_loaded('gd') && function_exists('imagecreatefromstring')) {
            try {
                $raw = file_get_contents($realPath);
                $img = @imagecreatefromstring($raw);
                if ($img !== false) {
                    $width = imagesx($img);
                    $height = imagesy($img);

                    if ($width > $maxWidth) {
                        $newWidth = $maxWidth;
                        $newHeight = (int) round(($height / $width) * $maxWidth);
                        $resized = imagecreatetruecolor($newWidth, $newHeight);
                        imagealphablending($resized, false);
                        imagesavealpha($resized, true);
                        imagecopyresampled($resized, $img, 0, 0, 0, 0, $newWidth, $newHeight, $width, $height);
                        imagedestroy($img);
                        $img = $resized;
                    }

                    ob_start();
                    if ($mime === 'image/png') {
                        imagepng($img, null, 7);
                    } else {
                        imagejpeg($img, null, $quality);
                        $mime = 'image/jpeg';
                    }
                    $compressed = ob_get_clean();
                    imagedestroy($img);

                    if (!empty($compressed)) {
                        return "data:$mime;base64," . base64_encode($compressed);
                    }
                }
            } catch (\Throwable $e) {
                // Ignore GD error and fallback to raw base64
            }
        }

        $rawBase64 = base64_encode(file_get_contents($realPath));
        return "data:$mime;base64,$rawBase64";
    }
}
