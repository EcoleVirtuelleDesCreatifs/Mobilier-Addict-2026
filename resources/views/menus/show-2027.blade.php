@extends('maquette.layout')
@php
    $pageTitle = $pageTitle ?? 'Tous les produits';
    $catalogueUrl = isset($menu) ? route('menu.show', $menu->slug) : url()->current();
    $menuCategories = $menuCategories ?? collect();
@endphp
@section('title', $pageTitle . ' à Abidjan — Mobilier Addict')
@section('canonical', $catalogueUrl)
@if(request()->hasAny(['q', 'size', 'comfort', 'availability', 'price_min', 'price_max', 'sort']))
@section('robots', 'noindex, follow')
@endif
@section('meta_description', 'Découvrez nos ' . mb_strtolower($pageTitle) . ' à Abidjan : modèles, dimensions et prix réels. Conseil personnalisé et paiement à la livraison avec Mobilier Addict.')
@section('content')
<div class="ma27">
    <section class="page-head"><div class="wrap"><nav class="crumbs" aria-label="Fil d’Ariane"><a href="{{ route('home') }}">Accueil</a><span>/</span><span>{{ $pageTitle }}</span></nav><h1>{{ $pageTitle }}</h1></div></section>
    <section class="catalogue-content"><div class="wrap">
        <nav class="tabs" aria-label="Univers de la boutique"><a class="chip {{ request()->routeIs('collection.index') ? 'on' : '' }}" href="{{ route('collection.index') }}" @if(request()->routeIs('collection.index')) aria-current="page" @endif>Tout</a>@foreach($headerMenus ?? [] as $entry)@if(!in_array($entry->slug, ['accueil', 'home', '/']))<a class="chip {{ $entry->id === ($menu->id ?? null) ? 'on' : '' }}" href="{{ $entry->url ? url($entry->url) : route('menu.show', $entry->slug) }}" @if($entry->id === ($menu->id ?? null)) aria-current="page" @endif>{{ $entry->name }}</a>@endif @endforeach</nav>
        <form class="toolbar" action="{{ $catalogueUrl }}" method="GET">
            @if(($menu->slug ?? null) === 'matelas')
            <div class="catalogue-choices">
                <fieldset><legend>Taille</legend><div class="chips">@foreach(['' => 'Toutes', '90' => '90 × 190', '120' => '120 × 190', '140' => '140 × 190', '160' => '160 × 190', '180' => '180 × 190'] as $value => $label)<label class="chip"><input type="radio" name="size" value="{{ $value }}" @checked((string) request('size', '') === (string) $value)>{{ $label }}</label>@endforeach</div></fieldset>
                <fieldset><legend>Confort</legend><div class="chips">@foreach(['' => 'Tous', 'soft' => 'Souple', 'equilibre' => 'Équilibré', 'ferme' => 'Ferme', 'extra_ferme' => 'Extra ferme', 'luxury' => 'Luxury'] as $value => $label)<label class="chip"><input type="radio" name="comfort[]" value="{{ $value }}" @checked(in_array($value, (array) request('comfort', [''])))>{{ $label }}</label>@endforeach</div></fieldset>
            </div>
            @endif
            <label class="catalogue-field">Disponibilité<select name="availability" class="sel"><option value="">Tous les produits</option><option value="in" @selected(request('availability') === 'in')>En stock</option><option value="out" @selected(request('availability') === 'out')>Sur commande</option></select></label>
            <label class="catalogue-field catalogue-search">Rechercher<input class="inp" type="search" name="q" value="{{ request('q') }}" placeholder="Rechercher…" maxlength="100"></label>
            <label class="catalogue-field">Trier<select class="sel" name="sort">@foreach(['featured' => 'Recommandés', 'price-asc' => 'Prix croissant', 'price-desc' => 'Prix décroissant', 'newest' => 'Nouveautés'] as $value => $label)<option value="{{ $value }}" @selected(request('sort', request()->routeIs('nouveautes.index') ? 'newest' : 'featured') === $value)>{{ $label }}</option>@endforeach</select></label>
            <button class="btn pink sm" type="submit">Filtrer</button><a class="tlink" href="{{ $catalogueUrl }}">Réinitialiser</a>
        </form>
        <p class="result"><b>{{ $products->total() }}</b> produit{{ $products->total() > 1 ? 's' : '' }}</p>
        <div class="grid">@forelse($products as $product)@include('maquette.includes.card-2027')@empty<div class="empty"><p>Aucun produit ne correspond.</p><span>Essayez un autre filtre ou demandez conseil.</span><a class="btn pink" href="{{ route('pages.contact') }}">Demander conseil</a></div>@endforelse</div>
        <div class="center">{{ $products->links() }}</div>
        @if($menuCategories->isNotEmpty())<nav class="catalogue-subcategories" aria-label="Catégories de {{ $pageTitle }}">@foreach($menuCategories as $category)<a class="chip" href="{{ route('category.show', $category->slug) }}">{{ $category->name }}</a>@endforeach</nav>@endif
    </div></section>
</div>
@endsection
