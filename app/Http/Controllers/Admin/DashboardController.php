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

        $hasOrders = Schema::hasTable('orders');
        $statusLabels = [
            'pending' => ['En attente', 'amber'],
            'confirmed' => ['Confirmée', 'blue'],
            'shipping' => ['En livraison', 'violet'],
            'delivered' => ['Livrée', 'green'],
            'canceled' => ['Annulée', 'red'],
        ];

        $latestOrders = $hasOrders
            ? Order::query()->orderByDesc('created_at')->limit(6)->get()->map(function ($order) use ($statusLabels) {
                [$label, $tone] = $statusLabels[$order->status] ?? [(string) $order->status, 'gray'];

                return [
                    'id' => $order->id,
                    'number' => 'CMD-' . str_pad((string) $order->id, 6, '0', STR_PAD_LEFT),
                    'customer' => trim(($order->lastname ?? '') . ' ' . ($order->firstnames ?? '')) ?: '—',
                    'total' => (float) ($order->total ?? 0),
                    'status' => $label,
                    'tone' => $tone,
                    'date' => $order->created_at ? $order->created_at->diffForHumans() : '',
                    'url' => route('admin.orders.show', $order->id),
                ];
            })->values()
            : collect();

        $top = [];
        foreach ($topProducts as $period => $rows) {
            $top[$period] = collect($rows)->map(function ($row) {
                $product = $row['product'];

                return [
                    'name' => $product ? $product->name : Str::afterLast($row['path'], '/'),
                    'image' => ($product && $product->image) ? image_url($product->image) : null,
                    'url' => $product ? route('admin.products.edit', $product->id) : url($row['path']),
                    'views' => $row['views'],
                ];
            })->values();
        }

        $dashboard = [
            'today' => now()->translatedFormat('l d F Y'),
            'kpis' => [
                ['label' => 'Produits', 'value' => Product::count(), 'hint' => Product::where('is_active', true)->count() . ' en ligne', 'icon' => 'fa-solid fa-couch', 'tone' => 'navy', 'url' => route('admin.products.index')],
                ['label' => 'Commandes', 'value' => $hasOrders ? Order::count() : 0, 'hint' => ($hasOrders ? Order::whereDate('created_at', today())->count() : 0) . " aujourd'hui", 'icon' => 'fa-solid fa-bag-shopping', 'tone' => 'blue', 'url' => route('admin.orders.index')],
                ['label' => 'À traiter', 'value' => $hasOrders ? Order::where('status', 'pending')->count() : 0, 'hint' => 'Commandes en attente', 'icon' => 'fa-solid fa-clock', 'tone' => 'amber', 'url' => route('admin.orders.index', ['status' => 'pending'])],
                ['label' => 'Stock faible', 'value' => Product::where('stock', '<=', 5)->count(), 'hint' => '≤ 5 unités', 'icon' => 'fa-solid fa-triangle-exclamation', 'tone' => 'red', 'url' => route('admin.products.index', ['status' => 'low_stock'])],
            ],
            'traffic' => $hasPageViews ? $visitors : null,
            'abandonedCarts' => $abandonedCarts,
            'topProducts' => $top,
            'latestOrders' => $latestOrders,
            'overview' => [
                ['label' => 'Catégories', 'value' => Category::count(), 'icon' => 'fa-solid fa-folder'],
                ['label' => 'Articles', 'value' => BlogPost::count(), 'icon' => 'fa-solid fa-newspaper'],
                ['label' => 'Sliders', 'value' => Slide::count(), 'icon' => 'fa-solid fa-images'],
                ['label' => 'Newsletter', 'value' => NewsletterSubscription::count(), 'icon' => 'fa-solid fa-envelope'],
                ['label' => 'Utilisateurs', 'value' => User::count(), 'icon' => 'fa-solid fa-users'],
            ],
            'quickLinks' => array_values(array_filter([
                ['label' => 'Nouveau produit', 'icon' => 'fa-solid fa-plus', 'url' => route('admin.products.create')],
                ['label' => 'Commandes', 'icon' => 'fa-solid fa-bag-shopping', 'url' => route('admin.orders.index')],
                ['label' => 'Devis', 'icon' => 'fa-solid fa-file-invoice', 'url' => route('admin.quotes.index')],
                ['label' => 'Grand Jeu', 'icon' => 'fa-solid fa-trophy', 'url' => route('admin.game.index')],
                ['label' => 'Statistiques', 'icon' => 'fa-solid fa-chart-pie', 'url' => route('admin.stats.index')],
            ])),
            'urls' => [
                'realtime' => route('admin.dashboard.realtime'),
                'orders' => route('admin.orders.index'),
            ],
        ];

        return view('admin.home', ['dashboard' => $dashboard]);
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
