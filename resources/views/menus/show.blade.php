@extends('maquette.layout')

@section('title', $pageTitle . ' à Abidjan — Mobilier Addict Côte d\'Ivoire')
@section('meta_description', 'Découvrez nos produits pour ' . $pageTitle . ' à Abidjan chez Mobilier Addict. Livraison en Côte d\'Ivoire de mobilier, literie et électroménager pour la maison.')

@section('content')
    @include('maquette.includes.product-collection', [
        'collectionProducts' => $products,
        'collectionTitle' => $pageTitle,
        'collectionCategories' => $menuCategories,
    ])
@endsection
