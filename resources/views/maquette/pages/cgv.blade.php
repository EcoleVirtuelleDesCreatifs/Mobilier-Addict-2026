@extends('maquette.layout')

@section('title', 'Conditions générales | Mobilier Addict')
@section('meta_description', 'Conditions générales applicables à la consultation du catalogue et aux achats Mobilier Addict.')

@php
    $pages = require resource_path('views/maquette/includes/editorial-data.blade.php');
    $page = $pages['conditions-generales'];
    $routeMap = [
        'contact.php' => 'pages.contact',
        'conditions-generales.php' => 'pages.cgv',
        'confidentialite.php' => 'pages.privacy',
        'assistance.php' => 'pages.customer-service',
        'faq.php' => 'pages.faq',
        'blog.php' => 'blog.index',
        'conseils.php' => 'pages.conseils',
        'about-us.php' => 'pages.about',
        'matelas.php' => 'menu.show:matelas',
        'mobilier.php' => 'menu.show:mobilier-accessoire',
        'mobilier-accessoire.php' => 'menu.show:mobilier-accessoire',
        'electromenager.php' => 'menu.show:electromenager',
    ];
    $resolveLink = function ($url) use ($routeMap) {
        $route = $routeMap[$url] ?? null;
        if ($route === null) {
            return route('home');
        }
        if (str_contains($route, ':')) {
            [$name, $param] = explode(':', $route, 2);
            return route($name, $param);
        }
        return route($route);
    };
@endphp

@section('content')
    <!-- breadcrumb start -->
    <div class="breadcrumb">
        <div class="container">
            <ul class="list-unstyled d-flex align-items-center m-0">
                <li><a href="{{ route('home') }}">Accueil</a></li>
                <li>
                    <svg class="icon icon-breadcrumb" width="64" height="64" viewBox="0 0 64 64" fill="none" xmlns="http://www.w3.org/2000/svg"><g opacity="0.4"><path d="M25.9375 8.5625L23.0625 11.4375L43.625 32L23.0625 52.5625L25.9375 55.4375L47.9375 33.4375L49.3125 32L47.9375 30.5625L25.9375 8.5625Z" fill="#000"/></g></svg>
                </li>
                <li>Conditions générales</li>
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

            @if(isset($page['notice']))
                <p class="editorial-notice">{{ $page['notice'] }}</p>
            @endif

            <div class="editorial-layout">
                <div class="editorial-article">
                    @foreach($page['sections'] as $index => $section)
                        <section class="editorial-section" id="{{ $section['id'] ?? 'section-' . ($index + 1) }}">
                            <h2>{{ $section['title'] }}</h2>
                            <p>{{ $section['text'] }}</p>
                        </section>
                    @endforeach
                    <nav class="editorial-links" aria-label="Pour aller plus loin">
                        @foreach($page['links'] as [$url, $label])
                            <a href="{{ $resolveLink($url) }}">{{ $label }} <span aria-hidden="true">→</span></a>
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
                        <h2>Besoin d'une précision&nbsp;?</h2>
                        <p>Pour toute question sur les conditions applicables, contactez la boutique.</p>
                        <a href="tel:+2250799140356">+225 07 99 14 03 56</a>
                        <a href="{{ route('pages.customer-service') }}">Demander de l’assistance →</a>
                    </div>
                </aside>
            </div>
        </div>
    </section>
@endsection
