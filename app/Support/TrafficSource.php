<?php

namespace App\Support;

use Illuminate\Http\Request;
use Illuminate\Support\Str;

/**
 * Détermine la source de trafic d'une visite (référent, paramètres UTM, navigateur intégré des apps).
 *
 * Medium : direct, search, social, paid, email, referral, campaign, internal.
 */
class TrafficSource
{
    private const HOSTS = [
        'mail.' => ['E-mail', 'email'], 'outlook' => ['E-mail', 'email'], 'com.google.android.gm' => ['E-mail', 'email'],
        'facebook' => ['Facebook', 'social'], 'fb.com' => ['Facebook', 'social'], 'fb.me' => ['Facebook', 'social'],
        'instagram' => ['Instagram', 'social'],
        'tiktok' => ['TikTok', 'social'],
        'whatsapp' => ['WhatsApp', 'social'], 'wa.me' => ['WhatsApp', 'social'],
        'youtube' => ['YouTube', 'social'], 'youtu.be' => ['YouTube', 'social'],
        'linkedin' => ['LinkedIn', 'social'], 'lnkd.in' => ['LinkedIn', 'social'],
        'twitter' => ['X (Twitter)', 'social'], 't.co' => ['X (Twitter)', 'social'], 'x.com' => ['X (Twitter)', 'social'],
        'pinterest' => ['Pinterest', 'social'],
        'snapchat' => ['Snapchat', 'social'],
        't.me' => ['Telegram', 'social'], 'telegram' => ['Telegram', 'social'],
        'google' => ['Google', 'search'],
        'bing' => ['Bing', 'search'],
        'yahoo' => ['Yahoo', 'search'],
        'duckduckgo' => ['DuckDuckGo', 'search'],
        'ecosia' => ['Ecosia', 'search'],
        'yandex' => ['Yandex', 'search'],
        'qwant' => ['Qwant', 'search'],
    ];

    private const UTM_NAMES = [
        'fb' => 'Facebook', 'facebook' => 'Facebook', 'meta' => 'Facebook',
        'ig' => 'Instagram', 'instagram' => 'Instagram',
        'wa' => 'WhatsApp', 'whatsapp' => 'WhatsApp',
        'tiktok' => 'TikTok', 'tt' => 'TikTok',
        'google' => 'Google', 'youtube' => 'YouTube',
        'email' => 'E-mail', 'newsletter' => 'Newsletter', 'sms' => 'SMS',
    ];

    public const MEDIUM_LABELS = [
        'direct' => 'Accès direct',
        'search' => 'Moteur de recherche',
        'social' => 'Réseau social',
        'paid' => 'Publicité',
        'email' => 'E-mail',
        'referral' => 'Site référent',
        'campaign' => 'Campagne',
    ];

    /** @return array{source: string, medium: string, campaign: ?string} */
    public static function detect(Request $request): array
    {
        return self::classify(
            (string) $request->headers->get('referer'),
            $request->query(),
            (string) $request->userAgent(),
            $request->getHost()
        );
    }

    /** @return array{source: string, medium: string, campaign: ?string} */
    public static function classify(string $referer, array $query, string $userAgent, string $ownHost): array
    {
        $campaign = self::clean($query['utm_campaign'] ?? null, 120);

        // 1. Paramètres UTM explicites
        if ($utmSource = self::clean($query['utm_source'] ?? null, 60)) {
            $key = Str::lower($utmSource);
            $medium = Str::lower((string) ($query['utm_medium'] ?? ''));

            return [
                'source' => self::UTM_NAMES[$key] ?? Str::title($utmSource),
                'medium' => match (true) {
                    in_array($medium, ['cpc', 'ppc', 'paid', 'paid_social', 'ads', 'ad', 'sponsored'], true) => 'paid',
                    in_array($medium, ['email', 'newsletter', 'mail'], true) => 'email',
                    in_array($medium, ['social', 'social_media', 'organic_social'], true) => 'social',
                    default => 'campaign',
                },
                'campaign' => $campaign,
            ];
        }

        // 2. Identifiants de clic publicitaires
        if (! empty($query['gclid']) || ! empty($query['gbraid']) || ! empty($query['wbraid'])) {
            return ['source' => 'Google', 'medium' => 'paid', 'campaign' => $campaign];
        }
        if (! empty($query['ttclid'])) {
            return ['source' => 'TikTok', 'medium' => 'paid', 'campaign' => $campaign];
        }

        // 3. Référent
        $host = Str::lower((string) parse_url($referer, PHP_URL_HOST));
        if ($host === '' && Str::startsWith($referer, 'android-app://')) {
            $host = Str::after($referer, 'android-app://');
        }

        if ($host !== '') {
            $own = preg_replace('/^www\./', '', Str::lower($ownHost));
            if ($host === $own || Str::endsWith($host, '.' . $own)) {
                return ['source' => 'Interne', 'medium' => 'internal', 'campaign' => null];
            }

            foreach (self::HOSTS as $needle => [$name, $medium]) {
                if (Str::contains($host, $needle)) {
                    return ['source' => $name, 'medium' => ! empty($query['fbclid']) && $name === 'Facebook' ? 'social' : $medium, 'campaign' => $campaign];
                }
            }

            return ['source' => Str::limit(preg_replace('/^www\./', '', $host), 60, ''), 'medium' => 'referral', 'campaign' => $campaign];
        }

        // 4. Navigateurs intégrés des applications (pas de référent transmis)
        if (! empty($query['fbclid']) || preg_match('/FBAN|FBAV|FB_IAB|FBIOS/i', $userAgent)) {
            return ['source' => 'Facebook', 'medium' => 'social', 'campaign' => $campaign];
        }
        if (preg_match('/Instagram/i', $userAgent)) {
            return ['source' => 'Instagram', 'medium' => 'social', 'campaign' => $campaign];
        }
        if (preg_match('/musical_ly|BytedanceWebview|TikTok/i', $userAgent)) {
            return ['source' => 'TikTok', 'medium' => 'social', 'campaign' => $campaign];
        }
        if (preg_match('/Snapchat/i', $userAgent)) {
            return ['source' => 'Snapchat', 'medium' => 'social', 'campaign' => $campaign];
        }

        return ['source' => 'Direct', 'medium' => 'direct', 'campaign' => $campaign];
    }

    private static function clean($value, int $max): ?string
    {
        $value = is_string($value) ? trim(strip_tags($value)) : '';

        return $value === '' ? null : Str::limit($value, $max, '');
    }
}
