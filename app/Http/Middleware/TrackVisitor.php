<?php

namespace App\Http\Middleware;

use App\Models\PageView;
use App\Support\GeoIp;
use App\Support\TrafficSource;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Schema;
use Symfony\Component\HttpFoundation\Response;

class TrackVisitor
{
    public function handle(Request $request, Closure $next): Response
    {
        $response = $next($request);

        // Only track GET requests and if page_views table exists
        if (! $request->isMethod('GET') || $request->ajax() || $request->routeIs('media.show') || ! self::schema()['table']) {
            return $response;
        }

        try {
            // Get or generate visitor ID from cookie
            $visitorId = $request->cookie('visitor_id');

            if (! $visitorId) {
                $visitorId = uniqid('visitor_', true);
                $response->headers->setCookie(cookie('visitor_id', $visitorId, 525600)); // 1 year
            }

            // Don't track admin pages
            if ($request->is('ma/admin*') || $request->is('admin*')) {
                return $response;
            }

            $ip = GeoIp::clientIp($request);
            $data = [
                'visitor_id' => $visitorId,
                'user_id' => auth()->check() ? auth()->id() : null,
                'route_name' => $request->route() ? $request->route()->getName() : null,
                'path' => $request->path(),
                'full_url' => mb_substr($request->fullUrl(), 0, 2048),
                'referer' => mb_substr((string) $request->header('referer'), 0, 2048) ?: null,
                'ip' => $ip,
                'user_agent' => mb_substr((string) $request->userAgent(), 0, 512),
            ];

            if (self::schema()['origin']) {
                $data += TrafficSource::detect($request);
            }

            $pageView = PageView::create($data);
            $request->attributes->set('tracked_page_view_id', $pageView->id);
        } catch (\Throwable $e) {
            // Silently fail to avoid breaking the app
        }

        return $response;
    }

    /** Géolocalisation après l'envoi de la réponse, pour ne pas ralentir la page. */
    public function terminate(Request $request, Response $response): void
    {
        $id = $request->attributes->get('tracked_page_view_id');
        if (! $id || ! self::schema()['origin']) {
            return;
        }

        try {
            $pageView = PageView::find($id);
            if (! $pageView || $pageView->city || $pageView->country) {
                return;
            }

            // Réutilise la localisation déjà connue pour ce visiteur
            $known = PageView::query()
                ->where('visitor_id', $pageView->visitor_id)
                ->where('id', '<>', $pageView->id)
                ->whereNotNull('country')
                ->where('created_at', '>=', now()->subDays(30))
                ->latest('id')
                ->first(['country', 'country_code', 'region', 'city']);

            $geo = $known ? $known->only(['country', 'country_code', 'region', 'city']) : GeoIp::lookup($pageView->ip);

            if ($geo) {
                $pageView->forceFill($geo)->save();
            }
        } catch (\Throwable $e) {
            // Silently fail to avoid breaking the app
        }
    }

    /** @return array{table: bool, origin: bool} */
    private static function schema(): array
    {
        static $schema = null;

        if ($schema !== null) {
            return $schema;
        }

        $detect = function () {
            $table = Schema::hasTable('page_views');

            return ['table' => $table, 'origin' => $table && Schema::hasColumn('page_views', 'source')];
        };

        try {
            return $schema = Cache::remember('page_views.schema.v2', now()->addMinutes(10), $detect);
        } catch (\Throwable $e) {
            try {
                return $schema = $detect();
            } catch (\Throwable $e) {
                return $schema = ['table' => false, 'origin' => false];
            }
        }
    }
}
