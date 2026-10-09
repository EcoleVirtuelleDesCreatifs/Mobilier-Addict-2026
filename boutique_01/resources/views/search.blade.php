@extends('maquette.layout')

@section('title', ($q ? 'Recherche : ' . $q : 'Recherche') . ' | Mobilier Addict')
@section('meta_description', 'Recherche produits sur Mobilier Addict')

@section('content')
<section class="collection col-v2 mt-100" aria-label="Résultats de recherche">
    <div class="container">

        <div class="mp-cat-hero mp-search-hero" data-aos="fade-up" data-aos-duration="700">
            <div class="mp-cat-hero-content">
                <p class="mp-cat-hero-kicker">
                    <a href="{{ route('home') }}">Accueil</a>
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="m9 18 6-6-6-6"/></svg>
                    <span>Recherche</span>
                </p>
                <h1 class="mp-cat-hero-title">
                    @if($q !== '')
                        Résultats pour «&nbsp;{{ $q }}&nbsp;»
                    @else
                        Rechercher un produit
                    @endif
                </h1>
                <p class="mp-cat-hero-sub">
                    {{ $products->count() > 0 ? $products->count() . ' produit' . ($products->count() > 1 ? 's' : '') . ' trouvé' . ($products->count() > 1 ? 's' : '') : 'Tapez un mot-clé pour trouver un produit.' }}
                </p>
                <form action="{{ route('search.index') }}" method="GET" class="mp-search-form" role="search">
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><circle cx="11" cy="11" r="7"/><path d="m21 21-4.3-4.3"/></svg>
                    <input type="search" name="q" value="{{ $q }}" placeholder="Matelas, oreiller, couette…" aria-label="Rechercher un produit">
                    <button type="submit">Rechercher</button>
                </form>
            </div>
        </div>

        @if($q !== '' && $products->isEmpty())
            <div class="mp-panel mp-cart-empty text-center">
                <span class="mp-cart-empty-icon">
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.4" stroke-linecap="round" stroke-linejoin="round"><circle cx="11" cy="11" r="7"/><path d="m21 21-4.3-4.3"/><path d="m8.5 8.5 5 5M13.5 8.5l-5 5"/></svg>
                </span>
                <h2 class="mp-panel-title">Aucun produit trouvé</h2>
                <p class="mp-panel-sub mb-4">Essayez un autre mot-clé ou parcourez nos collections.</p>
                <a href="{{ route('collection.index') }}" class="mp-buy mp-cart-cta" style="max-width:280px;margin:0 auto">Voir toute la collection</a>
            </div>
        @else
            <div class="collection-product-container">
                <div class="row featured-grid">
                    @foreach($products as $product)
                        <div class="col-lg-3 col-md-6 col-12" data-aos="fade-up" data-aos-duration="700">
                            @include('maquette.includes.shop-card')
                        </div>
                    @endforeach
                </div>
            </div>
        @endif
    </div>
</section>
@endsection
