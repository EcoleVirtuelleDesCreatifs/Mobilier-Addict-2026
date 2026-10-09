@extends('maquette.layout')

@section('title', 'Les guides maison — Conseils | Mobilier Addict')
@section('meta_description', 'Des conseils concrets pour aménager un intérieur confortable en Côte d’Ivoire, préparer vos achats et prendre soin de votre mobilier.')

@section('content')
@php
    $pages = require resource_path('views/maquette/includes/editorial-data.blade.php');
    $page = $pages['conseils'];
    $links = [
        ['route' => route('blog.index'), 'label' => 'Retour au magazine'],
        ['route' => route('menu.show', 'mobilier-accessoire'), 'label' => 'Découvrir le mobilier'],
        ['route' => route('pages.faq'), 'label' => 'Toutes les questions fréquentes'],
    ];
@endphp

<!-- breadcrumb start -->
<div class="breadcrumb">
    <div class="container">
        <ul class="list-unstyled d-flex align-items-center m-0">
            <li><a href="{{ route('home') }}">Accueil</a></li>
            <li>
                <svg class="icon icon-breadcrumb" width="64" height="64" viewBox="0 0 64 64" fill="none" xmlns="http://www.w3.org/2000/svg"><g opacity="0.4"><path d="M25.9375 8.5625L23.0625 11.4375L43.625 32L23.0625 52.5625L25.9375 55.4375L47.9375 33.4375L49.3125 32L47.9375 30.5625L25.9375 8.5625Z" fill="#000"/></g></svg>
            </li>
            <li>Conseils</li>
        </ul>
    </div>
</div>
<!-- breadcrumb end -->

<section class="editorial-page" aria-labelledby="page-title">
    <div class="container">
        <header class="editorial-intro">
            <p class="editorial-kicker">{{ $page['kicker'] }}</p>
            <h1 id="page-title">{{ $page['title'] }}</h1>
            <p class="editorial-lead">{{ $page['intro'] }}</p>
        </header>

        <div class="editorial-layout">
            <div class="editorial-article">
                <figure class="editorial-image">
                    <img loading="eager" fetchpriority="high" decoding="async" src="{{ asset('assets/maquette/img/blog/furniture-3.jpg') }}" alt="Inspiration pour l’aménagement de la maison" width="1000" height="600">
                    <figcaption>Image d’ambiance, non contractuelle.</figcaption>
                </figure>
                @foreach($page['sections'] as $index => $section)
                    <section class="editorial-section" id="{{ $section['id'] ?? 'section-' . ($index + 1) }}">
                        <h2>{{ $section['title'] }}</h2>
                        <p>{{ $section['text'] }}</p>
                    </section>
                @endforeach
                <nav class="editorial-links" aria-label="Pour aller plus loin">
                    @foreach($links as $link)
                        <a href="{{ $link['route'] }}">{{ $link['label'] }} <span aria-hidden="true">→</span></a>
                    @endforeach
                </nav>
            </div>

            <aside class="editorial-aside" aria-label="Repères et contact">
                <p class="editorial-kicker">Sur cette page</p>
                <nav aria-label="Sommaire">
                    <ol>
                        @foreach($page['sections'] as $index => $section)
                            <li><a href="#{{ $section['id'] ?? 'section-' . ($index + 1) }}">{{ $section['title'] }}</a></li>
                        @endforeach
                    </ol>
                </nav>
                <div class="editorial-help">
                    <h2>Parlons de votre besoin</h2>
                    <p>Une référence, une question ou un projet d’aménagement ? Contactez la boutique.</p>
                    <a href="tel:+2250799140356">+225 07 99 14 03 56</a>
                    <a href="{{ route('devis.create') }}">Demander un devis sur-mesure →</a>
                </div>
            </aside>
        </div>
    </div>
</section>
@endsection
