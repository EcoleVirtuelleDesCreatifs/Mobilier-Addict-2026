<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\PageView;
use App\Models\Product;
use App\Support\TrafficSource;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Str;

class StatsController extends Controller
{
    public function index(Request $request)
    {
        $monthParam = $request->string('month')->trim()->toString();
        // Un mois mal formé dans l'URL ne doit pas provoquer d'erreur 500.
        $start = preg_match('/^\d{4}-(0[1-9]|1[0-2])$/', $monthParam)
            ? Carbon::createFromFormat('!Y-m', $monthParam)->startOfMonth()
            : Carbon::now()->startOfMonth();
        $end = $start->copy()->endOfMonth();
        $prevStart = $start->copy()->subMonthNoOverflow()->startOfMonth();
        $prevEnd = $prevStart->copy()->endOfMonth();
        // Mois en cours : on compare à la même période du mois précédent (jour 1 → aujourd'hui).
        if ($start->isSameMonth(now())) {
            $prevEnd = $prevStart->copy()->addDays(now()->day - 1)->endOfDay()->min($prevStart->copy()->endOfMonth());
        }

        $hasViews = Schema::hasTable('page_views');
        $hasGeo = $hasViews && Schema::hasColumn('page_views', 'city');
        $hasOrigin = $hasViews && Schema::hasColumn('page_views', 'source');
        $hasOrders = Schema::hasTable('orders');
        $hasItems = Schema::hasTable('order_items');

        $views = fn ($from, $to) => PageView::query()->targetCountry()->whereBetween('created_at', [$from, $to]);
        $orders = fn ($from, $to) => Order::query()->whereBetween('created_at', [$from, $to])->where('status', '<>', 'canceled');

        $period = function ($from, $to) use ($hasViews, $hasOrders, $views, $orders) {
            $visitors = $hasViews ? (int) $views($from, $to)->distinct()->count('visitor_id') : 0;
            $pages = $hasViews ? (int) $views($from, $to)->count() : 0;
            $count = $hasOrders ? (int) $orders($from, $to)->count() : 0;
            $revenue = $hasOrders ? (float) $orders($from, $to)->sum('total') : 0.0;

            return [
                'visitors' => $visitors,
                'pages' => $pages,
                'orders' => $count,
                'revenue' => $revenue,
                'basket' => $count ? $revenue / $count : 0.0,
                'conversion' => $visitors ? $count / $visitors * 100 : 0.0,
            ];
        };

        $current = $period($start, $end);
        $previous = $period($prevStart, $prevEnd);

        // Courbe jour par jour
        $days = collect();
        for ($d = $start->copy(); $d->lte($end); $d->addDay()) {
            $days->put($d->toDateString(), ['visitors' => 0, 'orders' => 0, 'revenue' => 0.0]);
        }
        if ($hasViews) {
            $views($start, $end)->select(DB::raw('DATE(created_at) as d'), DB::raw('COUNT(DISTINCT visitor_id) as n'))
                ->groupBy('d')->get()
                ->each(function ($r) use ($days) {
                    if ($days->has($r->d)) {
                        $days->put($r->d, array_merge($days->get($r->d), ['visitors' => (int) $r->n]));
                    }
                });
        }
        if ($hasOrders) {
            $orders($start, $end)->select(DB::raw('DATE(created_at) as d'), DB::raw('COUNT(*) as n'), DB::raw('SUM(total) as t'))
                ->groupBy('d')->get()
                ->each(function ($r) use ($days) {
                    if ($days->has($r->d)) {
                        $days->put($r->d, array_merge($days->get($r->d), ['orders' => (int) $r->n, 'revenue' => (float) $r->t]));
                    }
                });
        }

        // Parcours d'achat (visiteurs uniques)
        $step = fn (?array $routes) => $hasViews
            ? (int) $views($start, $end)->when($routes, fn ($q) => $q->whereIn('route_name', $routes))->distinct()->count('visitor_id')
            : 0;
        $funnel = [
            ['label' => 'Visiteurs', 'value' => $current['visitors']],
            ['label' => 'Ont vu un produit', 'value' => $step(['product.show'])],
            ['label' => 'Ont ouvert le panier', 'value' => $step(['cart.index', 'cart.shipping'])],
            ['label' => 'Commandes', 'value' => $current['orders']],
        ];

        $geo = function (string $column) use ($hasGeo, $views, $start, $end) {
            return $hasGeo
                ? $views($start, $end)->select($column, DB::raw('COUNT(DISTINCT visitor_id) as visitors'))
                    ->whereNotNull('country_code')->groupBy($column)->orderByDesc('visitors')->limit(10)->get()
                    ->map(fn ($r) => ['label' => $r->{$column} ?: 'Non précisé', 'value' => (int) $r->visitors])
                : collect();
        };

        $sources = $hasOrigin
            ? $views($start, $end)->select('source', 'medium', DB::raw('COUNT(DISTINCT visitor_id) as visitors'))
                ->whereNotNull('source')->where('medium', '<>', 'internal')
                ->groupBy('source', 'medium')->orderByDesc('visitors')->limit(8)->get()
                ->map(fn ($r) => ['label' => $r->source, 'detail' => TrafficSource::MEDIUM_LABELS[$r->medium] ?? $r->medium, 'value' => (int) $r->visitors])
            : collect();

        $viewed = $hasViews
            ? $views($start, $end)->select('path', DB::raw('COUNT(*) as views'))->where('route_name', 'product.show')
                ->groupBy('path')->orderByDesc('views')->limit(8)->get()
            : collect();
        $products = Product::query()->whereIn('slug', $viewed->map(fn ($r) => Str::afterLast($r->path, 'produit/')))->get(['id', 'name', 'slug'])->keyBy('slug');
        $topViewed = $viewed->map(function ($r) use ($products) {
            $product = $products->get(Str::afterLast($r->path, 'produit/'));

            return ['label' => $product?->name ?? Str::afterLast($r->path, '/'), 'value' => (int) $r->views, 'url' => $product ? route('admin.products.edit', $product) : null];
        });

        $topSold = $hasItems
            ? OrderItem::query()->select('product_name', DB::raw('SUM(quantity) as qty'), DB::raw('SUM(line_total) as total'))
                ->whereBetween('created_at', [$start, $end])->groupBy('product_name')->orderByDesc('qty')->limit(8)->get()
                ->map(fn ($r) => ['label' => $r->product_name, 'value' => (int) $r->qty, 'total' => (float) $r->total])
            : collect();

        return view('admin.stats.index', [
            'currentMonth' => $start->translatedFormat('F Y'),
            'previousMonth' => $prevStart->translatedFormat('F'),
            'monthValue' => $start->format('Y-m'),
            'prevMonthValue' => $prevStart->format('Y-m'),
            'nextMonthValue' => $start->isSameMonth(now()) ? null : $start->copy()->addMonthNoOverflow()->format('Y-m'),
            'isPartialCompare' => $start->isSameMonth(now()),
            'current' => $current,
            'previous' => $previous,
            'days' => $days,
            'funnel' => $funnel,
            'cities' => $geo('city'),
            'regions' => $geo('region'),
            'sources' => $sources,
            'topViewed' => $topViewed,
            'topSold' => $topSold,
            'countryName' => PageView::targetCountry() ? config('maquette.analytics_country_name') : null,
            'hasViews' => $hasViews,
        ]);
    }
}
