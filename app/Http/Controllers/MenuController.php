<?php

namespace App\Http\Controllers;

use App\Models\Menu;
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
        $matelasCategories = null;
        $matelasCategoryGroups = null;
        $isProtegeMatelas = strtolower(trim((string) $menu->slug)) === 'protege-matelas';
        $isOreillersEtTaies = strtolower(trim((string) $menu->slug)) === 'oreillers-et-taies';
        $isDrapEtCouettes = strtolower(trim((string) $menu->slug)) === 'drap-et-couettes';

        if (strtolower(trim((string) $menu->slug)) === 'matelas') {
            $inferCategory = function ($product): array {
                $firmness = Str::lower(trim((string) ($product->firmness ?? '')));
                $name = Str::lower((string) ($product->name ?? ''));

                $key = '';
                if ($firmness !== '') {
                    $key = $firmness;
                } elseif (str_contains($name, 'luxury')) {
                    $key = 'luxury';
                } elseif (str_contains($name, 'extra') && str_contains($name, 'ferme')) {
                    $key = 'extra_ferme';
                } elseif (str_contains($name, 'ferme')) {
                    $key = 'ferme';
                } elseif (str_contains($name, 'soft') || str_contains($name, 'confort')) {
                    $key = 'soft';
                } else {
                    $key = 'confort';
                }

                $key = str_replace([' ', '-'], '_', $key);
                $label = match ($key) {
                    'extra_ferme', 'extraferme' => 'Extra ferme',
                    'ferme' => 'Ferme',
                    'soft', 'souple' => 'Soft',
                    'equilibre', 'equilibré', 'equilibre_' => 'Équilibré',
                    'luxury', 'luxe' => 'Luxury',
                    default => 'Confort',
                };

                return ['key' => $key, 'label' => $label];
            };

            $all = $menu->products()
                ->with([
                    'variants' => fn($q) => $q->active()->orderBy('thickness_cm')->orderBy('places'),
                ])
                ->where('products.is_active', true)
                ->orderByDesc('products.created_at')
                ->get();

            $matelasCategoryGroups = $all
                ->map(function ($p) use ($inferCategory) {
                    $cat = $inferCategory($p);
                    return ['product' => $p, 'category' => $cat];
                })
                ->groupBy(fn($row) => (string) ($row['category']['key'] ?? 'confort'))
                ->map(function ($rows, string $key) {
                    $first = $rows->first();
                    return [
                        'key' => $key,
                        'label' => (string) (($first['category']['label'] ?? null) ?: 'Confort'),
                        'products' => $rows->map(fn($r) => $r['product'])->filter()->values(),
                    ];
                })
                ->values();

            $order = ['extra_ferme', 'ferme', 'soft', 'equilibre', 'luxury', 'confort'];
            $matelasCategoryGroups = $matelasCategoryGroups
                ->sortBy(function ($g) use ($order) {
                    $idx = array_search((string) ($g['key'] ?? ''), $order, true);
                    return $idx === false ? 999 : $idx;
                })
                ->values();

            $want = [
                'MEDICOSOINS PH10 extra ferme' => ['medicosoins', 'ph10'],
                'Matelas Confort Soft' => ['confort', 'soft'],
                'Matelas Addict' => ['addict'],
                'Matelas Luxury' => ['luxury'],
            ];

            $matelasModels = collect($want)->map(function (array $tokens, string $label) use ($all, $inferCategory) {
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
                    'category' => $product ? $inferCategory($product) : null,
                ];
            })->values();

            $pickedIds = $matelasModels
                ->map(fn($row) => $row['product']?->id)
                ->filter()
                ->unique()
                ->values();

            $extras = $all
                ->whereNotIn('id', $pickedIds->all())
                ->take(6)
                ->map(function ($p) use ($inferCategory) {
                    return [
                        'label' => (string) ($p->name ?? 'Matelas'),
                        'product' => $p,
                        'category' => $inferCategory($p),
                    ];
                })
                ->values();

            $matelasModels = $matelasModels
                ->filter(fn($row) => !empty($row['product']))
                ->merge($extras)
                ->take(10)
                ->values();

            $matelasCategories = $matelasModels
                ->map(fn($row) => $row['category'] ?? null)
                ->filter()
                ->unique('key')
                ->values();

            if ($matelasCategoryGroups) {
                $matelasCategories = $matelasCategoryGroups
                    ->map(fn($g) => ['key' => $g['key'], 'label' => $g['label']])
                    ->unique('key')
                    ->values();
            }
        }

        $products = $menu->products()
            ->with([
                'variants' => fn($q) => $q->active()->orderBy('thickness_cm')->orderBy('places'),
            ])
            ->where('products.is_active', true)
            ->orderByDesc('products.created_at')
            ->paginate(12)
            ->withQueryString();

        $pageTitle = $menu->name;

        return view('menus.show', compact('menu', 'products', 'pageTitle', 'matelasModels', 'matelasCategories', 'matelasCategoryGroups', 'isProtegeMatelas', 'isOreillersEtTaies', 'isDrapEtCouettes'));
    }
}
