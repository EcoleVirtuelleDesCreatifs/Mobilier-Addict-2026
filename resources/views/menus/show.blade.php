@extends('maquette.layout')

@section('title', $pageTitle . ' à Abidjan — Mobilier Addict Côte d\'Ivoire')
@php
        $menuDescMap = [
            'mobilier-accessoire' => 'Canapés, fauteuils, tables et rangements pour la maison à Abidjan : prix affichés, livraison sous 48h en Côte d\'Ivoire.',
            'electromenager' => 'Électroménager pour équiper votre maison à Abidjan : réfrigérateurs, gazinières, machines. Livraison et installation en Côte d\'Ivoire.',
            'oreillers-et-taies' => 'Oreillers et taies d\'oreiller à Abidjan : confort, soutien et matières adaptées au climat. Livraison sous 48h en Côte d\'Ivoire.',
            'drap-et-couettes' => 'Draps, draps housse et couettes à Abidjan : linge de lit uni ou à motif, toutes tailles. Livraison sous 48h en Côte d\'Ivoire.',
        ];
        $menuDescKey = strtolower(trim((string) ($menu->slug ?? '')));
    @endphp
@section('meta_description', $menuDescMap[$menuDescKey] ?? ('Découvrez nos produits pour ' . $pageTitle . ' à Abidjan chez Mobilier Addict. Livraison en Côte d\'Ivoire de mobilier, literie et électroménager pour la maison.'))

@section('content')
    @include('maquette.includes.product-collection', [
        'collectionProducts' => $products,
        'collectionTitle' => $pageTitle,
        'collectionCategories' => $menuCategories,
    ])
@endsection
