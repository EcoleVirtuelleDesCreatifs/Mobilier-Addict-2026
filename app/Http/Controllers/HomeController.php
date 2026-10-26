<?php

namespace App\Http\Controllers;

use App\Models\BlogPost;
use App\Models\Product;
use App\Models\Section;
use App\Models\Slide;
use App\Models\SpaceSection;
use App\Models\SpaceCard;
use Illuminate\Support\Str;

class HomeController extends Controller
{
    public function index()
    {
        $defaultSpaceSection = SpaceSection::query()->firstOrCreate(
            ['id' => 1],
            [
                'badge' => 'Solutions adaptées',
                'badge_icon' => '🏠',
                'title' => 'Sur-mesure',
                'subtitle' => 'Que vous équipiez un hôtel, un appartement ou votre maison familiale, nous avons la solution parfaite.',
                'background_color' => null,
                'order' => 1,
                'is_active' => true,
            ]
        );

        if (in_array($defaultSpaceSection->title, ['Un Sommeil Sur-Mesure Pour Chaque Univers', 'SUR MESURE'], true)) {
            $defaultSpaceSection->title = 'Sur-mesure';
            $defaultSpaceSection->save();
        }

        if (!$defaultSpaceSection->cards()->exists()) {
            SpaceCard::query()->create([
                'space_section_id' => $defaultSpaceSection->id,
                'title' => 'Hôtellerie',
                'description' => "Solutions professionnelles pour hôtels, chambres d'hôtes et résidences de tourisme",
                'image' => 'https://images.unsplash.com/photo-1566665797739-1674de7a421a?w=800&h=900&fit=crop',
                'image_alt' => 'Hôtellerie',
                'cta_text' => 'Voir les offres pro →',
                'cta_url' => route('univers.show', 'hotellerie'),
                'size' => 'large',
                'order' => 1,
                'is_active' => true,
            ]);
            SpaceCard::query()->create([
                'space_section_id' => $defaultSpaceSection->id,
                'title' => 'Appartement Meublé',
                'description' => null,
                'image' => 'https://images.unsplash.com/photo-1502672260266-1c1ef2d93688?w=600&h=400&fit=crop',
                'image_alt' => 'Appartement',
                'cta_text' => 'Découvrir →',
                'cta_url' => route('univers.show', 'appartement-meuble'),
                'size' => 'small',
                'order' => 2,
                'is_active' => true,
            ]);
            SpaceCard::query()->create([
                'space_section_id' => $defaultSpaceSection->id,
                'title' => 'Studio',
                'description' => null,
                'image' => 'https://images.unsplash.com/photo-1522708323590-d24dbb6b0267?w=600&h=400&fit=crop',
                'image_alt' => 'Studio',
                'cta_text' => 'Découvrir →',
                'cta_url' => route('univers.show', 'studio'),
                'size' => 'small',
                'order' => 3,
                'is_active' => true,
            ]);
            SpaceCard::query()->create([
                'space_section_id' => $defaultSpaceSection->id,
                'title' => 'Famille',
                'description' => 'Matelas pour toute la famille, du bébé aux grands-parents',
                'image' => 'https://images.unsplash.com/photo-1616594039964-ae9021a400a0?w=900&h=400&fit=crop',
                'image_alt' => 'Famille',
                'cta_text' => 'Explorer les packs famille →',
                'cta_url' => route('univers.show', 'famille'),
                'size' => 'large',
                'order' => 4,
                'is_active' => true,
            ]);
        }

        $heroSlides = Slide::query()
            ->active()
            ->ordered()
            ->get()
            ->filter(fn (Slide $slide) => $this->slideImageExists($slide->image))
            ->values();

        $spaceSection = SpaceSection::query()
            ->active()
            ->ordered()
            ->with(['cards' => function ($q) {
                $q->active()->ordered();
            }])
            ->first();

        $collectionProducts = Product::query()
            ->active()
            ->collection()
            ->ordered()
            ->take(8)
            ->get();

        if ($collectionProducts->isEmpty()) {
            $collectionProducts = Product::query()
                ->active()
                ->ordered()
                ->take(8)
                ->get();
        }

        $accessoryCategorySlugs = ['oreillers', 'draps', 'couettes', 'protection'];
        $accessoryProducts = Product::query()
            ->active()
            ->where(function ($q) use ($accessoryCategorySlugs) {
                $q->whereHas('categories', function ($query) use ($accessoryCategorySlugs) {
                    $query->whereIn('slug', $accessoryCategorySlugs);
                })->orWhereHas('category', function ($query) use ($accessoryCategorySlugs) {
                    $query->whereIn('slug', $accessoryCategorySlugs);
                });
            })
            ->ordered()
            ->take(4)
            ->get();

        if ($accessoryProducts->isEmpty()) {
            $accessoryProducts = Product::query()
                ->active()
                ->ordered()
                ->take(4)
                ->get();
        }

        $favoriteProducts = Product::query()
            ->active()
            ->bestsellers()
            ->ordered()
            ->take(4)
            ->get();

        if ($favoriteProducts->count() < 4) {
            $featured = Product::query()
                ->active()
                ->featured()
                ->ordered()
                ->take(4)
                ->get();
            $favoriteProducts = $favoriteProducts->concat($featured)->unique('id')->take(4)->values();
        }

        if ($favoriteProducts->isEmpty()) {
            $favoriteProducts = Product::query()
                ->active()
                ->ordered()
                ->take(4)
                ->get();
        }

        if ($favoriteProducts->isEmpty()) {
            $favoriteProducts = Product::query()
                ->ordered()
                ->take(4)
                ->get();
        }

        $matelasProducts = Product::query()
            ->active()
            ->with(['variants' => fn($q) => $q->active()->orderBy('thickness_cm')->orderBy('places')])
            ->where(function ($q) {
                $q->whereHas('categories', fn($qq) => $qq->where('slug', 'like', '%matelas%'))
                    ->orWhereHas('category', fn($qq) => $qq->where('slug', 'like', '%matelas%'))
                    ->orWhere('name', 'like', '%matelas%');
            })
            ->ordered()
            ->get()
            ->unique(fn($p) => preg_replace('/\s*[-–]\s*\d+\s*(cm)?\s*[x×]\s*\d+\s*cm.*$/i', '', (string) $p->name))
            ->take(9)
            ->values();

        if ($matelasProducts->isEmpty()) {
            $matelasProducts = Product::query()
                ->active()
                ->featured()
                ->ordered()
                ->take(9)
                ->get();
        }

        $newProducts = Product::query()
            ->active()
            ->orderByDesc('created_at')
            ->take(6)
            ->get();

        if ($newProducts->isEmpty()) {
            $newProducts = Product::query()
                ->orderByDesc('created_at')
                ->take(6)
                ->get();
        }

        $blogFeaturedPost = BlogPost::query()
            ->active()
            ->featured()
            ->ordered()
            ->with(['category'])
            ->first();

        $blogPosts = BlogPost::query()
            ->active()
            ->when($blogFeaturedPost, fn($q) => $q->where('id', '!=', $blogFeaturedPost->id))
            ->ordered()
            ->with(['category'])
            ->take(3)
            ->get();

        if (!$blogFeaturedPost) {
            $items = BlogPost::query()
                ->active()
                ->ordered()
                ->with(['category'])
                ->take(4)
                ->get();
            $blogFeaturedPost = $items->first();
            $blogPosts = $items->slice(1, 3)->values();
        }

        $exploreCategoriesSection = Section::query()
            ->where('slug', 'explore-categories')
            ->first();

        $catalogueCards = $this->catalogueCards();

        return view('maquette.home', compact(
            'catalogueCards',
            'heroSlides',
            'spaceSection',
            'exploreCategoriesSection',
            'collectionProducts',
            'accessoryProducts',
            'favoriteProducts',
            'newProducts',
            'matelasProducts',
            'blogFeaturedPost',
            'blogPosts'
        ));
    }

