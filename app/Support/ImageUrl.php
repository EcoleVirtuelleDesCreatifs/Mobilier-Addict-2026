<?php

namespace App\Support;

use Illuminate\Support\Str;

class ImageUrl
{
    public static function url(?string $path): string
    {
        if (!$path) {
            return asset('assets/logo/favicon.png');
        }

        $path = str_replace('\\', '/', (string) $path);

        $path = preg_replace('#^/?storage/app/public/#', '', $path);
        $path = preg_replace('#^/?storage/app/#', '', $path);
        $path = preg_replace('#^/?public/storage/#', 'storage/', $path);
        $path = preg_replace('#^/?public/#', '', $path);

        if (Str::startsWith($path, ['http://', 'https://', '//'])) {
            return $path;
        }

        $path = ltrim($path, '/');

        if (Str::startsWith($path, 'uploads/')) {
            if (preg_match('/\.(jpe?g|png)$/i', $path)) {
                $webp = preg_replace('/\.(jpe?g|png)$/i', '.webp', $path);
                if (is_string($webp) && is_file(public_path($webp))) {
                    $path = $webp;
                }
            }

            return asset($path);
        }

        $relative = Str::startsWith($path, 'storage/') ? Str::after($path, 'storage/') : $path;
        $relative = preg_replace('#^public/#', '', $relative);

        if (preg_match('/\.(jpe?g|png)$/i', $relative)) {
            $webp = preg_replace('/\.(jpe?g|png)$/i', '.webp', $relative);
            if (is_string($webp) && is_file(storage_path('app/public/' . $webp))) {
                $relative = $webp;
            }
        }

        $source = storage_path('app/public/' . $relative);
        if (is_file($source)) {
            $mirror = 'uploads/media/' . $relative;
            $dest = public_path($mirror);

            if (!is_file($dest)) {
                $dir = dirname($dest);
                if (!is_dir($dir)) {
                    @mkdir($dir, 0775, true);
                }
                @copy($source, $dest);
            }

            if (is_file($dest)) {
                return asset($mirror);
            }

            $encoded = implode('/', array_map('rawurlencode', explode('/', $relative)));

            return url('media/' . $encoded);
        }

        return asset('storage/' . $relative);
    }

    /**
     * Miniature carrée (recadrée) mise en cache dans public/uploads/thumbs/{size}/.
     * Retombe sur l'image d'origine si la génération est impossible.
     */
    public static function thumb(?string $path, int $size = 96): string
    {
        $original = self::url($path);
        $base = rtrim(asset(''), '/') . '/';

        if (! $path || ! Str::startsWith($original, $base) || ! function_exists('imagecreatetruecolor')) {
            return $original;
        }

        $relative = rawurldecode(Str::before(Str::after($original, $base), '?'));
        $source = public_path($relative);
        if (! is_file($source) || ! preg_match('/\.(jpe?g|png|webp|gif)$/i', $source)) {
            return $original;
        }

        $webp = function_exists('imagewebp');
        $thumb = 'uploads/thumbs/' . $size . '/' . md5($relative . '|' . filemtime($source)) . ($webp ? '.webp' : '.jpg');
        $dest = public_path($thumb);

        if (is_file($dest)) {
            return asset($thumb);
        }

        try {
            [$width, $height, $type] = @getimagesize($source) ?: [0, 0, 0];
            if (! $width || ! $height || $width * $height > 40000000) {
                return $original;
            }

            $image = match ($type) {
                IMAGETYPE_JPEG => @imagecreatefromjpeg($source),
                IMAGETYPE_PNG => @imagecreatefrompng($source),
                IMAGETYPE_WEBP => function_exists('imagecreatefromwebp') ? @imagecreatefromwebp($source) : false,
                IMAGETYPE_GIF => @imagecreatefromgif($source),
                default => false,
            };
            if (! $image) {
                return $original;
            }

            $side = min($width, $height);
            $canvas = imagecreatetruecolor($size, $size);
            imagefill($canvas, 0, 0, imagecolorallocate($canvas, 255, 255, 255));
            imagecopyresampled($canvas, $image, 0, 0, (int) (($width - $side) / 2), (int) (($height - $side) / 2), $size, $size, $side, $side);

            if (! is_dir(dirname($dest))) {
                @mkdir(dirname($dest), 0775, true);
            }
            $saved = $webp ? @imagewebp($canvas, $dest, 80) : @imagejpeg($canvas, $dest, 82);
            imagedestroy($image);
            imagedestroy($canvas);

            return $saved ? asset($thumb) : $original;
        } catch (\Throwable $e) {
            return $original;
        }
    }
}
