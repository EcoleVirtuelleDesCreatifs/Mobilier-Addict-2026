@extends('maquette.layout')

@section('title', 'Livraison et retours à Abidjan | Mobilier Addict')
@section('meta_description', "Livraison sous 48h à Abidjan et partout en Côte d'Ivoire, gratuite dès 50 000 F. Retours produits défectueux sous 7 jours : la procédure complète.")

@php
    $zones = [
        ['Abidjan (Cocody, Plateau, Yopougon, Marcory, Treichville, Abobo…)', 'Sous 48 h', 'Gratuite dès 50 000 F d’achat, sinon 2 000 à 5 000 F selon la commune'],
        ['Bouaké, Yamoussoukro, San-Pédro, Daloa…', '2 à 4 jours ouvrés', 'Sur devis, via transporteur partenaire'],
        ['Reste de la Côte d’Ivoire', '3 à 7 jours ouvrés', 'Sur devis, via transporteur partenaire'],
    ];
    $deliverySteps = [
        ['Confirmation', 'Nous confirmons les détails, le tarif exact et la disponibilité par téléphone ou WhatsApp.'],
        ['Préparation', 'Emballage soigné selon le type de produit. Montage offert sur les gros articles.'],
        ['Réception', 'Vérifiez l’emballage et le produit. En cas d’anomalie : photo + numéro de commande.'],
    ];
    $returnSteps = [
        ['Contact', 'Écrivez-nous sur WhatsApp (plus rapide) ou par email dans les 7 jours suivant la réception, avec votre numéro de commande et une photo du défaut.'],
        ['Récupération', 'Après validation, nous venons récupérer l’article chez vous (Abidjan) ou vous indiquons le point de dépôt. Les frais de retour sont à notre charge si le défaut est confirmé.'],
        ['Échange ou remboursement', 'Échange contre le même modèle, ou remboursement intégral si le produit n’est plus disponible.'],
    ];
    $faq = [
        ['Quels éléments fournir pour le suivi ?', 'Numéro de commande, nom, et si possible le numéro de téléphone utilisé.'],
        ['Que faire si le colis est abîmé ?', 'Prenez une photo et contactez-nous rapidement avec votre numéro de commande.'],
        ['Comment lancer un retour ?', 'Contactez le service client sous 7 jours et indiquez le motif + votre numéro de commande. Nous venons récupérer l’article.'],
        ['La garantie 10 ans concerne quoi ?', 'Les défauts de fabrication de la mousse (affaissement anormal hors usure normale), hors retour pour défaut à réception qui reste limité à 7 jours.'],
    ];
@endphp

@push('meta')
    <script type="application/ld+json">
        {!! json_encode([
            '@@context' => 'https://schema.org',
            '@type' => 'FAQPage',
            'mainEntity' => collect($faq)->map(fn ($i) => [
                '@type' => 'Question',
                'name' => $i[0],
                'acceptedAnswer' => ['@type' => 'Answer', 'text' => $i[1]],
            ])->all(),
        ], JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE) !!}
    </script>
@endpush

