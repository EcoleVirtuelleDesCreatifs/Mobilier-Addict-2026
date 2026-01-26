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

        $category = Category::query()->active()->where('slug', $slug)->first();

        $sleepSpaceSlugs = ['hotellerie', 'appartement-meuble', 'studio', 'famille'];
        $filterCategory = $category;
        if (!$filterCategory && in_array($slug, $sleepSpaceSlugs, true)) {
            $filterCategory = Category::query()->active()->where('slug', 'matelas')->first();
        }

        $pageTitle = $category?->name ?? ($fallbackPages[$slug]['title'] ?? null);
        if (!$pageTitle) {
            abort(404);
        }

        $pageDescription = $category?->description ?? ($fallbackPages[$slug]['description'] ?? null);

        $products = Product::query()
            ->active()
            ->when($filterCategory, fn ($q) => $q->where('category_id', $filterCategory->id))
            ->orderBy('created_at', 'desc')
            ->paginate(12)
            ->withQueryString();

        $promoProducts = Product::query()
            ->active()
            ->when($filterCategory, fn ($q) => $q->where('category_id', $filterCategory->id))
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
}
