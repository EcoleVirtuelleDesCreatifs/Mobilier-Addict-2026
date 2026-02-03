<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;

class UniversController extends Controller
{
    public function show(string $slug)
    {
        $fallbackPages = [
            'hotellerie' => [
                'title' => 'Hôtellerie',
                'description' => "Solutions professionnelles pour hôtels, chambres d'hôtes et résidences de tourisme.",
            ],
            'entrez-dans-lunivers-de-vos-nuits' => [
                'title' => "Entrez dans l'univers de vos nuits",
                'description' => "Matelas, lits, draps et ambiance réunis dans un seul espace pour imaginer des nuits paisibles et élégantes.",
            ],
            'appartement-meuble' => [
                'title' => 'Appartement Meublé',
                'description' => 'Des essentiels confortables et durables pour équiper vos locations et appartements.',
            ],
            'studio' => [
                'title' => 'Studio',
                'description' => 'Optimisez l’espace sans sacrifier le confort : matelas et literie adaptés.',
            ],
            'famille' => [
                'title' => 'Famille',
                'description' => 'Matelas pour toute la famille, du bébé aux grands-parents.',
            ],
            'protection' => [
                'title' => 'Protège-Matelas',
                'description' => 'Protection, hygiène et confort : prolongez la durée de vie de votre literie.',
            ],
            'electromenager' => [
                'title' => 'Électroménager',
                'description' => 'Des équipements essentiels pour simplifier votre quotidien.',
            ],
            'matelas' => [
                'title' => 'Matelas',
                'description' => 'Du ferme au moelleux, trouvez votre équilibre parfait.',
            ],
            'oreillers' => [
                'title' => 'Oreillers',
                'description' => 'Confort et maintien pour des nuits réparatrices.',
            ],
            'draps-couettes' => [
                'title' => 'Draps & Couettes',
                'description' => 'Des matières douces et respirantes pour un sommeil premium.',
            ],
            'lits-sommiers' => [
                'title' => 'Lits & Sommiers',
                'description' => 'Structures élégantes et robustes pour sublimer votre chambre.',
            ],
            'cuisine' => [
                'title' => 'Cuisine',
                'description' => 'Gazinière, mixeur, bouilloire, réfrigérateur, congélateur et plus.',
            ],
            'froid-climatisation' => [
                'title' => 'Froid & Climatisation',
                'description' => 'Climatiseurs, ventilateurs et solutions de refroidissement.',
            ],
            'salon' => [
                'title' => 'Salon',
                'description' => 'Canapés, fauteuils et meubles pour votre espace de vie.',
            ],
            'multi-media' => [
                'title' => 'Multi-Média',
                'description' => 'Télévisions, woofers, accessoires audio et vidéo.',
            ],
        ];

        $category = Category::query()->where('slug', $slug)->first();

        $sleepSpaceSlugs = ['hotellerie', 'entrez-dans-lunivers-de-vos-nuits', 'appartement-meuble', 'studio', 'famille'];
        $filterCategory = $category;
        if (!$filterCategory && in_array($slug, $sleepSpaceSlugs, true)) {
            $filterCategory = Category::query()->where('slug', 'matelas')->first();
        }

        $pageTitle = $category?->name ?? ($fallbackPages[$slug]['title'] ?? null);
        if (!$pageTitle) {
            abort(404);
        }

        $pageDescription = $category?->description ?? ($fallbackPages[$slug]['description'] ?? null);

        $productsQuery = Product::query()->active();

        if ($filterCategory) {
            $categoryIds = $this->collectCategoryAndDescendantIds($filterCategory);

            $productsQuery->whereIn('category_id', $categoryIds);
        } else {
            $productsQuery->whereRaw('1=0');
        }

        $products = $productsQuery
            ->orderBy('created_at', 'desc')
            ->paginate(12)
            ->withQueryString();

        $promoProducts = Product::query()
            ->active()
            ->when($filterCategory, function ($q) use ($filterCategory) {
                $categoryIds = $this->collectCategoryAndDescendantIds($filterCategory);
                $q->whereIn('category_id', $categoryIds);
            })
            ->when(!$filterCategory, fn ($q) => $q->whereRaw('1=0'))
            ->whereNotNull('discount_percent')
            ->orderByDesc('discount_percent')
            ->limit(4)
            ->get();

        $mattressProducts = collect();
        if ($slug === 'lits-sommiers') {
            $mattressCategory = Category::query()->active()->where('slug', 'matelas')->first();
            $mattressProducts = Product::query()
                ->active()
                ->when($mattressCategory, fn ($q) => $q->where('category_id', $mattressCategory->id))
                ->orderBy('created_at', 'desc')
                ->limit(4)
                ->get();
        }

        return view('univers.show', compact('slug', 'category', 'pageTitle', 'pageDescription', 'products', 'promoProducts', 'mattressProducts'));
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
