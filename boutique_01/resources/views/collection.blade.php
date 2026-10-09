@extends('maquette.layout')

@section('title', ($pageTitle ?? 'Tous les produits') . ' à Abidjan | Mobilier Addict Côte d\'Ivoire')
@section('meta_description', $pageMetaDescription ?? 'Achetez ' . ($pageTitle ?? 'tous les produits') . ' à Abidjan avec Mobilier Addict. Livraison en Côte d\'Ivoire, mobilier, literie et électroménager pour la maison.')

@section('content')
    @include('maquette.includes.product-collection', [
        'collectionProducts' => $products,
        'collectionTitle' => $pageHeading ?? $pageTitle ?? 'Tous les produits',
        'collectionDescription' => $pageSubtitle ?? null,
        'collectionCategories' => $menuCategories ?? collect(),
    ])
@endsection
