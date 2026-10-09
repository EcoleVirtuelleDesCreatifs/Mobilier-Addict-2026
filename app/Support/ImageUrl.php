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

        if (is_file(storage_path('app/public/' . $relative))) {
            $encoded = implode('/', array_map('rawurlencode', explode('/', $relative)));

            return url('media/' . $encoded);
        }

        return asset('storage/' . $relative);
    }
}
