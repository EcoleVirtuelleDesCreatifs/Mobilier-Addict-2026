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

        $prefix = (string) config('app.image_url_public_prefix', 'storage');
        $useStorageAppPublic = $prefix === 'storage_app_public';
        $usePublicStorage = $prefix === 'public_storage';

        if (Str::startsWith($path, ['uploads/', 'storage/'])) {
            if ($usePublicStorage && Str::startsWith($path, ['storage/'])) {
                return asset('public/' . $path);
            }
            return asset($path);
        }

        $path = preg_replace('#^public/#', '', $path);

        if ($useStorageAppPublic) {
            return asset('storage/app/public/' . $path);
        }

        if ($usePublicStorage) {
            return asset('public/storage/' . $path);
        }

        return asset('storage/' . $path);
    }
}
