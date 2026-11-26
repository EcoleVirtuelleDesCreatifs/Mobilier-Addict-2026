<?php

namespace App\Support;

use App\Models\SiteSetting;
use Illuminate\Support\Facades\Cache;

/**
 * Identifiant du Pixel Meta (Facebook) à charger sur le site.
 * Réglé dans l'admin (Marketing › Facebook Pixel) ; à défaut, META_PIXEL_ID du .env.
 */
class MetaPixel
{
    public const CACHE_KEY = 'meta_pixel.settings';

    public static function id(): ?string
    {
        try {
            $settings = Cache::remember(self::CACHE_KEY, now()->addMinutes(10), fn () => [
                'id' => (string) SiteSetting::getValue('facebook_pixel_id', ''),
                'enabled' => (string) SiteSetting::getValue('facebook_pixel_enabled', '0'),
            ]);
        } catch (\Throwable $e) {
            $settings = ['id' => '', 'enabled' => '0'];
        }

        $id = preg_replace('/\D+/', '', $settings['id']);
        if ($id !== '' && in_array($settings['enabled'], ['1', 'true', 'on', 'yes'], true)) {
            return $id;
        }

        $env = preg_replace('/\D+/', '', (string) config('services.meta_pixel_id'));

        return $env !== '' ? $env : null;
    }

    public static function forget(): void
    {
        Cache::forget(self::CACHE_KEY);
    }
}
