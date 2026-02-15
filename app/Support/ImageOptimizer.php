<?php

namespace App\Support;

use Illuminate\Http\UploadedFile;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

class ImageOptimizer
{
    public static function isAvailable(): bool
    {
        return extension_loaded('gd')
            && function_exists('imagecreatetruecolor')
            && function_exists('imagewebp');
    }

    public static function storePublicUpload(
        UploadedFile $file,
        string $relativeDir,
        int $maxWidth,
        int $quality = 80
    ): string {
        $relativeDir = trim(str_replace('\\', '/', $relativeDir), '/');
        $baseName = time() . '_' . Str::random(10);

        $destDir = public_path($relativeDir);
        if (!is_dir($destDir)) {
            @mkdir($destDir, 0755, true);
        }

        if (self::isAvailable()) {
            $destRelative = $relativeDir . '/' . $baseName . '.webp';
            $destPath = public_path($destRelative);

            $ok = self::convertToWebp($file->getPathname(), $destPath, $maxWidth, $quality);
            if ($ok) {
                return $destRelative;
            }
        }

        $ext = (string) ($file->getClientOriginalExtension() ?: $file->guessExtension() ?: 'jpg');
        $ext = ltrim(strtolower(trim($ext)), '.');
        if ($ext === 'jpeg') {
            $ext = 'jpg';
        }
        $destRelative = $relativeDir . '/' . $baseName . '.' . $ext;
        $file->move(public_path($relativeDir), basename($destRelative));

        return $destRelative;
    }

    public static function storeStoragePublic(
        UploadedFile $file,
        string $dir,
        int $maxWidth,
        int $quality = 80
    ): string {
        $dir = trim(str_replace('\\', '/', $dir), '/');
        $baseName = time() . '_' . Str::random(10);

        if (self::isAvailable()) {
            $relativePath = $dir . '/' . $baseName . '.webp';
            $tmpPath = storage_path('app/tmp-' . $baseName . '.webp');

            $ok = self::convertToWebp($file->getPathname(), $tmpPath, $maxWidth, $quality);
            if ($ok) {
                Storage::disk('public')->put($relativePath, file_get_contents($tmpPath));
                @unlink($tmpPath);
                return $relativePath;
            }
        }

        return $file->store($dir, 'public');
    }

    public static function optimizeFileInPlace(string $absolutePath, int $maxWidth, int $quality = 80): bool
    {
        $absolutePath = (string) $absolutePath;
        if ($absolutePath === '' || !is_file($absolutePath)) {
            return false;
        }

        if (!self::isAvailable()) {
            return false;
        }

        $ext = strtolower(pathinfo($absolutePath, PATHINFO_EXTENSION));
        if (!in_array($ext, ['jpg', 'jpeg', 'png', 'webp'], true)) {
            return false;
        }

        $tmp = $absolutePath . '.tmp.webp';
        $ok = self::convertToWebp($absolutePath, $tmp, $maxWidth, $quality);
        if (!$ok) {
            @unlink($tmp);
            return false;
        }

        if ($ext === 'webp') {
            @rename($tmp, $absolutePath);
            return true;
        }

        $sidecar = preg_replace('/\.[^.]+$/', '', $absolutePath) . '.webp';
        @rename($tmp, $sidecar);

        if (in_array($ext, ['jpg', 'jpeg'], true) && function_exists('imagecreatefromjpeg')) {
            self::recompressJpeg($absolutePath, $maxWidth, $quality);
        }

        return true;
    }

    private static function recompressJpeg(string $absolutePath, int $maxWidth, int $quality): void
    {
        try {
            $img = @imagecreatefromjpeg($absolutePath);
            if (!$img) {
                return;
            }

            $w = imagesx($img);
            $h = imagesy($img);

            if ($w <= 0 || $h <= 0) {
                imagedestroy($img);
                return;
            }

            if ($w > $maxWidth) {
                $newW = $maxWidth;
                $newH = (int) round(($h * $newW) / $w);
                $resized = imagecreatetruecolor($newW, $newH);
                imagecopyresampled($resized, $img, 0, 0, 0, 0, $newW, $newH, $w, $h);
                imagedestroy($img);
                $img = $resized;
            }

            @imagejpeg($img, $absolutePath, max(40, min(90, $quality)));
            imagedestroy($img);
        } catch (\Throwable $e) {
            return;
        }
    }

    private static function convertToWebp(string $srcPath, string $destPath, int $maxWidth, int $quality): bool
    {
        try {
            if (!is_file($srcPath)) {
                return false;
            }

            $info = @getimagesize($srcPath);
            if (!$info || empty($info[0]) || empty($info[1])) {
                return false;
            }

            [$w, $h] = [$info[0], $info[1]];
            $mime = (string) ($info['mime'] ?? '');

            $img = null;
            if ($mime === 'image/jpeg') {
                $img = @imagecreatefromjpeg($srcPath);
            } elseif ($mime === 'image/png') {
                $img = @imagecreatefrompng($srcPath);
            } elseif ($mime === 'image/webp') {
                $img = @imagecreatefromwebp($srcPath);
            } else {
                return false;
            }

            if (!$img) {
                return false;
            }

            $target = $img;
            if ($w > $maxWidth) {
                $newW = $maxWidth;
                $newH = (int) round(($h * $newW) / $w);
                $resized = imagecreatetruecolor($newW, $newH);

                imagealphablending($resized, false);
                imagesavealpha($resized, true);

                imagecopyresampled($resized, $img, 0, 0, 0, 0, $newW, $newH, $w, $h);
                $target = $resized;
            }

            $quality = max(40, min(90, (int) $quality));
            $ok = @imagewebp($target, $destPath, $quality);

            if ($target !== $img) {
                imagedestroy($target);
            }
            imagedestroy($img);

            return (bool) $ok;
        } catch (\Throwable $e) {
            return false;
        }
    }
}
