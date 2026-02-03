<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\BlogPost;
use App\Models\Category;
use App\Models\Menu;
use App\Models\NewsletterSubscription;
use App\Models\Order;
use App\Models\Product;
use App\Models\Section;
use App\Models\Slide;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Schema;

class DashboardController extends Controller
{
    public function index(Request $request)
    {
        Section::query()->firstOrCreate(
            ['slug' => 'categories'],
            [
                'badge' => 'Explorez nos univers',
                'badge_icon' => '🛒',
                'title' => 'Trouvez Votre Bonheur',
                'description' => null,
                'background_color' => null,
                'type' => 'categories',
                'order' => 1,
                'is_active' => true,
            ]
        );

        Section::query()->firstOrCreate(
            ['slug' => 'electro'],
            [
                'badge' => 'Électroménager & Meubles',
                'badge_icon' => '🔌',
                'title' => 'Équipez Votre Maison',
                'description' => null,
                'background_color' => null,
                'type' => 'categories',
                'order' => 2,
                'is_active' => true,
            ]
        );

        $homeSections = Section::query()->whereIn('slug', ['categories', 'electro'])->get()->keyBy('slug');

        $monthParam = $request->string('month')->trim()->toString();
        $selectedMonth = $monthParam ? Carbon::createFromFormat('Y-m', $monthParam)->startOfMonth() : Carbon::now()->startOfMonth();
        $monthEnd = $selectedMonth->copy()->endOfMonth();

        $articlesCount = BlogPost::count();
        $categoriesCount = Category::count();
        $usersCount = User::count();
        $hasViewsCount = Schema::hasColumn('blog_posts', 'views_count');
        $totalViews = $hasViewsCount ? (int) BlogPost::query()->sum('views_count') : 0;

        $monthlyViews = $hasViewsCount
            ? (int) BlogPost::query()
                ->whereBetween('created_at', [$selectedMonth, $monthEnd])
                ->sum('views_count')
            : 0;

        $monthlyVisitors = 0;

        $topArticlesQuery = BlogPost::query()
            ->with('category')
            ->whereBetween('created_at', [$selectedMonth, $monthEnd]);

        if ($hasViewsCount) {
            $topArticlesQuery->orderByDesc('views_count');
        } else {
            $topArticlesQuery->orderByDesc('created_at');
        }

        $topArticles = $topArticlesQuery->limit(5)->get();

        $bestArticle = $topArticles->first();

        $categoryStats = collect();
        $bestCategory = null;

        $ordersMissing = !Schema::hasTable('orders');
        $ordersTotalCount = 0;
        $ordersPendingCount = 0;
        $ordersDeliveredCount = 0;
        $ordersMonthCount = 0;
        $revenueTotal = 0;
        $revenueMonth = 0;
        $latestOrders = collect();

        if (!$ordersMissing) {
            $ordersTotalCount = Order::query()->count();
            $ordersPendingCount = Order::query()->where('status', 'pending')->count();
            $ordersDeliveredCount = Order::query()->where('status', 'delivered')->count();
            $ordersMonthCount = Order::query()->whereBetween('created_at', [$selectedMonth, $monthEnd])->count();
            $revenueTotal = (float) Order::query()->sum('total');
            $revenueMonth = (float) Order::query()->whereBetween('created_at', [$selectedMonth, $monthEnd])->sum('total');
            $latestOrders = Order::query()->orderByDesc('created_at')->limit(6)->get();
        }

        $lowStockCount = Product::query()->where('stock', '<=', 5)->count();
        $productsOnlineCount = Product::query()->where('is_active', true)->count();
        $productsOfflineCount = Product::query()->where('is_active', false)->count();
        $latestProducts = Product::query()->orderByDesc('created_at')->limit(6)->get();

        $headerMenus = Menu::query()
            ->active()
            ->where('position', 'header')
            ->whereNull('parent_id')
            ->with(['children'])
            ->orderBy('order')
            ->limit(12)
            ->get();

        return view('admin.dashboard', [
            'stats' => [
                'products' => Product::count(),
                'categories' => Category::count(),
                'posts' => BlogPost::count(),
                'slides' => Slide::count(),
                'newsletter' => NewsletterSubscription::count(),
            ],
            'headerMenus' => $headerMenus,
            'homeSections' => $homeSections,
            'currentMonth' => $selectedMonth->translatedFormat('F Y'),
            'articlesCount' => $articlesCount,
            'categoriesCount' => $categoriesCount,
            'usersCount' => $usersCount,
            'totalViews' => $totalViews,
            'monthlyViews' => $monthlyViews,
            'monthlyVisitors' => $monthlyVisitors,
            'bestArticle' => $bestArticle,
            'bestCategory' => $bestCategory,
            'topArticles' => $topArticles,
            'categoryStats' => $categoryStats,
            'ordersMissing' => $ordersMissing,
            'ordersTotalCount' => $ordersTotalCount,
            'ordersPendingCount' => $ordersPendingCount,
            'ordersDeliveredCount' => $ordersDeliveredCount,
            'ordersMonthCount' => $ordersMonthCount,
            'revenueTotal' => $revenueTotal,
            'revenueMonth' => $revenueMonth,
            'latestOrders' => $latestOrders,
            'lowStockCount' => $lowStockCount,
            'productsOnlineCount' => $productsOnlineCount,
            'productsOfflineCount' => $productsOfflineCount,
            'latestProducts' => $latestProducts,
        ]);
    }

    public function monthlyStats(Request $request): JsonResponse
    {
        $monthParam = $request->string('month')->trim()->toString();
        $selectedMonth = $monthParam ? Carbon::createFromFormat('Y-m', $monthParam)->startOfMonth() : Carbon::now()->startOfMonth();
        $monthEnd = $selectedMonth->copy()->endOfMonth();

        $hasViewsCount = Schema::hasColumn('blog_posts', 'views_count');
        $monthlyViews = $hasViewsCount
            ? (int) BlogPost::query()
                ->whereBetween('created_at', [$selectedMonth, $monthEnd])
                ->sum('views_count')
            : 0;

        $monthlyVisitors = 0;

        $bestArticleQuery = BlogPost::query()->whereBetween('created_at', [$selectedMonth, $monthEnd]);
        if ($hasViewsCount) {
            $bestArticleQuery->orderByDesc('views_count');
        } else {
            $bestArticleQuery->orderByDesc('created_at');
        }
        $bestArticle = $bestArticleQuery->first();

        return response()->json([
            'monthlyViews' => $monthlyViews,
            'monthlyVisitors' => $monthlyVisitors,
            'bestArticle' => $bestArticle,
            'bestCategory' => null,
        ]);
    }
}
