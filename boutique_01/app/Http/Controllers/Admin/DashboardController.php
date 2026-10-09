<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\BlogPost;
use App\Models\Category;
use App\Models\NewsletterSubscription;
use App\Models\Order;
use App\Models\PageView;
use App\Models\Product;
use App\Models\Slide;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Str;

class DashboardController extends Controller
{
    public function index()
    {
        $hasPageViews = Schema::hasTable('page_views');
        $now = now();

        $visitors = [
            'realtime' => 0,
            'today' => 0,
            'week' => 0,
            'month' => 0,
        ];
        $topProducts = ['day' => collect(), 'week' => collect(), 'month' => collect()];
        $abandonedCarts = 0;

        if ($hasPageViews) {
            [$visitors, $abandonedCarts] = $this->trafficStats($now);

            $topRows = [
                'day' => $this->topViewedPaths($now->copy()->startOfDay()),
                'week' => $this->topViewedPaths($now->copy()->startOfWeek()),
                'month' => $this->topViewedPaths($now->copy()->startOfMonth()),
            ];

            $slugs = collect($topRows)->flatten(1)
                ->map(fn ($r) => Str::after($r->path, '/produit/'))
                ->filter()->unique()->all();

            $productsBySlug = empty($slugs)
                ? collect()
                : Product::query()->whereIn('slug', $slugs)->get(['id', 'name', 'slug', 'image', 'price'])->keyBy('slug');

            foreach ($topRows as $period => $rows) {
                $topProducts[$period] = $rows->map(fn ($r) => [
                    'views' => (int) $r->views,
                    'path' => $r->path,
                    'product' => $productsBySlug->get(Str::after($r->path, '/produit/')),
                ]);
            }

        }

        return view('admin.dashboard', [
            'stats' => [
                'products' => Product::count(),
                'categories' => Category::count(),
                'posts' => BlogPost::count(),
                'slides' => Slide::count(),
                'newsletter' => NewsletterSubscription::count(),
                'users' => User::count(),
            ],
            'ordersMissing' => ! Schema::hasTable('orders'),
            'ordersTotalCount' => Schema::hasTable('orders') ? Order::count() : 0,
            'ordersPendingCount' => Schema::hasTable('orders') ? Order::where('status', 'pending')->count() : 0,
            'lowStockCount' => Product::where('stock', '<=', 5)->count(),
            'productsOnlineCount' => Product::where('is_active', true)->count(),
            'productsOfflineCount' => Product::where('is_active', false)->count(),
            'latestOrders' => Schema::hasTable('orders')
                ? Order::query()->orderByDesc('created_at')->limit(6)->get()
                : collect(),
            'latestProducts' => Product::query()->orderByDesc('created_at')->limit(6)->get(),
            'hasPageViews' => $hasPageViews,
            'visitors' => $visitors,
            'topProducts' => $topProducts,
            'abandonedCarts' => $abandonedCarts,
        ]);
    }

    public function realtimeStats()
    {
        if (! Schema::hasTable('page_views')) {
            return response()->json([
                'visitors' => ['realtime' => 0, 'today' => 0, 'week' => 0, 'month' => 0],
                'abandonedCarts' => 0,
            ]);
        }

        [$visitors, $abandonedCarts] = $this->trafficStats(now());

        return response()->json([
            'visitors' => $visitors,
            'abandonedCarts' => $abandonedCarts,
        ]);
    }

    private function trafficStats($now): array
    {
        $visitors = [
            'realtime' => $this->distinctVisitors($now->copy()->subMinutes(5)),
            'today' => $this->distinctVisitors($now->copy()->startOfDay()),
            'week' => $this->distinctVisitors($now->copy()->startOfWeek()),
            'month' => $this->distinctVisitors($now->copy()->startOfMonth()),
        ];

        $checkoutVisitors = PageView::query()
            ->whereIn('route_name', ['cart.shipping', 'cart.payment'])
            ->where('created_at', '>=', $now->copy()->subDays(30))
            ->distinct()
            ->pluck('visitor_id');

        $confirmedVisitors = PageView::query()
            ->where('route_name', 'cart.confirmation')
            ->where('created_at', '>=', $now->copy()->subDays(30))
            ->distinct()
            ->pluck('visitor_id');

        return [$visitors, $checkoutVisitors->diff($confirmedVisitors)->count()];
    }

    private function distinctVisitors($since): int
    {
        return PageView::query()
            ->where('created_at', '>=', $since)
            ->distinct()
            ->count('visitor_id');
    }

    private function topViewedPaths($since, int $limit = 5)
    {
        return PageView::query()
            ->select('path', DB::raw('COUNT(*) as views'))
            ->where('route_name', 'product.show')
            ->where('created_at', '>=', $since)
            ->groupBy('path')
            ->orderByDesc('views')
            ->limit($limit)
            ->get();
    }
}
