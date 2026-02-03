<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\BlogPost;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Product;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Schema;

class StatsController extends Controller
{
    public function index(Request $request)
    {
        $monthParam = $request->string('month')->trim()->toString();
        $selectedMonth = $monthParam ? Carbon::createFromFormat('Y-m', $monthParam)->startOfMonth() : Carbon::now()->startOfMonth();
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

        $visitorsTotal = 0;
        $visitorsMonth = 0;

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
        ]);
    }
}
