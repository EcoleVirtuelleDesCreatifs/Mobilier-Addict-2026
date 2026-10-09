@extends('maquette.layout')

@section('title', $category->name . ' à Abidjan | Mobilier Addict Côte d\'Ivoire')
@section('meta_description', ($category->description ? strip_tags($category->description) . ' ' : 'Découvrez notre sélection de ' . $category->name . ' ') . 'chez Mobilier Addict à Abidjan. Livraison en Côte d\'Ivoire, devis personnalisé et accompagnement dédié.')

@section('content')
    @php
        $isModel = $category instanceof \App\Models\Category;
        $categoryChildren = $isModel ? $category->children()->active()->ordered()->get() : collect();
        $siblingCategories = collect();
        if ($isModel) {
            $parentMenu = $category->menus()->first();
            if ($parentMenu) {
                $siblingCategories = $parentMenu->categories()
                    ->where('is_active', true)
                    ->orderBy('order')
                    ->get();
            } elseif ($category->parent) {
                $siblingCategories = $category->parent->children()->active()->ordered()->get();
            }
        }
        $catProducts = $category->productsMany ?? $category->products ?? collect();
    @endphp

    <div class="collection col-v2 mt-100">
        <div class="container">

            <div class="mp-cat-hero" data-aos="fade-up" data-aos-duration="700">
                <div class="mp-cat-hero-content">
                    <p class="mp-cat-hero-kicker">
                        <a href="{{ route('home') }}">Accueil</a>
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="m9 18 6-6-6-6"/></svg>
                        <span>Catégorie</span>
                    </p>
                    <h1 class="mp-cat-hero-title">{{ $category->name }}</h1>
                    @if($category->description ?? null)
                        <p class="mp-cat-hero-sub">{{ $category->description }}</p>
                    @endif
                    <span class="mp-cat-hero-count">{{ $catProducts->count() }} produit{{ $catProducts->count() > 1 ? 's' : '' }}</span>
                </div>
            </div>

            @if($siblingCategories->isNotEmpty())
                <nav class="magazine-topics mp-cat-nav" aria-label="Catégories liées">
                    <span>Explorer</span>
                    @foreach($siblingCategories as $sib)
                        <a href="{{ route('category.show', $sib->slug) }}" class="{{ $sib->slug === $category->slug ? 'is-active' : '' }}">{{ $sib->name }}</a>
                    @endforeach
                </nav>
            @endif

            @include('maquette.includes.product-collection', [
                'collectionProducts' => $catProducts,
                'collectionTitle' => '',
                'collectionDescription' => null,
                'collectionCategories' => $categoryChildren->isNotEmpty() ? $categoryChildren : $siblingCategories,
                'hideCollectionTitle' => true,
            ])
        </div>
    </div>
@endsection
