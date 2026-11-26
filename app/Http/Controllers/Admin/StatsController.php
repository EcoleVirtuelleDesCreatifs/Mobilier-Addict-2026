<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\BlogPost;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\PageView;
use App\Models\Product;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class StatsController extends Controller
{
    public function index(Request $request)
    {
        $monthParam = $request->string('month')->trim()->toString();
        // Un mois mal formé dans l'URL ne doit pas provoquer d'erreur 500.
        $selectedMonth = preg_match('/^\d{4}-(0[1-9]|1[0-2])$/', $monthParam)
            ? Carbon::createFromFormat('!Y-m', $monthParam)->startOfMonth()
            : Carbon::now()->startOfMonth();
        $monthEnd = $selectedMonth->copy()->endOfMonth();

        $hasOrders = Schema::hasTable('orders');
        $hasOrderItems = Schema::hasTable('order_items');

        $ordersTotalCount = $hasOrders ? (int) Order::query()->count() : 0;
        $ordersMonthCount = $hasOrders ? (int) Order::query()->whereBetween('created_at', [$selectedMonth, $monthEnd])->count() : 0;

        $revenueTotal = $hasOrders ? (float) Order::query()->sum('total') : 0.0;
        $revenueMonth = $hasOrders ? (float) Order::query()->whereBetween('created_at', [$selectedMonth, $monthEnd])->sum('total') : 0.0;

        $productsOrderedTotal = $hasOrderItems ? (int) OrderItem::query()->sum('quantity') : 0;
        $productsOrderedMonth = $hasOrderItems
            ? (int) OrderItem::query()->whereBetween('created_at', [$selectedMonth, $monthEnd])->sum('quantity')
            : 0;

        $avgOrderValue = $ordersTotalCount > 0 ? $revenueTotal / $ordersTotalCount : 0.0;

        $productsTotal = (int) Product::query()->count();

        $hasViewsCount = Schema::hasColumn('blog_posts', 'views_count');
        $articleViewsTotal = $hasViewsCount ? (int) BlogPost::query()->sum('views_count') : 0;
        $articleViewsMonth = $hasViewsCount
            ? (int) BlogPost::query()->whereBetween('created_at', [$selectedMonth, $monthEnd])->sum('views_count')
            : 0;

        // Visiteurs uniques localisés dans le pays cible (Côte d'Ivoire par défaut).
        $hasPageViews = Schema::hasTable('page_views');
        $hasGeo = $hasPageViews && Schema::hasColumn('page_views', 'city');
        $visitorsTotal = $hasPageViews ? (int) PageView::query()->targetCountry()->distinct()->count('visitor_id') : 0;
        $visitorsMonth = $hasPageViews
            ? (int) PageView::query()->targetCountry()->whereBetween('created_at', [$selectedMonth, $monthEnd])->distinct()->count('visitor_id')
            : 0;
        $pageViewsMonth = $hasPageViews
            ? (int) PageView::query()->targetCountry()->whereBetween('created_at', [$selectedMonth, $monthEnd])->count()
            : 0;

        $geoBreakdown = function (string $column) use ($hasGeo, $selectedMonth, $monthEnd) {
            if (! $hasGeo) {
                return collect();
            }

            return PageView::query()->targetCountry()
                ->select($column, DB::raw('COUNT(DISTINCT visitor_id) as visitors'), DB::raw('COUNT(*) as views'))
                ->whereBetween('created_at', [$selectedMonth, $monthEnd])
                ->whereNotNull('country_code')
                ->groupBy($column)
                ->orderByDesc('visitors')
                ->limit(15)
                ->get()
                ->map(fn ($r) => [
                    'label' => $r->{$column} ?: 'Non précisé',
                    'visitors' => (int) $r->visitors,
                    'views' => (int) $r->views,
                ]);
        };
        $cities = $geoBreakdown('city');
        $regions = $geoBreakdown('region');

        return view('admin.stats.index', [
            'currentMonth' => $selectedMonth->translatedFormat('F Y'),
            'monthValue' => $selectedMonth->format('Y-m'),
            'hasOrders' => $hasOrders,
            'ordersTotalCount' => $ordersTotalCount,
            'ordersMonthCount' => $ordersMonthCount,
            'revenueTotal' => $revenueTotal,
            'revenueMonth' => $revenueMonth,
            'avgOrderValue' => $avgOrderValue,
            'productsTotal' => $productsTotal,
            'productsOrderedTotal' => $productsOrderedTotal,
            'productsOrderedMonth' => $productsOrderedMonth,
            'articleViewsTotal' => $articleViewsTotal,
            'articleViewsMonth' => $articleViewsMonth,
            'visitorsTotal' => $visitorsTotal,
            'visitorsMonth' => $visitorsMonth,
            'pageViewsMonth' => $pageViewsMonth,
            'cities' => $cities,
            'regions' => $regions,
            'countryName' => PageView::targetCountry() ? config('maquette.analytics_country_name') : null,
        ]);
    }
}
