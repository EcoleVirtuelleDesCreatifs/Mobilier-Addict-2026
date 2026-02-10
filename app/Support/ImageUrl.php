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

        if (Str::startsWith($path, ['uploads/', 'storage/'])) {
            return asset($path);
        }

        $path = preg_replace('#^public/#', '', $path);

        return asset('storage/' . $path);
    }
}
