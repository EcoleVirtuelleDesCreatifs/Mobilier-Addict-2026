<?php

namespace App\Http\Controllers;

use App\Models\BlogPost;
use App\Models\Product;
use App\Models\Section;
use App\Models\Slide;
use App\Models\SpaceSection;
use App\Models\SpaceCard;

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
            ->get();

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

        return view('home', compact(
            'heroSlides',
            'spaceSection',
            'exploreCategoriesSection',
            'collectionProducts',
            'accessoryProducts',
            'favoriteProducts',
            'newProducts',
            'blogFeaturedPost',
            'blogPosts'
        ));
    }
}
