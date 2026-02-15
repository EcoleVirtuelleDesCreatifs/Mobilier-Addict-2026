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

        if (preg_match('/\.(jpe?g|png)$/i', $path)) {
            $webpPath = preg_replace('/\.(jpe?g|png)$/i', '.webp', $path);
            if (is_string($webpPath) && $webpPath !== $path) {
                if (Str::startsWith($webpPath, 'uploads/') && is_file(public_path($webpPath))) {
                    $path = $webpPath;
                } elseif (Str::startsWith($webpPath, 'storage/')) {
                    $storageRelative = Str::after($webpPath, 'storage/');
                    if (is_file(storage_path('app/public/' . $storageRelative)) || is_file(public_path($webpPath))) {
                        $path = $webpPath;
                    }
                }
            }
        }

        $prefix = (string) config('app.image_url_public_prefix', 'storage');
        $useStorageAppPublic = $prefix === 'storage_app_public';
        $usePublicStorage = $prefix === 'public_storage';

        if (Str::startsWith($path, ['uploads/', 'storage/'])) {
            if (Str::startsWith($path, 'uploads/') && ($useStorageAppPublic || $usePublicStorage)) {
                return asset('public/' . $path);
            }
            if (Str::startsWith($path, 'storage/')) {
                if ($useStorageAppPublic) {
                    return asset('storage/app/public/' . Str::after($path, 'storage/'));
                }
                if ($usePublicStorage) {
                    return asset('public/' . $path);
                }
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
