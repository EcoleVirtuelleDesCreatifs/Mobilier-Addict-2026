@extends('maquette.layout')

@section('title', 'Service client : commande, livraison, SAV | Mobilier Addict')
@section('meta_description', 'Service client Mobilier Addict à Abidjan : préparer un achat, suivre ou modifier une commande, signaler un problème à la réception. WhatsApp et téléphone.')

@php
    $pages = require resource_path('views/maquette/includes/editorial-data.blade.php');
    $page = $pages['assistance'];
@endphp

@section('content')
<div class="ma27">
    <section class="page-head"><div class="wrap"><nav class="crumbs" aria-label="Fil d’Ariane"><a href="{{ route('home') }}">Accueil</a><span>/</span><span>Service client</span></nav><h1>Une question ? <em>On vous répond.</em></h1><p class="lead">{{ $page['intro'] }}</p></div></section>
    <section class="contact-content"><div class="wrap split">
        <div>
            <ul class="chan">
                <li><a href="https://wa.me/{{ whatsapp_number() }}" target="_blank" rel="noopener"><div><small>WhatsApp · le plus rapide</small><b>Écrire à un conseiller</b></div><span class="arr" aria-hidden="true">→</span></a></li>
                <li><a href="tel:+2250799140356"><div><small>Téléphone</small><b>+225 07 99 14 03 56</b></div><span class="arr" aria-hidden="true">→</span></a></li>
                <li><a href="{{ route('pages.shipping-returns') }}"><div><small>Délais, tarifs, retours</small><b>Livraison &amp; retours</b></div><span class="arr" aria-hidden="true">→</span></a></li>
                <li><a href="{{ route('pages.faq') }}"><div><small>Réponses immédiates</small><b>Questions fréquentes</b></div><span class="arr" aria-hidden="true">→</span></a></li>
            </ul>
            <div class="contact-location">
                <h2>À préparer avant d’écrire</h2>
                <p>Votre référence de commande (ou celle de l’article), le nom utilisé lors de l’achat, votre commune et, en cas de problème, quelques photos.</p>
            </div>
        </div>
        <div class="contact-panel">
            @foreach($page['sections'] as $section)
                <h2 @class(['mt-4' => ! $loop->first])>{{ $section['title'] }}</h2>
                <p>{{ $section['text'] }}</p>
            @endforeach
            <nav class="contact-help" aria-label="Aide et suivi"><a class="tlink" href="{{ route('pages.contact') }}">Toutes nos coordonnées →</a><a class="tlink" href="{{ route('devis.create') }}">Demander un devis sur mesure →</a></nav>
        </div>
    </div></section>
</div>
@endsection
