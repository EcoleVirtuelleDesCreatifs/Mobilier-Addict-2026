<?php

namespace App\Http\Controllers;

use App\Models\BlogPost;
use App\Models\Category;
use App\Models\Product;
use App\Models\Section;

class HomeController extends Controller
{
    public function index()
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

        Section::query()->firstOrCreate(
            ['slug' => 'refuge'],
            [
                'badge' => 'Laissez-vous séduire',
                'badge_icon' => '✨',
                'title' => 'Créez Votre Refuge de Bien-Être',
                'description' => "Chaque nuit mérite d’être exceptionnelle. Découvrez nos univers pensés pour éveiller vos sens.",
                'background_color' => '#fde7f3',
                'type' => 'custom',
                'order' => 3,
                'is_active' => true,
            ]
        );

        Section::query()->firstOrCreate(
            ['slug' => 'oreillers'],
            [
                'badge' => 'Oreillers',
                'badge_icon' => '🛏️',
                'title' => 'Oreillers',
                'description' => null,
                'background_color' => null,
                'type' => 'custom',
                'order' => 10,
                'is_active' => true,
            ]
        );

        Section::query()->firstOrCreate(
            ['slug' => 'draps'],
            [
                'badge' => 'Draps',
                'badge_icon' => '🧺',
                'title' => 'Draps',
                'description' => null,
                'background_color' => null,
                'type' => 'custom',
                'order' => 11,
                'is_active' => true,
            ]
        );

        $homeSections = Section::query()
            ->active()
            ->whereIn('slug', ['categories', 'electro', 'refuge', 'oreillers', 'draps'])
            ->with([
                'categories' => function ($query) {
                    $query->active()->ordered()->withCount(['products as products_rel_count'])->take(4);
                },
            ])
            ->get()
            ->keyBy('slug');

        $collectionProducts = Product::query()
            ->active()
            ->collection()
            ->ordered()
            ->take(8)
            ->get();

        if ($collectionProducts->isEmpty()) {
            $collectionProducts = Product::query()
                ->active()
                ->ordered()
                ->take(8)
                ->get();
        }

        $accessoryCategorySlugs = ['oreillers', 'draps', 'couettes', 'protection'];
        $accessoryProducts = Product::query()
            ->active()
            ->whereHas('category', function ($query) use ($accessoryCategorySlugs) {
                $query->whereIn('slug', $accessoryCategorySlugs);
            })
            ->ordered()
            ->take(4)
            ->get();

        if ($accessoryProducts->isEmpty()) {
            $accessoryProducts = Product::query()
                ->active()
                ->ordered()
                ->take(4)
                ->get();
        }

        $favoriteProducts = Product::query()
            ->active()
            ->bestsellers()
            ->ordered()
            ->take(4)
            ->get();

        if ($favoriteProducts->count() < 4) {
            $featured = Product::query()
                ->active()
                ->featured()
                ->ordered()
                ->take(4)
                ->get();
            $favoriteProducts = $favoriteProducts->concat($featured)->unique('id')->take(4)->values();
        }

        if ($favoriteProducts->isEmpty()) {
            $favoriteProducts = Product::query()
                ->active()
                ->ordered()
                ->take(4)
                ->get();
        }

        if ($favoriteProducts->isEmpty()) {
            $favoriteProducts = Product::query()
                ->ordered()
                ->take(4)
                ->get();
        }

        $blogFeaturedPost = BlogPost::query()
            ->active()
            ->featured()
            ->ordered()
            ->with(['category'])
            ->first();

        $blogPosts = BlogPost::query()
            ->active()
            ->when($blogFeaturedPost, fn ($q) => $q->where('id', '!=', $blogFeaturedPost->id))
            ->ordered()
            ->with(['category'])
            ->take(3)
            ->get();

        if (!$blogFeaturedPost) {
            $items = BlogPost::query()
                ->active()
                ->ordered()
                ->with(['category'])
                ->take(4)
                ->get();
            $blogFeaturedPost = $items->first();
            $blogPosts = $items->slice(1, 3)->values();
        }

        $mattressProducts = collect();
        $mattressCategory = Category::query()->active()->where('slug', 'matelas')->first();
        if ($mattressCategory) {
            $categoryIds = $this->collectCategoryAndDescendantIds($mattressCategory);
            $mattressProducts = Product::query()
                ->active()
                ->whereIn('category_id', $categoryIds)
                ->orderByDesc('created_at')
                ->take(12)
                ->get();
        }

        return view('home', compact('homeSections', 'collectionProducts', 'accessoryProducts', 'favoriteProducts', 'blogFeaturedPost', 'blogPosts', 'mattressProducts'));
    }

    private function collectCategoryAndDescendantIds(Category $category)
    {
        $ids = collect([(int) $category->id]);
        $frontier = collect([(int) $category->id]);

        while ($frontier->isNotEmpty()) {
            $children = Category::query()
                ->whereIn('parent_id', $frontier)
                ->pluck('id')
                ->map(fn ($v) => (int) $v)
                ->values();

            $children = $children->diff($ids)->values();
            if ($children->isEmpty()) {
                break;
            }

            $ids = $ids->concat($children)->unique()->values();
            $frontier = $children;
        }

        return $ids;
    }
}
