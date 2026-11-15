<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class CatalogueController extends Controller
{
    public function index(Request $request)
    {
        $filters = $request->validate([
            'q' => ['nullable', 'string', 'max:100'],
            'availability' => ['nullable', 'in:in,out'],
            'sort' => ['nullable', 'string', 'max:30'],
        ]);
        $isNew = $request->routeIs('nouveautes.index');
        $query = Product::query()->active()->with([
            'category', 'variants' => fn ($q) => $q->active()->orderBy('price'),
        ]);
        if ($isNew) {
            $query->where('price', '>', 0);
        }
        if ($search = trim($filters['q'] ?? '')) {
            $query->where('name', 'like', '%' . $search . '%');
        }
        match ($filters['availability'] ?? '') {
            'in' => $query->inStock(),
            'out' => $query->outOfStock(),
            default => null,
        };
        match ($filters['sort'] ?? ($isNew ? 'newest' : 'featured')) {
            'price-asc' => $query->orderBy('price'),
            'price-desc' => $query->orderByDesc('price'),
            'name-asc', 'az' => $query->orderBy('name'),
            'name-desc', 'za' => $query->orderByDesc('name'),
            'date-asc', 'oldest' => $query->orderBy('created_at'),
            'date-desc', 'newest' => $query->orderByDesc('created_at'),
            'bestseller', 'bestsellers' => $query->orderByDesc('reviews_count'),
            default => $query->ordered(),
        };
        $products = $query->paginate(12)->withQueryString();
        $pageTitle = $isNew ? 'Nouveautés' : 'Tous les produits';
        $pageMetaDescription = $isNew
            ? 'Découvrez les derniers produits Mobilier Addict : mobilier, matelas et literie à Abidjan. Paiement à la livraison.'
            : 'Découvrez notre catalogue de mobilier, matelas, literie et électroménager à Abidjan. Conseil personnalisé et paiement à la livraison.';
        return view('collection', compact('products', 'pageTitle', 'pageMetaDescription'));
    }
}
