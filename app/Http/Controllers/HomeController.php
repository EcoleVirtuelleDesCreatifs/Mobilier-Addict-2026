<?php

namespace App\Http\Controllers;

use App\Models\BlogPost;
use App\Models\Category;
use App\Models\Product;
use App\Models\Section;
use App\Models\Slide;

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
                    $query->active()->ordered()->withCount(['productsMany as products_rel_count'])->take(4);
                },
            ])
            ->get()
            ->keyBy('slug');

        $heroSlides = Slide::query()
            ->active()
            ->ordered()
            ->get();

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
            ->where(function ($q) use ($accessoryCategorySlugs) {
                $q->whereHas('categories', function ($query) use ($accessoryCategorySlugs) {
                    $query->whereIn('slug', $accessoryCategorySlugs);
                })->orWhereHas('category', function ($query) use ($accessoryCategorySlugs) {
                    $query->whereIn('slug', $accessoryCategorySlugs);
                });
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
        $mattressCategory = Category::query()
            ->where('slug', 'matelas')
            ->first();

        if (!$mattressCategory) {
            $mattressCategory = Category::query()
                ->where('name', 'like', '%matelas%')
                ->orderByRaw("CASE WHEN slug = 'matelas' THEN 0 ELSE 1 END")
                ->orderBy('id')
                ->first();
        }

        if ($mattressCategory) {
            $categoryIds = $this->collectCategoryAndDescendantIds($mattressCategory);
            $mattressProducts = Product::query()
                ->active()
                ->where(function ($q) use ($categoryIds) {
                    $q->whereHas('categories', fn ($qq) => $qq->whereIn('categories.id', $categoryIds))
                        ->orWhereIn('category_id', $categoryIds);
                })
                ->orderByDesc('created_at')
                ->take(12)
                ->get();

            if ($mattressProducts->isEmpty()) {
                $mattressProducts = Product::query()
                    ->where(function ($q) use ($categoryIds) {
                        $q->whereHas('categories', fn ($qq) => $qq->whereIn('categories.id', $categoryIds))
                            ->orWhereIn('category_id', $categoryIds);
                    })
                    ->orderByDesc('created_at')
                    ->take(12)
                    ->get();
            }

            if ($mattressProducts->isEmpty()) {
                $mattressProducts = Product::query()
                    ->active()
                    ->where(function ($q) {
                        $q->whereHas('categories', function ($query) {
                            $query->where('slug', 'matelas')
                                ->orWhere('slug', 'like', 'matelas%')
                                ->orWhere('name', 'like', '%matelas%');
                        })->orWhereHas('category', function ($query) {
                        $query->where('slug', 'matelas')
                            ->orWhere('slug', 'like', 'matelas%')
                            ->orWhere('name', 'like', '%matelas%');
                        });
                    })
                    ->orderByDesc('created_at')
                    ->take(12)
                    ->get();
            }
        } else {
            $mattressProducts = Product::query()
                ->active()
                ->where(function ($q) {
                    $q->whereHas('categories', function ($query) {
                        $query->where('slug', 'matelas')
                            ->orWhere('slug', 'like', 'matelas%')
                            ->orWhere('name', 'like', '%matelas%');
                    })->orWhereHas('category', function ($query) {
                    $query->where('slug', 'matelas')
                        ->orWhere('slug', 'like', 'matelas%')
                        ->orWhere('name', 'like', '%matelas%');
                    });
                })
                ->orderByDesc('created_at')
                ->take(12)
                ->get();

            if ($mattressProducts->isEmpty()) {
                $mattressProducts = Product::query()
                    ->where(function ($q) {
                        $q->whereHas('categories', function ($query) {
                            $query->where('slug', 'matelas')
                                ->orWhere('slug', 'like', 'matelas%')
                                ->orWhere('name', 'like', '%matelas%');
                        })->orWhereHas('category', function ($query) {
                        $query->where('slug', 'matelas')
                            ->orWhere('slug', 'like', 'matelas%')
                            ->orWhere('name', 'like', '%matelas%');
                        });
                    })
                    ->orderByDesc('created_at')
                    ->take(12)
                    ->get();
            }
        }

        $pillowProducts = collect();
        $pillowCategory = Category::query()
            ->where('slug', 'oreillers')
            ->first();

        if (!$pillowCategory) {
            $pillowCategory = Category::query()
                ->where('name', 'like', '%oreiller%')
                ->orderByRaw("CASE WHEN slug = 'oreillers' THEN 0 ELSE 1 END")
                ->orderBy('id')
                ->first();
        }

        if ($pillowCategory) {
            $categoryIds = $this->collectCategoryAndDescendantIds($pillowCategory);
            $pillowProducts = Product::query()
                ->active()
                ->where(function ($q) use ($categoryIds) {
                    $q->whereHas('categories', fn ($qq) => $qq->whereIn('categories.id', $categoryIds))
                        ->orWhereIn('category_id', $categoryIds);
                })
                ->orderByDesc('created_at')
                ->take(12)
                ->get();

            if ($pillowProducts->isEmpty()) {
                $pillowProducts = Product::query()
                    ->where(function ($q) use ($categoryIds) {
                        $q->whereHas('categories', fn ($qq) => $qq->whereIn('categories.id', $categoryIds))
                            ->orWhereIn('category_id', $categoryIds);
                    })
                    ->orderByDesc('created_at')
                    ->take(12)
                    ->get();
            }

            if ($pillowProducts->isEmpty()) {
                $pillowProducts = Product::query()
                    ->active()
                    ->where(function ($q) {
                        $q->whereHas('categories', function ($query) {
                            $query->where('slug', 'oreillers')
                                ->orWhere('slug', 'like', 'oreiller%')
                                ->orWhere('name', 'like', '%oreiller%');
                        })->orWhereHas('category', function ($query) {
                        $query->where('slug', 'oreillers')
                            ->orWhere('slug', 'like', 'oreiller%')
                            ->orWhere('name', 'like', '%oreiller%');
                        });
                    })
                    ->orderByDesc('created_at')
                    ->take(12)
                    ->get();
            }
        } else {
            $pillowProducts = Product::query()
                ->active()
                ->where(function ($q) {
                    $q->whereHas('categories', function ($query) {
                        $query->where('slug', 'oreillers')
                            ->orWhere('slug', 'like', 'oreiller%')
                            ->orWhere('name', 'like', '%oreiller%');
                    })->orWhereHas('category', function ($query) {
                    $query->where('slug', 'oreillers')
                        ->orWhere('slug', 'like', 'oreiller%')
                        ->orWhere('name', 'like', '%oreiller%');
                    });
                })
                ->orderByDesc('created_at')
                ->take(12)
                ->get();

            if ($pillowProducts->isEmpty()) {
                $pillowProducts = Product::query()
                    ->where(function ($q) {
                        $q->whereHas('categories', function ($query) {
                            $query->where('slug', 'oreillers')
                                ->orWhere('slug', 'like', 'oreiller%')
                                ->orWhere('name', 'like', '%oreiller%');
                        })->orWhereHas('category', function ($query) {
                        $query->where('slug', 'oreillers')
                            ->orWhere('slug', 'like', 'oreiller%')
                            ->orWhere('name', 'like', '%oreiller%');
                        });
                    })
                    ->orderByDesc('created_at')
                    ->take(12)
                    ->get();
            }
        }

        $drapsProducts = collect();
        $drapsCategory = Category::query()
            ->where('slug', 'draps')
            ->first();

        if (!$drapsCategory) {
            $drapsCategory = Category::query()
                ->where('slug', 'draps-couettes')
                ->first();
        }

        if (!$drapsCategory) {
            $drapsCategory = Category::query()
                ->where('name', 'like', '%drap%')
                ->orderByRaw("CASE WHEN slug IN ('draps', 'draps-couettes') THEN 0 ELSE 1 END")
                ->orderBy('id')
                ->first();
        }

        if ($drapsCategory) {
            $categoryIds = $this->collectCategoryAndDescendantIds($drapsCategory);
            $drapsProducts = Product::query()
                ->active()
                ->where(function ($q) use ($categoryIds) {
                    $q->whereHas('categories', fn ($qq) => $qq->whereIn('categories.id', $categoryIds))
                        ->orWhereIn('category_id', $categoryIds);
                })
                ->orderByDesc('created_at')
                ->take(12)
                ->get();

            if ($drapsProducts->isEmpty()) {
                $drapsProducts = Product::query()
                    ->where(function ($q) use ($categoryIds) {
                        $q->whereHas('categories', fn ($qq) => $qq->whereIn('categories.id', $categoryIds))
                            ->orWhereIn('category_id', $categoryIds);
                    })
                    ->orderByDesc('created_at')
                    ->take(12)
                    ->get();
            }

            if ($drapsProducts->isEmpty()) {
                $drapsProducts = Product::query()
                    ->active()
                    ->where(function ($q) {
                        $q->whereHas('categories', function ($query) {
                            $query->whereIn('slug', ['draps', 'draps-couettes', 'couettes'])
                                ->orWhere('slug', 'like', 'drap%')
                                ->orWhere('name', 'like', '%drap%')
                                ->orWhere('name', 'like', '%couette%');
                        })->orWhereHas('category', function ($query) {
                        $query->whereIn('slug', ['draps', 'draps-couettes', 'couettes'])
                            ->orWhere('slug', 'like', 'drap%')
                            ->orWhere('name', 'like', '%drap%')
                            ->orWhere('name', 'like', '%couette%');
                        });
                    })
                    ->orderByDesc('created_at')
                    ->take(12)
                    ->get();
            }
        } else {
            $drapsProducts = Product::query()
                ->active()
                ->where(function ($q) {
                    $q->whereHas('categories', function ($query) {
                        $query->whereIn('slug', ['draps', 'draps-couettes', 'couettes'])
                            ->orWhere('slug', 'like', 'drap%')
                            ->orWhere('name', 'like', '%drap%')
                            ->orWhere('name', 'like', '%couette%');
                    })->orWhereHas('category', function ($query) {
                    $query->whereIn('slug', ['draps', 'draps-couettes', 'couettes'])
                        ->orWhere('slug', 'like', 'drap%')
                        ->orWhere('name', 'like', '%drap%')
                        ->orWhere('name', 'like', '%couette%');
                    });
                })
                ->orderByDesc('created_at')
                ->take(12)
                ->get();

            if ($drapsProducts->isEmpty()) {
                $drapsProducts = Product::query()
                    ->where(function ($q) {
                        $q->whereHas('categories', function ($query) {
                            $query->whereIn('slug', ['draps', 'draps-couettes', 'couettes'])
                                ->orWhere('slug', 'like', 'drap%')
                                ->orWhere('name', 'like', '%drap%')
                                ->orWhere('name', 'like', '%couette%');
                        })->orWhereHas('category', function ($query) {
                        $query->whereIn('slug', ['draps', 'draps-couettes', 'couettes'])
                            ->orWhere('slug', 'like', 'drap%')
                            ->orWhere('name', 'like', '%drap%')
                            ->orWhere('name', 'like', '%couette%');
                        });
                    })
                    ->orderByDesc('created_at')
                    ->take(12)
                    ->get();
            }
        }

        return view('home', compact('homeSections', 'heroSlides', 'collectionProducts', 'accessoryProducts', 'favoriteProducts', 'blogFeaturedPost', 'blogPosts', 'mattressProducts', 'pillowProducts', 'drapsProducts'));
    }

    private function collectCategoryAndDescendantIds(Category $category)
    {
        $ids = collect([(int) $category->id]);
        $frontier = collect([(int) $category->id]);

        while ($frontier->isNotEmpty()) {
            $children = Category::query()
                ->whereIn('parent_id', $frontier)
                ->pluck('id')
                ->map(function ($v) {
                    return (int) $v;
                })
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
