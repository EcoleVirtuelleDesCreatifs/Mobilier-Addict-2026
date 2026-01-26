<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\BlogPost;
use App\Models\Category;
use App\Models\NewsletterSubscription;
use App\Models\Product;
use App\Models\Section;
use App\Models\Slide;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

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
        $totalViews = (int) BlogPost::query()->sum('views_count');

        $monthlyViews = (int) BlogPost::query()
            ->whereBetween('created_at', [$selectedMonth, $monthEnd])
            ->sum('views_count');

        $monthlyVisitors = 0;

        $topArticles = BlogPost::query()
            ->with('category')
            ->whereBetween('created_at', [$selectedMonth, $monthEnd])
            ->orderByDesc('views_count')
            ->limit(5)
            ->get();

        $bestArticle = $topArticles->first();

        $categoryStats = collect();
        $bestCategory = null;

        return view('admin.dashboard', [
            'stats' => [
                'products' => Product::count(),
                'categories' => Category::count(),
                'posts' => BlogPost::count(),
                'slides' => Slide::count(),
                'newsletter' => NewsletterSubscription::count(),
            ],
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
        ]);
    }

    public function monthlyStats(Request $request): JsonResponse
    {
        $monthParam = $request->string('month')->trim()->toString();
        $selectedMonth = $monthParam ? Carbon::createFromFormat('Y-m', $monthParam)->startOfMonth() : Carbon::now()->startOfMonth();
        $monthEnd = $selectedMonth->copy()->endOfMonth();

        $monthlyViews = (int) BlogPost::query()
            ->whereBetween('created_at', [$selectedMonth, $monthEnd])
            ->sum('views_count');

        $monthlyVisitors = 0;

        $bestArticle = BlogPost::query()
            ->whereBetween('created_at', [$selectedMonth, $monthEnd])
            ->orderByDesc('views_count')
            ->first();

        return response()->json([
            'monthlyViews' => $monthlyViews,
            'monthlyVisitors' => $monthlyVisitors,
            'bestArticle' => $bestArticle,
            'bestCategory' => null,
        ]);
    }
}
