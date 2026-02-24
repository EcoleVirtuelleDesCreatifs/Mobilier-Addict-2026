<?php

namespace App\Http\Middleware;

use App\Models\PageView;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Symfony\Component\HttpFoundation\Response;

class TrackPageView
{
    public function handle(Request $request, Closure $next): Response
    {
        $response = $next($request);

        try {
            if ($request->isMethod('GET') && !$request->ajax()) {
                if ($request->is('ma/admin*') || $request->is('admin*')) {
                    return $response;
                }

                $visitorId = (string) $request->cookie('visitor_id');
                if ($visitorId === '') {
                    $visitorId = Str::uuid()->toString();
                    $response->headers->setCookie(cookie()->forever('visitor_id', $visitorId));
                }

                PageView::query()->create([
                    'visitor_id' => $visitorId,
                    'user_id' => $request->user()?->id,
                    'route_name' => $request->route()?->getName(),
                    'path' => '/' . ltrim((string) $request->path(), '/'),
                    'full_url' => $request->fullUrl(),
                    'referer' => $request->headers->get('referer'),
                    'ip' => $request->ip(),
                    'user_agent' => substr((string) $request->userAgent(), 0, 512),
                ]);
            }
        } catch (\Throwable $e) {
            // Swallow tracking errors to avoid impacting user experience.
        }

        return $response;
    }
}
