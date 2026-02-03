<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class SearchController extends Controller
{
    public function index(Request $request)
    {
        $q = trim((string) $request->query('q', ''));

        $products = collect();
        if ($q !== '') {
            $products = Product::query()
                ->active()
                ->where(function ($query) use ($q) {
                    $query
                        ->where('name', 'like', '%' . $q . '%')
                        ->orWhere('short_description', 'like', '%' . $q . '%');
                })
                ->orderBy('order', 'asc')
                ->limit(40)
                ->get();
        }

        return view('search', [
            'q' => $q,
            'products' => $products,
        ]);
    }

    public function suggest(Request $request)
    {
        $q = trim((string) $request->query('q', ''));

        if (mb_strlen($q) < 2) {
            return response()->json([]);
        }

        $products = Product::query()
            ->active()
            ->where(function ($query) use ($q) {
                $query
                    ->where('name', 'like', '%' . $q . '%')
                    ->orWhere('short_description', 'like', '%' . $q . '%');
            })
            ->orderBy('order', 'asc')
            ->limit(8)
            ->get(['id', 'name', 'slug', 'image', 'price']);

        return response()->json(
            $products->map(function ($p) {
                return [
                    'name' => $p->name,
                    'slug' => $p->slug,
                    'image' => $p->image,
                    'price' => number_format((float) $p->price, 0, ',', '.') . 'F',
                ];
            })->values()
        );
    }
}
