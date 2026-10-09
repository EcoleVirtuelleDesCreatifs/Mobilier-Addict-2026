<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Schema;
use Symfony\Component\HttpFoundation\Response;
use App\Models\PageView;

class TrackVisitor
{
    public function handle(Request $request, Closure $next): Response
    {
        $response = $next($request);

        // Only track GET requests and if page_views table exists
        if ($request->isMethod('GET') && Schema::hasTable('page_views')) {
            try {
                // Get or generate visitor ID from cookie
                $visitorId = $request->cookie('visitor_id');

                if (!$visitorId) {
                    $visitorId = uniqid('visitor_', true);
                    $response->withCookie(cookie('visitor_id', $visitorId, 525600)); // 1 year
                }

                // Don't track admin pages
                if (!$request->is('ma/admin/*')) {
                    PageView::create([
                        'visitor_id' => $visitorId,
                        'user_id' => auth()->check() ? auth()->id() : null,
                        'route_name' => $request->route() ? $request->route()->getName() : null,
                        'path' => $request->path(),
                        'full_url' => $request->fullUrl(),
                        'referer' => $request->header('referer'),
                        'ip' => $request->ip(),
                        'user_agent' => $request->userAgent(),
                        'created_at' => now(),
                    ]);
                }
            } catch (\Exception $e) {
                // Silently fail to avoid breaking the app
            }
        }

        return $response;
    }
}
