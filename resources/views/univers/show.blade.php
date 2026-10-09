@extends('maquette.layout')

@section('title', $pageTitle . ' à Abidjan | Mobilier Addict Côte d\'Ivoire')
@section('meta_description', ($pageDescription ?: 'Découvrez notre univers ' . $pageTitle) . ' chez Mobilier Addict à Abidjan. Livraison en Côte d\'Ivoire, mobilier, literie et électroménager pour la maison.')

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
