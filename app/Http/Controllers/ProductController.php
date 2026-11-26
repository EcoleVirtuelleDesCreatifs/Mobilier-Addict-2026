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
            ->when(\Illuminate\Support\Facades\Schema::hasTable('menu_product'), fn ($q) => $q->with('menus'))
            ->where('slug', $slug)
            ->first();

        if (! $product) {
            // Ancienne adresse d'un produit renommé : redirection permanente.
            $target = \Illuminate\Support\Facades\Schema::hasTable('product_slug_redirects')
                ? Product::query()->whereKey(
                    \Illuminate\Support\Facades\DB::table('product_slug_redirects')->where('old_slug', $slug)->value('product_id')
                )->value('slug')
                : null;

            abort_unless($target, 404);

            return redirect()->route('product.show', $target, 301);
        }

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
