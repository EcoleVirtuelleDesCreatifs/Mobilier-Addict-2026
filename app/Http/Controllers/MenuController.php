<?php

namespace App\Http\Controllers;

use App\Models\Menu;
use App\Models\Category;
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

        // Load categories for this menu
        $menuCategories = Category::query()
            ->where('is_active', true)
            ->whereHas('menus', function($query) use ($menu) {
                $query->where('menus.id', $menu->id);
            })
            ->withCount(['products' => fn($q) => $q->where('is_active', true)])
            ->orderBy('order')
            ->get();

        $matelasModels = null;
        $matelasCategories = null;
        $matelasCategoryGroups = null;
        $isProtegeMatelas = strtolower(trim((string) $menu->slug)) === 'protege-matelas';

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

        $sort = (string) request()->query('sort', 'featured');

        $productsQuery = $menu->products()
            ->with([
                'variants' => fn($q) => $q->active()->orderBy('thickness_cm')->orderBy('places'),
            ])
            ->where('products.is_active', true);

        match (request()->query('availability')) {
            'in' => $productsQuery->where('products.stock', '>', 0),
            'out' => $productsQuery->where('products.stock', '<=', 0),
            default => null,
        };

        $comfortSelected = array_filter((array) request()->query('comfort', []));
        if ($comfortSelected && strtolower(trim((string) $menu->slug)) === 'matelas') {
            $productsQuery->where(function ($q) use ($comfortSelected) {
                foreach ($comfortSelected as $key) {
                    $k = strtolower((string) $key);
                    $q->orWhereRaw("LOWER(REPLACE(REPLACE(products.firmness, ' ', '_'), '-', '_')) LIKE ?", ["%{$k}%"])
                        ->orWhereRaw('LOWER(products.name) LIKE ?', ['%' . str_replace('_', ' ', $k) . '%']);
                }
            });
        }

        $minPrice = request()->query('price_min');
        $maxPrice = request()->query('price_max');
        if (is_numeric($minPrice)) {
            $productsQuery->where('products.price', '>=', (float) $minPrice);
        }
        if (is_numeric($maxPrice)) {
            $productsQuery->where('products.price', '<=', (float) $maxPrice);
        }

        match ($sort) {
            'bestseller', 'bestsellers' => $productsQuery
                ->orderByDesc('products.reviews_count')
                ->orderByDesc('products.created_at'),
            'name-asc', 'az' => $productsQuery->orderBy('products.name'),
            'name-desc', 'za' => $productsQuery->orderByDesc('products.name'),
            'price-asc' => $productsQuery->orderBy('products.price'),
            'price-desc' => $productsQuery->orderByDesc('products.price'),
            'date-asc', 'oldest' => $productsQuery->orderBy('products.created_at'),
            'date-desc', 'newest' => $productsQuery->orderByDesc('products.created_at'),
            default => $productsQuery
                ->orderByDesc('products.is_featured')
                ->orderByDesc('products.created_at'),
        };

        $stockCounts = [
            'in' => (clone $productsQuery)->where('products.stock', '>', 0)->count(),
            'out' => (clone $productsQuery)->where('products.stock', '<=', 0)->count(),
        ];

        $products = $productsQuery->paginate(12)->withQueryString();

        $priceMin = (float) $menu->products()->where('products.is_active', true)->min('products.price');
        $priceMax = (float) $menu->products()->where('products.is_active', true)->max('products.price');

        $sortLabels = [
            'featured' => 'En vedette',
            'bestseller' => 'Meilleures ventes',
            'bestsellers' => 'Meilleures ventes',
            'name-asc' => 'Alphabétique, A-Z',
            'az' => 'Alphabétique, A-Z',
            'name-desc' => 'Alphabétique, Z-A',
            'za' => 'Alphabétique, Z-A',
            'price-asc' => 'Prix croissant',
            'price-desc' => 'Prix décroissant',
            'date-asc' => 'Date, ancien au récent',
            'oldest' => 'Date, ancien au récent',
            'date-desc' => 'Date, récent à ancien',
            'newest' => 'Date, récent à ancien',
        ];
        $activeSortLabel = $sortLabels[$sort] ?? $sortLabels['featured'];

        $pageTitle = $menu->name;
        $menuSkin = $this->universSkin(strtolower(trim((string) $menu->slug)));

        $menuSlugKey = strtolower(trim((string) $menu->slug));
        $viewName = match (true) {
            $menuSlugKey === 'matelas' => 'menus.show-matelas',
            $menuSkin !== null => 'menus.show-univers',
            default => 'menus.show',
        };

        return view($viewName, compact('menu', 'products', 'pageTitle', 'matelasModels', 'matelasCategories', 'matelasCategoryGroups', 'isProtegeMatelas', 'menuCategories', 'menuSkin', 'activeSortLabel', 'stockCounts', 'priceMin', 'priceMax'));
    }

    private function universSkin(string $slug): ?array
    {
        $img = 'assets/maquette/img/products/real/';

        $skins = [
            'electromenager' => [
                'kicker' => 'Maison connectée',
                'rail' => [
                    'type' => 'perks',
                    'title' => 'Services inclus',
                    'items' => [
                        [
                            'name' => 'Livraison & installation',
                            'text' => 'Mise en service sur place',
                            'svg' => '<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><path d="M14 18V6a2 2 0 0 0-2-2H4a2 2 0 0 0-2 2v11a1 1 0 0 0 1 1h2"/><path d="M15 18H9"/><path d="M19 18h2a1 1 0 0 0 1-1v-3.65a1 1 0 0 0-.22-.62l-3.48-4.35A1 1 0 0 0 17.52 8H14"/><circle cx="17" cy="18" r="2"/><circle cx="7" cy="18" r="2"/></svg>',
                        ],
                        [
                            'name' => 'Garantie 2 ans',
                            'text' => "Pièces et main-d'œuvre",
                            'svg' => '<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><path d="M20 13c0 5-3.5 7.5-7.66 8.95a1 1 0 0 1-.67-.01C7.5 20.5 4 18 4 13V6a1 1 0 0 1 1-1c2 0 4.5-1.2 6.24-2.72a1.17 1.17 0 0 1 1.52 0C14.51 3.81 17 5 19 5a1 1 0 0 1 1 1z"/><path d="m9 12 2 2 4-4"/></svg>',
                        ],
                        [
                            'name' => 'Reprise ancien appareil',
                            'text' => 'Recyclage offert à la livraison',
                            'svg' => '<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><path d="M3 12a9 9 0 0 1 9-9 9.75 9.75 0 0 1 6.74 2.74L21 8"/><path d="M21 3v5h-5"/><path d="M21 12a9 9 0 0 1-9 9 9.75 9.75 0 0 1-6.74-2.74L3 16"/><path d="M8 16H3v5"/></svg>',
                        ],
                        [
                            'name' => 'Paiement en 3x',
                            'text' => 'Sans frais dès 150.000F',
                            'svg' => '<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><rect x="2" y="5" width="20" height="14" rx="2"/><path d="M2 10h20"/></svg>',
                        ],
                    ],
                ],
            ],
            'lit-canape' => [
                'kicker' => 'Repos & convivialité',
                'rail' => [
                    'type' => 'perks',
                    'title' => 'Services inclus',
                    'items' => [
                        [
                            'name' => 'Livraison & montage',
                            'text' => 'Installation dans la pièce de votre choix',
                            'svg' => '<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><path d="M14 18V6a2 2 0 0 0-2-2H4a2 2 0 0 0-2 2v11a1 1 0 0 0 1 1h2"/><path d="M15 18H9"/><path d="M19 18h2a1 1 0 0 0 1-1v-3.65a1 1 0 0 0-.22-.62l-3.48-4.35A1 1 0 0 0 17.52 8H14"/><circle cx="17" cy="18" r="2"/><circle cx="7" cy="18" r="2"/></svg>',
                        ],
                        [
                            'name' => 'Garantie 2 ans',
                            'text' => "Structure et mousse couvertes",
                            'svg' => '<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><path d="M20 13c0 5-3.5 7.5-7.66 8.95a1 1 0 0 1-.67-.01C7.5 20.5 4 18 4 13V6a1 1 0 0 1 1-1c2 0 4.5-1.2 6.24-2.72a1.17 1.17 0 0 1 1.52 0C14.51 3.81 17 5 19 5a1 1 0 0 1 1 1z"/><path d="m9 12 2 2 4-4"/></svg>',
                        ],
                        [
                            'name' => 'Reprise ancien mobilier',
                            'text' => 'Enlèvement offert à la livraison',
                            'svg' => '<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><path d="M3 12a9 9 0 0 1 9-9 9.75 9.75 0 0 1 6.74 2.74L21 8"/><path d="M21 3v5h-5"/><path d="M21 12a9 9 0 0 1-9 9 9.75 9.75 0 0 1-6.74-2.74L3 16"/><path d="M8 16H3v5"/></svg>',
                        ],
                        [
                            'name' => 'Paiement en 3x',
                            'text' => 'Sans frais dès 150.000F',
                            'svg' => '<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><rect x="2" y="5" width="20" height="14" rx="2"/><path d="M2 10h20"/></svg>',
                        ],
                    ],
                ],
            ],
            'drap-et-couettes' => [
                'hero' => [
                    'type' => 'col',
                    'badge' => 'Univers chambre',
                    'title' => 'Drap & Couettes',
                    'sub' => "Des matières douces et respirantes pour des nuits confortables toute l'année — du drap housse à la couette quatre saisons.",
                    'chips' => [
                        ['label' => 'Draps housses', 'slug' => 'draps-housses'],
                        ['label' => 'Couettes', 'slug' => 'couettes'],
                        ['label' => 'Housses de couette', 'slug' => 'housses-de-couette'],
                        ['label' => 'Protège-matelas', 'slug' => 'protege-matelas'],
                    ],
                    'image' => $img . '1769993520_r5wT4mQ4N8.jpg',
                    'alt' => 'Drap et couettes',
                ],
            ],
            'oreillers-et-taies' => [
                'kicker' => 'Douceur & maintien',
                'rail' => [
                    'type' => 'types',
                    'title' => "Types d'oreillers",
                    'items' => [
                        ['name' => 'Tous', 'image' => $img . '1769651796_8nTO7f2rrg.jpg', 'active' => true],
                        ['name' => 'Mémoire de forme', 'image' => $img . '1769999657_1CIVZl8UG6.jpg', 'slug' => 'oreillers-memoire-de-forme'],
                        ['name' => 'Duvet & plumes', 'image' => $img . '1769999657_xCatLOv9hZ.jpg', 'slug' => 'oreillers-duvet-plumes'],
                        ['name' => 'Latex naturel', 'image' => $img . '1769651796_8nTO7f2rrg.jpg', 'slug' => 'oreillers-latex'],
                        ['name' => 'Ergonomique', 'image' => $img . '1769999657_1CIVZl8UG6.jpg', 'slug' => 'oreillers-ergonomiques'],
                        ['name' => 'Traversin', 'image' => $img . '1769999657_xCatLOv9hZ.jpg', 'slug' => 'traversins'],
                        ['name' => 'Taies & protège-oreillers', 'image' => $img . '1769651796_8nTO7f2rrg.jpg', 'slug' => 'taies-protege-oreillers'],
                    ],
                ],
            ],
            'mobilier-accessoire' => [
                'kicker' => 'Pour votre intérieur',
                'rail' => [
                    'type' => 'rooms',
                    'title' => 'Par pièce',
                    'items' => [
                        ['name' => 'Salon', 'image' => 'assets/maquette/img/video-furniture.jpg', 'slug' => 'salon'],
                        ['name' => 'Chambre', 'image' => $img . '1770689632_0OTK5fkOpt.jpg', 'slug' => 'chambre'],
                        ['name' => 'Bureau', 'image' => $img . '1769999657_1CIVZl8UG6.jpg', 'slug' => 'bureau'],
                        ['name' => 'Salle à manger', 'image' => 'assets/maquette/img/banner/single-banner-2.jpg', 'slug' => 'salle-a-manger'],
                    ],
                ],
            ],
        ];

        $aliases = [
            'electromenagers' => 'electromenager',
            'lits-canapes' => 'lit-canape',
            'lit-et-canape' => 'lit-canape',
            'draps-et-couettes' => 'drap-et-couettes',
            'draps-couettes' => 'drap-et-couettes',
            'drap-couette' => 'drap-et-couettes',
            'oreillers-taies' => 'oreillers-et-taies',
            'oreillers' => 'oreillers-et-taies',
            'mobilier-accessoires' => 'mobilier-accessoire',
            'mobilier-et-accessoires' => 'mobilier-accessoire',
            'mobiliers-accessoires' => 'mobilier-accessoire',
            'meuble-et-fauteuil' => 'mobilier-accessoire',
        ];

        $slug = $aliases[$slug] ?? $slug;

        return $skins[$slug] ?? null;
    }
}
