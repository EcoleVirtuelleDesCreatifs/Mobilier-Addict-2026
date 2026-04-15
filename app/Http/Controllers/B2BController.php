<?php

namespace App\Http\Controllers;

use App\Models\B2BCategory;
use App\Models\Product;
use Illuminate\Http\Request;

class B2BController extends Controller
{
    public function index()
    {
        $categories = B2BCategory::query()->active()->orderBy('id')->get();
        $products = Product::query()->active()->orderBy('name')->take(12)->get();
        return view('b2b.index', compact('categories', 'products'));
    }

    public function category($key)
    {
        $category = B2BCategory::query()->where('key', $key)->active()->firstOrFail();

        // Get products associated with this B2B category
        $products = $category->products()->active()->get();

        return view('b2b.category', compact('category', 'products'));
    }

    public function submitOrder(Request $request, $key)
    {
        $category = B2BCategory::query()->where('key', $key)->active()->firstOrFail();

        $validated = $request->validate([
            'products' => 'required|array|min:' . $category->min_products,
            'products.*' => 'required|integer|exists:products,id',
            'company_name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'phone' => 'required|string|max:255',
            'message' => 'nullable|string|max:1000',
        ], [
            'products.min' => 'Vous devez sélectionner au moins ' . $category->min_products . ' produits pour cette catégorie.',
        ]);

        // Here you would save the B2B order or send an email
        // For now, redirect with success message
        return redirect()->route('b2b.index')
            ->with('success', 'Votre demande de commande B2B a été envoyée avec succès. Nous vous contacterons bientôt.');
    }
}
