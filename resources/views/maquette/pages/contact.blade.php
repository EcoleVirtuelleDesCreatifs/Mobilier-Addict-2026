@extends('maquette.layout')

@section('title', 'Contact — Mobilier Addict Abidjan | Côte d\'Ivoire')
@section('meta_description', 'Contactez Mobilier Addict à Abidjan pour un devis personnalisé, une question ou une commande de mobilier, literie et électroménager en Côte d\'Ivoire.')

@section('content')
<div class="ma27">
    <section class="page-head"><div class="wrap"><nav class="crumbs" aria-label="Fil d’Ariane"><a href="{{ route('home') }}">Accueil</a><span>/</span><span>Contact</span></nav><h1>Parlons de <em>votre projet.</em></h1><p class="lead">Un conseil avant achat, une référence à vérifier ou une commande à suivre ? Contactez notre équipe.</p></div></section>
    <section class="contact-content"><div class="wrap split">
        <!-- contact box start -->
        <div>
            <ul class="chan">
                <li><a href="https://wa.me/{{ whatsapp_number() }}" target="_blank" rel="noopener"><div><small>WhatsApp</small><b>Écrire à un conseiller</b></div><span class="arr" aria-hidden="true">→</span></a></li>
                <li><a href="tel:+2250799140356"><div><small>Téléphone</small><b>+225 07 99 14 03 56</b></div><span class="arr" aria-hidden="true">→</span></a></li>
                <li><a href="{{ route('devis.create') }}"><div><small>Professionnels</small><b>Demander un devis</b></div><span class="arr" aria-hidden="true">→</span></a></li>
            </ul>
            <div class="contact-location">
                <h2>Nous retrouver</h2>
                <p>{{ config('maquette.contact.address') ?: 'Abidjan, Côte d’Ivoire' }}</p>
                @if(config('maquette.contact.hours'))<p>{{ config('maquette.contact.hours') }}</p>@endif
                @if(config('maquette.contact.maps_url'))<a class="tlink" href="{{ config('maquette.contact.maps_url') }}" target="_blank" rel="noopener">Voir sur Google Maps →</a>@endif
                <p class="spec">Avant de vous déplacer, appelez pour confirmer l’adresse, les horaires et la disponibilité des articles souhaités.</p>
            </div>
        </div>
        <!-- contact box end -->
        <!-- about banner start -->
        <div class="contact-panel">
            <h2>Nous écrire</h2>
            <a class="contact-email" href="mailto:contact@mobilier-addict.com">contact@mobilier-addict.com</a>
            <h3>Pour préparer un achat</h3>
            <p>Précisez les articles souhaités, les dimensions, la quantité, votre budget et votre commune ou ville de livraison.</p>
            <h3>Pour suivre une commande</h3>
            <p>Indiquez votre référence de commande et la date d’achat. Pour un problème à la réception, préparez une description et des photos à transmettre à notre équipe.</p>
            <nav class="contact-help" aria-label="Aide et suivi"><a class="tlink" href="{{ route('pages.customer-service') }}">Préparer ma demande d’assistance →</a><a class="tlink" href="{{ route('pages.faq') }}">Consulter la FAQ →</a></nav>
        </div>
        <!-- about banner end -->
    </div></section>
</div>
@endsection
