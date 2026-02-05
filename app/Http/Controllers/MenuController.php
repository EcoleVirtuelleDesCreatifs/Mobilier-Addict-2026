<?php

namespace App\Http\Controllers;

use App\Models\Menu;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class MenuController extends Controller
{
    public function show(string $slug)
    {
        $normalizedSlug = strtolower(trim($slug));
        if ($normalizedSlug === '' || in_array($normalizedSlug, ['accueil', 'home'], true)) {
            return redirect()->route('home');
        }

        $menu = Menu::query()->where('slug', $slug)->firstOrFail();

        $matelasModels = null;
        if (strtolower(trim((string) $menu->slug)) === 'matelas') {
            $all = $menu->products()
                ->where('products.is_active', true)
                ->orderByDesc('products.created_at')
                ->get();

            $want = [
                'MEDICOSOINS PH10 extra ferme' => ['medicosoins', 'ph10'],
                'Matelas Confort Soft' => ['confort', 'soft'],
                'Matelas Addict' => ['addict'],
                'Matelas Luxury' => ['luxury'],
            ];

            $matelasModels = collect($want)->map(function (array $tokens, string $label) use ($all) {
                $product = $all->first(function ($p) use ($tokens) {
                    $hay = Str::lower((string) ($p->name ?? ''));
                    foreach ($tokens as $t) {
                        if (!str_contains($hay, Str::lower($t))) {
                            return false;
                        }
                    }
                    return true;
                });

                return [
                    'label' => $label,
                    'product' => $product,
                ];
            })->values();
        }

        $products = $menu->products()
            ->where('products.is_active', true)
            ->orderByDesc('products.created_at')
            ->paginate(12)
            ->withQueryString();

        $pageTitle = $menu->name;

        return view('menus.show', compact('menu', 'products', 'pageTitle', 'matelasModels'));
    }
}
