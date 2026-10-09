@extends('maquette.layout')

@section('title', 'Assistance | Mobilier Addict')
@section('meta_description', 'Préparez votre demande d’assistance auprès de Mobilier Addict.')

@section('content')
@php
    $pages = require resource_path('views/maquette/includes/editorial-data.blade.php');
    $page = $pages['assistance'];
@endphp
<section class="editorial-page mt-100" aria-labelledby="page-title">
    <div class="container">
        <header class="editorial-intro">
            <p class="editorial-kicker">{{ $page['kicker'] }}</p>
            <h1 id="page-title">{{ $page['title'] }}</h1>
            <p>{{ $page['intro'] }}</p>
        </header>
        @foreach($page['sections'] as $section)
            <section class="editorial-section">
                <h2>{{ $section['title'] }}</h2>
                <p>{{ $section['text'] }}</p>
            </section>
        @endforeach
        <nav class="editorial-links" aria-label="Liens utiles">
            <a href="tel:+2250799140356">Appeler la boutique</a>
            <a href="{{ route('pages.faq') }}">Consulter la FAQ</a>
            <a href="{{ route('pages.contact') }}">Nous contacter</a>
        </nav>
    </div>
</section>
@endsection
