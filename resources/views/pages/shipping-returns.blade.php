@extends('layouts.front')

@section('title', 'Livraison & Retours')
@section('meta_description', "Informations sur la livraison et les retours chez Mobilier Addict.")

@push('styles')
    <style>
        .sr{background:#0b0b12;padding:36px 0 70px}
        .sr-hero{border-radius:22px;padding:22px;background:linear-gradient(135deg,rgba(255,76,154,.22),rgba(122,92,255,.18));border:1px solid rgba(255,255,255,.12)}
        .sr h1,.sr h2,.sr h3{color:#fff}
        .sr p,.sr li{color:rgba(255,255,255,.72);line-height:1.7}
        .sr-card{border-radius:22px;background:rgba(255,255,255,.06);border:1px solid rgba(255,255,255,.10);padding:18px}
        .sr-grid{display:grid;grid-template-columns:repeat(3,1fr);gap:14px}
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
            <h1 style="margin:0 0 10px;font-weight:900;letter-spacing:-.4px;">Livraison &amp; Retours</h1>
            <p style="margin:0;max-width:72ch;">Les délais et modalités peuvent varier selon les produits. Pour toute demande, préparez votre <strong style="color:#fff;">numéro de commande</strong> et votre nom.</p>
            <div style="display:flex;flex-wrap:wrap;gap:12px;margin-top:16px;">
                <a class="sr-btn sr-btn--primary" href="https://wa.me/2250799140356" target="_blank" rel="noopener"><i class="fa-brands fa-whatsapp"></i> WhatsApp</a>
                <a class="sr-btn" href="{{ route('pages.contact') }}"><i class="fa-solid fa-headset"></i> Contact</a>
                <a class="sr-btn" href="mailto:contact@mobilier-addict.com"><i class="fa-solid fa-envelope"></i> Email</a>
            </div>
        </div>

        <div class="sr-card" style="margin-top:16px;">
            <h2 style="margin:0 0 8px;font-weight:900;">Livraison</h2>
            <p style="margin:0;">Les informations de livraison sont communiquées lors de la commande et dans le suivi.</p>
            <div class="sr-grid" style="margin-top:14px;">
                <div class="sr-card" style="padding:14px;">
                    <h3 style="margin:0 0 6px;font-weight:900;font-size:15px;">1) Confirmation</h3>
                    <p style="margin:0;">Nous confirmons les détails et la disponibilité.</p>
                </div>
                <div class="sr-card" style="padding:14px;">
                    <h3 style="margin:0 0 6px;font-weight:900;font-size:15px;">2) Préparation</h3>
                    <p style="margin:0;">Emballage soigné selon le type de produit.</p>
                </div>
                <div class="sr-card" style="padding:14px;">
                    <h3 style="margin:0 0 6px;font-weight:900;font-size:15px;">3) Réception</h3>
                    <p style="margin:0;">Vérifiez l’emballage et le produit. En cas d’anomalie: photo + numéro de commande.</p>
                </div>
            </div>
        </div>

        <div class="sr-card" style="margin-top:16px;">
            <h2 style="margin:0 0 8px;font-weight:900;">Retours &amp; échanges</h2>
            <p style="margin:0;">Contactez le service client en précisant votre numéro de commande.</p>
            <div class="sr-steps" style="margin-top:14px;">
                <div class="sr-step"><div class="sr-dot">01</div><div><h3 style="margin:0;font-weight:900;font-size:15px;">Contact</h3><p style="margin:6px 0 0;">WhatsApp (plus rapide) ou email avec motif + infos.</p></div></div>
                <div class="sr-step"><div class="sr-dot">02</div><div><h3 style="margin:0;font-weight:900;font-size:15px;">Procédure</h3><p style="margin:6px 0 0;">Nous vous confirmons la marche à suivre selon le produit.</p></div></div>
                <div class="sr-step"><div class="sr-dot">03</div><div><h3 style="margin:0;font-weight:900;font-size:15px;">Solution</h3><p style="margin:6px 0 0;">Retour, échange ou solution SAV selon votre cas.</p></div></div>
            </div>
        </div>

        <div class="sr-card sr-faq" style="margin-top:16px;">
            <h2 style="margin:0 0 10px;font-weight:900;">FAQ rapide</h2>
            <details><summary>Quels éléments fournir pour le suivi ?</summary><p>Numéro de commande, nom, et si possible le numéro de téléphone utilisé.</p></details>
            <details><summary>Que faire si le colis est abîmé ?</summary><p>Prenez une photo et contactez-nous rapidement avec votre numéro de commande.</p></details>
            <details><summary>Comment lancer un retour ?</summary><p>Contactez le service client et indiquez le motif + votre numéro de commande.</p></details>
        </div>
    </div>
</section>
@endsection
