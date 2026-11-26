@extends('maquette.layout')

@section('title', $pageTitle . ' à Abidjan | Mobilier Addict Côte d\'Ivoire')
@section('meta_description', ($pageDescription ?: 'Découvrez notre univers ' . $pageTitle) . ' chez Mobilier Addict à Abidjan. Livraison en Côte d\'Ivoire, mobilier, literie et électroménager pour la maison.')

{{-- Catégorie sans produit : pas d'indexation tant qu'elle est vide. --}}
@if(count($products) === 0)
@section('robots', 'noindex, follow')
@endif

@section('content')
    @php
        $universChildren = ($category instanceof \App\Models\Category)
            ? $category->children()->active()->ordered()->get()
            : collect();
    @endphp

    @include('maquette.includes.product-collection', [
        'collectionProducts' => $products,
        'collectionTitle' => $pageTitle,
        'collectionDescription' => $pageDescription,
        'collectionCategories' => $universChildren,
    ])
@endsection