    /**
     * Cartes « Tous nos produits » : nombre de produits actifs et visuel réel par univers.
     */
    private function catalogueCards(): array
    {
        $cards = [
            ['slug' => 'matelas', 'title' => 'Matelas', 'text' => 'Ressorts, mousse et mémoire de forme, dans toutes les tailles.', 'image' => 'assets/maquette/img/products/real/1770738680_Z9FYQSbomB.jpg', 'icon' => 'bed'],
            ['slug' => 'oreillers-et-taies', 'title' => 'Oreillers & taies', 'text' => 'Moelleux ou fermes, pour toutes les positions.', 'image' => 'assets/maquette/img/products/real/1769651796_8nTO7f2rrg.jpg', 'icon' => 'pillow'],
            ['slug' => 'drap-et-couettes', 'title' => 'Draps & couettes', 'text' => 'Linge de lit doux et respirant.', 'image' => 'assets/maquette/img/products/real/1769999657_kRzaynhx3X.jpg', 'icon' => 'sheet'],
            ['slug' => 'mobilier-accessoire', 'title' => 'Mobilier & chambre', 'text' => 'Lits, rangements et meubles du quotidien.', 'image' => 'assets/maquette/img/products/real/1770689632_0OTK5fkOpt.jpg', 'icon' => 'sofa'],
            ['slug' => 'electromenager', 'title' => 'Électroménager', 'text' => 'Les essentiels, de la cuisine à la buanderie.', 'image' => null, 'icon' => 'appliance'],
        ];

        try {
            $stats = \Illuminate\Support\Facades\Cache::remember('home.catalogue.cards.v1', now()->addMinutes(10), function () use ($cards) {
                $result = [];
                foreach ($cards as $card) {
                    $query = null;
                    if ($menu = \App\Models\Menu::query()->where('slug', $card['slug'])->where('is_active', true)->first()) {
                        $query = $menu->products();
                    } elseif ($category = \App\Models\Category::query()->where('slug', $card['slug'])->first()) {
                        $query = $category->productsMany();
                    }

                    if (! $query) {
                        $result[$card['slug']] = ['count' => 0, 'image' => null];
                        continue;
                    }

                    $active = (clone $query)->where('products.is_active', true);
                    $result[$card['slug']] = [
                        'count' => (clone $active)->count(),
                        'image' => (clone $active)->whereNotNull('products.image')->where('products.image', '<>', '')->latest('products.updated_at')->value('products.image'),
                    ];
                }

                return $result;
            });
        } catch (\Throwable $e) {
            $stats = [];
        }

        return array_map(function ($card) use ($stats) {
            $stat = $stats[$card['slug']] ?? ['count' => 0, 'image' => null];
            $card['count'] = (int) $stat['count'];
            $card['url'] = route('category.show', $card['slug']);
            $card['image_url'] = $card['image']
                ? asset($card['image'])
                : ($stat['image'] ? image_thumb($stat['image'], 640) : null);

            return $card;
        }, $cards);
    }

    private function slideImageExists(?string $path): bool
    {
        $path = trim((string) $path);
        if ($path === '') {
            return false;
        }

        if (Str::startsWith($path, ['http://', 'https://', '//'])) {
            return true;
        }

        $path = ltrim(str_replace('\\', '/', $path), '/');
        $path = preg_replace('#^storage/app/public/#', '', $path);
        $path = preg_replace('#^(public/)?storage/#', '', $path);

        return is_file(storage_path('app/public/' . $path))
            || is_file(public_path($path))
            || is_file(public_path('storage/' . $path));
    }
}
