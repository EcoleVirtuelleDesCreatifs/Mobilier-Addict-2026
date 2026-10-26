<?php

namespace App\Support;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Http;

/**
 * Géolocalisation approximative d'une adresse IP (pays, région, ville) via ipwho.is.
 * Résultats mis en cache 30 jours par IP ; échecs mis en cache 1 heure.
 */
class GeoIp
{
    /** Adresse IP réelle du visiteur, y compris derrière un CDN / proxy. */
    public static function clientIp(Request $request): ?string
    {
        $candidates = [
            $request->headers->get('CF-Connecting-IP'),
            $request->headers->get('True-Client-IP'),
            $request->headers->get('X-Real-IP'),
        ];
        foreach (explode(',', (string) $request->headers->get('X-Forwarded-For')) as $ip) {
            $candidates[] = $ip;
        }
        $candidates[] = $request->ip();

        foreach ($candidates as $ip) {
            $ip = trim((string) $ip);
            if ($ip !== '' && self::isPublic($ip)) {
                return $ip;
            }
        }

        return $request->ip();
    }

    /** @return array{country: ?string, country_code: ?string, region: ?string, city: ?string}|null */
    public static function lookup(?string $ip): ?array
    {
        if (! $ip || ! self::isPublic($ip)) {
            return null;
        }

        $key = 'geoip:' . md5($ip);
        $cached = Cache::get($key);
        if ($cached !== null) {
            return $cached ?: null;
        }

        try {
            $data = Http::timeout(3)->acceptJson()
                ->get('https://ipwho.is/' . urlencode($ip), ['fields' => 'success,country,country_code,region,city', 'lang' => 'fr'])
                ->json();
        } catch (\Throwable $e) {
            $data = null;
        }

        if (! is_array($data) || empty($data['success'])) {
            Cache::put($key, [], now()->addHour());

            return null;
        }

        $geo = [
            'country' => self::str($data['country'] ?? null),
            'country_code' => self::str($data['country_code'] ?? null, 2),
            'region' => self::str($data['region'] ?? null),
            'city' => self::str($data['city'] ?? null),
        ];
        Cache::put($key, $geo, now()->addDays(30));

        return $geo;
    }

    public static function isPublic(string $ip): bool
    {
        return (bool) filter_var($ip, FILTER_VALIDATE_IP, FILTER_FLAG_NO_PRIV_RANGE | FILTER_FLAG_NO_RES_RANGE);
    }

    private static function str($value, int $max = 80): ?string
    {
        $value = is_string($value) ? trim($value) : '';

        return $value === '' ? null : mb_substr($value, 0, $max);
    }
}
