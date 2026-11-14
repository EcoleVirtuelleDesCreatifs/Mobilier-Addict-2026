@extends('maquette.layout')

@section('title', 'Livraison & Retours à Abidjan — Mobilier Addict')
@section('meta_description', "Livraison sous 48h à Abidjan et partout en Côte d'Ivoire, gratuite dès 50 000 F. Retours produits défectueux sous 7 jours : la procédure complète.")

@push('styles')
    <style>
        .sr{background:#0b0b12;padding:36px 0 70px}
        .sr-hero{border-radius:22px;padding:22px;background:linear-gradient(135deg,rgba(255,76,154,.22),rgba(122,92,255,.18));border:1px solid rgba(255,255,255,.12)}
        .sr h1,.sr h2,.sr h3{color:#fff}
        .sr p,.sr li{color:rgba(255,255,255,.72);line-height:1.7}
        .sr-card{border-radius:22px;background:rgba(255,255,255,.06);border:1px solid rgba(255,255,255,.10);padding:18px}
        .sr-grid{display:grid;grid-template-columns:repeat(3,1fr);gap:14px}
        .sr-table{width:100%;border-collapse:collapse;font-size:14px}
        .sr-table th{color:#fff;text-align:left;padding:10px 12px;border-bottom:1px solid rgba(255,255,255,.14);font-weight:800}
        .sr-table td{padding:10px 12px;border-bottom:1px solid rgba(255,255,255,.08);color:rgba(255,255,255,.75)}
        .sr-steps{display:grid;gap:12px}
        .sr-step{display:flex;gap:12px;align-items:flex-start;border-radius:18px;background:rgba(255,255,255,.06);border:1px solid rgba(255,255,255,.10);padding:14px}
        .sr-dot{width:40px;height:40px;border-radius:14px;display:grid;place-items:center;background:linear-gradient(135deg,rgba(255,76,154,.86),rgba(122,92,255,.86));color:#fff;font-weight:900;flex:0 0 auto}
        .sr-btn{display:inline-flex;gap:10px;align-items:center;justify-content:center;padding:12px 14px;border-radius:14px;border:1px solid rgba(255,255,255,.16);color:#fff;text-decoration:none;font-weight:800;background:rgba(255,255,255,.10)}
        .sr-btn--primary{background:linear-gradient(135deg,rgba(255,76,154,.94),rgba(122,92,255,.94))}
        .sr-faq details{border-radius:16px;background:rgba(255,255,255,.06);border:1px solid rgba(255,255,255,.10);padding:12px}
        .sr-faq summary{cursor:pointer;color:#fff;font-weight:900;list-style:none}
        .sr-faq summary::-webkit-details-marker{display:none}
        @media(max-width:991.98px){.sr-grid{grid-template-columns:1fr}}
    </style>
@endpush

@section('content')
<section class="sr" aria-label="Livraison et retours">
    <div class="container">
        <div class="sr-hero">
            <h1 style="margin:0 0 10px;font-weight:900;letter-spacing:-.4px;">Livraison &amp; Retours à Abidjan</h1>
            <p style="margin:0;max-width:72ch;">Nous livrons en <strong style="color:#fff;">48&nbsp;h à Abidjan</strong> — gratuite dès <strong style="color:#fff;">50&nbsp;000&nbsp;F</strong> d'achat — et expédions partout en Côte d'Ivoire. Produit défectueux&nbsp;? Échange ou remboursement sous <strong style="color:#fff;">7 jours</strong>.</p>
            <div style="display:flex;flex-wrap:wrap;gap:12px;margin-top:16px;">
                <a class="sr-btn sr-btn--primary" href="https://wa.me/{{ whatsapp_number() }}" target="_blank" rel="noopener"><i class="fa-brands fa-whatsapp"></i> WhatsApp</a>
                <a class="sr-btn" href="{{ route('pages.contact') }}"><i class="fa-solid fa-headset"></i> Contact</a>
                <a class="sr-btn" href="mailto:contact@mobilier-addict.com"><i class="fa-solid fa-envelope"></i> Email</a>
            </div>
        </div>

        <div class="sr-card" style="margin-top:16px;">
            <h2 style="margin:0 0 8px;font-weight:900;">Délais et tarifs par zone</h2>
            <table class="sr-table" style="margin-top:8px;">
                <thead>
                    <tr><th>Zone</th><th>Délai</th><th>Tarif</th></tr>
                </thead>
                <tbody>
                    <tr><td>Abidjan (Cocody, Plateau, Yopougon, Marcory, Treichville, Abobo…)</td><td>Sous 48&nbsp;h</td><td>Gratuite dès 50&nbsp;000&nbsp;F d'achat, sinon 2&nbsp;000–5&nbsp;000&nbsp;F selon la commune</td></tr>
                    <tr><td>Bouaké, Yamoussoukro, San-Pédro, Daloa…</td><td>2 à 4 jours ouvrés</td><td>Sur devis, via transporteur partenaire</td></tr>
                    <tr><td>Reste de la Côte d'Ivoire</td><td>3 à 7 jours ouvrés</td><td>Sur devis, via transporteur partenaire</td></tr>
                </tbody>
            </table>
            <div class="sr-grid" style="margin-top:14px;">
                <div class="sr-card" style="padding:14px;">
                    <h3 style="margin:0 0 6px;font-weight:900;font-size:15px;">1) Confirmation</h3>
                    <p style="margin:0;">Nous confirmons les détails, le tarif exact et la disponibilité par téléphone ou WhatsApp.</p>
                </div>
                <div class="sr-card" style="padding:14px;">
                    <h3 style="margin:0 0 6px;font-weight:900;font-size:15px;">2) Préparation</h3>
                    <p style="margin:0;">Emballage soigné selon le type de produit. Montage offert sur les gros articles.</p>
                </div>
                <div class="sr-card" style="padding:14px;">
                    <h3 style="margin:0 0 6px;font-weight:900;font-size:15px;">3) Réception</h3>
                    <p style="margin:0;">Vérifiez l'emballage et le produit. En cas d'anomalie : photo + numéro de commande.</p>
                </div>
            </div>
        </div>

        <div class="sr-card" style="margin-top:16px;">
            <h2 style="margin:0 0 8px;font-weight:900;">Retours &amp; échanges (produit défectueux, sous 7 jours)</h2>
            <p style="margin:0;">Un article défectueux est <strong style="color:#fff;">échangé ou remboursé sous 7 jours</strong> après réception. Voici la marche à suivre&nbsp;:</p>
            <div class="sr-steps" style="margin-top:14px;">
                <div class="sr-step"><div class="sr-dot">01</div><div><h3 style="margin:0;font-weight:900;font-size:15px;">Contact</h3><p style="margin:6px 0 0;">Écrivez-nous sur WhatsApp (plus rapide) ou par email dans les 7 jours suivant la réception, avec votre numéro de commande et une photo du défaut.</p></div></div>
                <div class="sr-step"><div class="sr-dot">02</div><div><h3 style="margin:0;font-weight:900;font-size:15px;">Récupération</h3><p style="margin:6px 0 0;">Après validation, <strong style="color:#fff;">nous venons récupérer l'article</strong> chez vous (Abidjan) ou vous indiquons le point de dépôt. Les frais de retour sont à notre charge si le défaut est confirmé.</p></div></div>
                <div class="sr-step"><div class="sr-dot">03</div><div><h3 style="margin:0;font-weight:900;font-size:15px;">Échange ou remboursement</h3><p style="margin:6px 0 0;">Échange contre le même modèle, ou remboursement intégral si le produit n'est plus disponible.</p></div></div>
            </div>
            <p style="margin:12px 0 0;font-size:13px;">La garantie 10 ans couvre les défauts de fabrication de la mousse (affaissement anormal) au-delà de cette période — distincte du retour pour défaut constaté à réception.</p>
        </div>

        <div class="sr-card" style="margin-top:16px;">
            <h2 style="margin:0 0 8px;font-weight:900;">Paiement</h2>
            <p style="margin:0;">Espèces ou Mobile Money à la livraison — vous ne réglez qu'à la réception de votre commande.</p>
        </div>

        <div class="sr-card sr-faq" style="margin-top:16px;">
            <h2 style="margin:0 0 10px;font-weight:900;">FAQ rapide</h2>
            <details><summary>Quels éléments fournir pour le suivi ?</summary><p>Numéro de commande, nom, et si possible le numéro de téléphone utilisé.</p></details>
            <details><summary>Que faire si le colis est abîmé ?</summary><p>Prenez une photo et contactez-nous rapidement avec votre numéro de commande.</p></details>
            <details><summary>Comment lancer un retour ?</summary><p>Contactez le service client sous 7 jours et indiquez le motif + votre numéro de commande. Nous venons récupérer l'article.</p></details>
            <details><summary>La garantie 10 ans concerne quoi ?</summary><p>Les défauts de fabrication de la mousse (affaissement anormal hors usure normale), hors retour pour défaut à réception qui reste limité à 7 jours.</p></details>
        </div>
    </div>
</section>
@endsection