@push('styles')
    <style>
        .ma27 .sr-sec{padding-bottom:72px}
        .ma27 .sr-sec h2{font:400 clamp(30px,3.4vw,44px)/1.05 var(--serif);margin:0 0 12px}
        .ma27 .sr-sec .intro{color:var(--ink-2);font-size:17px;line-height:1.7;max-width:720px;margin:0 0 28px}
        .ma27 .sr-table-wrap{overflow-x:auto;border:1px solid var(--line);border-radius:24px;background:#fff}
        .ma27 .sr-table{width:100%;border-collapse:collapse;font-size:15px;min-width:560px}
        .ma27 .sr-table th{padding:16px 22px;text-align:left;font:600 13px/1.4 Helvetica,Arial,sans-serif;letter-spacing:.06em;text-transform:uppercase;color:var(--muted);border-bottom:1px solid var(--line)}
        .ma27 .sr-table td{padding:18px 22px;border-bottom:1px solid var(--line);color:var(--ink-2);line-height:1.5;vertical-align:top}
        .ma27 .sr-table tr:last-child td{border-bottom:0}
        .ma27 .sr-table td:first-child{color:var(--ink);font-weight:600}
        .ma27 .sr-steps{display:grid;grid-template-columns:repeat(3,minmax(0,1fr));gap:20px;margin-top:24px;padding:0;list-style:none;counter-reset:step}
        .ma27 .sr-steps li{padding:28px;border:1px solid var(--line);border-radius:24px;background:#fff;counter-increment:step}
        .ma27 .sr-steps li::before{content:counter(step,decimal-leading-zero);display:block;margin-bottom:14px;font:600 13px/1 Helvetica,Arial,sans-serif;letter-spacing:.12em;color:var(--pink-dark)}
        .ma27 .sr-steps h3{font:600 18px/1.3 Helvetica,Arial,sans-serif;margin:0 0 8px}
        .ma27 .sr-steps p{margin:0;color:var(--ink-2);font-size:15px;line-height:1.65}
        .ma27 .sr-note{margin-top:18px;font-size:14px;color:var(--muted);max-width:760px}
        .ma27 .sr-faq details{border-top:1px solid var(--line)}
        .ma27 .sr-faq details:last-child{border-bottom:1px solid var(--line)}
        .ma27 .sr-faq summary{display:flex;justify-content:space-between;gap:20px;padding:22px 0;cursor:pointer;list-style:none;font:600 17px/1.4 Helvetica,Arial,sans-serif;color:var(--ink)}
        .ma27 .sr-faq summary::-webkit-details-marker{display:none}
        .ma27 .sr-faq summary::after{content:'+';color:var(--pink-dark);font-size:24px;line-height:1}
        .ma27 .sr-faq details[open] summary::after{content:'−'}
        .ma27 .sr-faq p{margin:0 0 22px;color:var(--ink-2);line-height:1.7;max-width:760px}
        .ma27 .sr-pay{display:flex;flex-wrap:wrap;justify-content:space-between;align-items:center;gap:24px;padding:36px;border-radius:24px;background:var(--ink);color:#fff}
        .ma27 .sr-pay h2{color:#fff;margin:0 0 8px}
        .ma27 .sr-pay p{margin:0;color:#C8D0E6;max-width:560px}
        @media(max-width:768px){.ma27 .sr-steps{grid-template-columns:1fr}.ma27 .sr-sec{padding-bottom:52px}.ma27 .sr-pay{padding:26px}}
    </style>
@endpush

@section('content')
<div class="ma27">
    <section class="page-head"><div class="wrap">
        <nav class="crumbs" aria-label="Fil d’Ariane"><a href="{{ route('home') }}">Accueil</a><span>/</span><span>Livraison &amp; retours</span></nav>
        <h1>Livraison &amp; retours <em>à Abidjan.</em></h1>
        <p class="lead">Livraison sous 48 h à Abidjan — gratuite dès 50 000 F d’achat — et expédition partout en Côte d’Ivoire. Produit défectueux ? Échange ou remboursement sous 7 jours.</p>
    </div></section>

    <section class="sr-sec" aria-labelledby="zones-title"><div class="wrap">
        <h2 id="zones-title">Délais et tarifs par zone</h2>
        <p class="intro">Le tarif exact et le créneau sont confirmés avec vous avant la livraison.</p>
        <div class="sr-table-wrap">
            <table class="sr-table">
                <thead><tr><th scope="col">Zone</th><th scope="col">Délai</th><th scope="col">Tarif</th></tr></thead>
                <tbody>
                    @foreach($zones as [$zone, $delay, $price])
                        <tr><td>{{ $zone }}</td><td>{{ $delay }}</td><td>{{ $price }}</td></tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <ol class="sr-steps" aria-label="Étapes de la livraison">
            @foreach($deliverySteps as [$title, $text])
                <li><h3>{{ $title }}</h3><p>{{ $text }}</p></li>
            @endforeach
        </ol>
    </div></section>

    <section class="sr-sec" aria-labelledby="returns-title"><div class="wrap">
        <h2 id="returns-title">Retours et échanges sous 7 jours</h2>
        <p class="intro">Un article défectueux est échangé ou remboursé sous 7 jours après réception. Voici la marche à suivre.</p>
        <ol class="sr-steps" aria-label="Étapes du retour">
            @foreach($returnSteps as [$title, $text])
                <li><h3>{{ $title }}</h3><p>{{ $text }}</p></li>
            @endforeach
        </ol>
        <p class="sr-note">La garantie 10 ans couvre les défauts de fabrication de la mousse (affaissement anormal) au-delà de cette période — distincte du retour pour défaut constaté à réception.</p>
    </div></section>

    <section class="sr-sec" aria-label="Paiement"><div class="wrap">
        <div class="sr-pay">
            <div>
                <h2>Payé à la livraison</h2>
                <p>Espèces ou Mobile Money à la livraison — vous ne réglez qu’à la réception de votre commande.</p>
            </div>
            <a class="btn pink" href="https://wa.me/{{ whatsapp_number() }}" target="_blank" rel="noopener">Une question ? WhatsApp →</a>
        </div>
    </div></section>

    <section class="sr-sec contact-content" aria-labelledby="sr-faq-title"><div class="wrap split">
        <div class="sr-faq">
            <h2 id="sr-faq-title" style="font:400 clamp(30px,3.4vw,44px)/1.05 var(--serif);margin:0 0 24px">Questions fréquentes</h2>
            @foreach($faq as [$q, $a])
                <details><summary>{{ $q }}</summary><p>{{ $a }}</p></details>
            @endforeach
        </div>
        <ul class="chan">
            <li><a href="https://wa.me/{{ whatsapp_number() }}" target="_blank" rel="noopener"><div><small>WhatsApp · le plus rapide</small><b>Écrire au service client</b></div><span class="arr" aria-hidden="true">→</span></a></li>
            <li><a href="tel:+2250799140356"><div><small>Téléphone</small><b>+225 07 99 14 03 56</b></div><span class="arr" aria-hidden="true">→</span></a></li>
            <li><a href="mailto:contact@mobilier-addict.com"><div><small>E-mail</small><b>contact@mobilier-addict.com</b></div><span class="arr" aria-hidden="true">→</span></a></li>
        </ul>
    </div></section>
</div>
@endsection
