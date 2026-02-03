<?php

namespace App\Http\Controllers;

use App\Models\Menu;
use Illuminate\Http\Request;

class MenuController extends Controller
{
    public function show(string $slug)
    {
        $normalizedSlug = strtolower(trim($slug));
        if ($normalizedSlug === '' || in_array($normalizedSlug, ['accueil', 'home'], true)) {
            return redirect()->route('home');
        }

        $menu = Menu::query()->where('slug', $slug)->firstOrFail();

        $products = $menu->products()
            ->where('products.is_active', true)
            ->orderByDesc('products.created_at')
            ->paginate(12)
            ->withQueryString();

        $pageTitle = $menu->name;

        return view('menus.show', compact('menu', 'products', 'pageTitle'));
    }
}
