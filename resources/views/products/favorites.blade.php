@extends('maquette.layout')
@section('title', 'Vos favoris — Mobilier Addict')
@section('robots', 'noindex, nofollow')
@section('content')
<div class="ma27">
    <section class="page-head"><div class="wrap"><nav class="crumbs" aria-label="Fil d’Ariane"><a href="{{ route('home') }}">Accueil</a><span>/</span><span>Favoris</span></nav><h1>Vos favoris</h1></div></section>
    <section class="catalogue-content"><div class="wrap"><div class="grid">
        @forelse($products as $product)
            @include('maquette.includes.card-2027')
        @empty
            <div class="empty"><p>Aucun favori pour l'instant.</p><span>Touchez le cœur d'un produit pour le retrouver ici, dans ce navigateur.</span><a class="btn pink" href="{{ route('collection.index') }}">Découvrir la boutique</a></div>
        @endforelse
    </div></div></section>
</div>
@endsection
