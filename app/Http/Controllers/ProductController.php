<?php

namespace App\Http\Controllers;

use App\Models\Product;

class ProductController extends Controller
{
    public function show($slug)
    {
        $product = Product::query()
            ->with([
                'category',
                'categories',
                'variants' => fn ($q) => $q->active()->orderBy('thickness_cm')->orderBy('places'),
            ])
            ->where('slug', $slug)
            ->firstOrFail();

        $primaryCategory = $product->categories->first() ?: $product->category;

        $relatedProducts = Product::query()
            ->when($primaryCategory, function ($q) use ($primaryCategory, $product) {
                $q->where('id', '!=', $product->id)
                    ->where(function ($qq) use ($primaryCategory) {
                        $qq->whereHas('categories', fn ($qqq) => $qqq->where('categories.id', $primaryCategory->id))
                            ->orWhere('category_id', $primaryCategory->id);
                    });
            }, fn ($q) => $q->whereRaw('1=0'))
            ->take(4)
            ->get();

        return view('products.show', compact('product', 'relatedProducts'));
    }
}
