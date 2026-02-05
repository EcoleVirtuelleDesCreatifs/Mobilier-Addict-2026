@extends('layouts.front')

@section('title', 'Conditions Générales de Vente')
@section('meta_description', "Conditions Générales de Vente (CGV) de Mobilier Addict.")

@push('styles')
    <style>
        .cgv-page{background:#0b0b12}
        .cgv-hero{position:relative;padding:62px 0 18px;overflow:hidden}
        .cgv-hero__bg{position:absolute;inset:0;background:radial-gradient(900px 600px at 10% 10%,rgba(255,76,154,.22),transparent 65%),radial-gradient(900px 600px at 95% 20%,rgba(122,92,255,.22),transparent 60%),radial-gradient(900px 600px at 45% 90%,rgba(18,184,134,.16),transparent 60%),linear-gradient(180deg,#070710 0%,#111128 55%,#070710 100%)}
        .cgv-hero__grid{position:relative;display:grid;grid-template-columns:1.15fr .85fr;gap:18px;align-items:stretch}
        .cgv-kicker{display:inline-flex;align-items:center;gap:10px;padding:8px 12px;border-radius:999px;background:rgba(255,255,255,.10);border:1px solid rgba(255,255,255,.14);color:rgba(255,255,255,.88);font-weight:800;font-size:13px;letter-spacing:.2px}
        .cgv-title{margin:14px 0 10px;color:#fff;font-weight:900;letter-spacing:-.8px;line-height:1.06;font-size:clamp(30px,4.6vw,52px)}
        .cgv-subtitle{color:rgba(255,255,255,.72);max-width:70ch;font-size:15px;line-height:1.7;margin:0}
        .cgv-actions{margin-top:18px;display:flex;flex-wrap:wrap;gap:12px}
        .cgv-btn{display:inline-flex;align-items:center;justify-content:center;gap:10px;padding:12px 14px;border-radius:14px;border:1px solid rgba(255,255,255,.16);color:#fff;text-decoration:none;font-weight:800;background:rgba(255,255,255,.10);backdrop-filter:blur(12px)}
        .cgv-btn--primary{background:linear-gradient(135deg,rgba(255,76,154,.94),rgba(122,92,255,.94));border-color:rgba(255,255,255,.18)}
        .cgv-panel{border-radius:22px;background:rgba(255,255,255,.08);border:1px solid rgba(255,255,255,.14);box-shadow:0 18px 48px rgba(0,0,0,.35);backdrop-filter:blur(14px)}
        .cgv-panel__inner{padding:18px;display:grid;gap:10px}
        .cgv-chip{display:inline-flex;align-items:center;gap:10px;padding:10px 12px;border-radius:14px;background:rgba(255,255,255,.08);border:1px solid rgba(255,255,255,.10);color:rgba(255,255,255,.86);font-weight:900;text-decoration:none;font-size:13px}
        .cgv-chip:hover{background:rgba(255,255,255,.12)}
        .cgv-body{padding:18px 0 70px}
        .cgv-card{border-radius:22px;background:rgba(255,255,255,.06);border:1px solid rgba(255,255,255,.10);box-shadow:0 18px 48px rgba(0,0,0,.28);overflow:hidden}
        .cgv-card__head{padding:20px 20px 0}
        .cgv-card__title{margin:0;color:#fff;font-weight:900;letter-spacing:-.4px;font-size:20px}
        .cgv-card__subtitle{margin:8px 0 0;color:rgba(255,255,255,.70);font-size:14px;line-height:1.7}
        .cgv-card__body{padding:20px}
        .cgv-card__body p{margin:0;color:rgba(255,255,255,.72);font-size:14px;line-height:1.75}
        .cgv-card__body p+p{margin-top:10px}
        .cgv-card__body a{color:#fff}
        @media(max-width:991.98px){.cgv-hero__grid{grid-template-columns:1fr}}
    </style>
@endpush

@section('content')
<div class="cgv-page">
    <section class="cgv-hero" aria-label="Conditions Générales de Vente">
        <div class="cgv-hero__bg"></div>
        <div class="container">
            <div class="cgv-hero__grid">
                <div>
                    <div class="cgv-kicker"><i class="fa-solid fa-file-contract"></i> Cadre contractuel</div>
                    <h1 class="cgv-title">Conditions Générales de Vente</h1>
                    <p class="cgv-subtitle">Ces conditions régissent les ventes effectuées sur Mobilier Addict. Pour une question sur une commande, notre support peut vous aider rapidement.</p>

                    <div class="cgv-actions">
                        <a class="cgv-btn cgv-btn--primary" href="{{ route('pages.contact') }}"><i class="fa-solid fa-headset"></i> Contacter le support <i class="fa-solid fa-arrow-right"></i></a>
                        <a class="cgv-btn" href="{{ route('pages.shipping-returns') }}"><i class="fa-solid fa-truck-fast"></i> Livraison &amp; Retours</a>
                        <a class="cgv-btn" href="mailto:contact@mobilier-addict.com"><i class="fa-regular fa-envelope"></i> Email</a>
                    </div>
                </div>

                <aside class="cgv-panel" aria-label="Accès rapide">
                    <div class="cgv-panel__inner">
                        <a class="cgv-chip" href="#prix"><i class="fa-solid fa-tags"></i> Produits &amp; prix</a>
                        <a class="cgv-chip" href="#commande"><i class="fa-solid fa-bag-shopping"></i> Commande</a>
                        <a class="cgv-chip" href="#contact"><i class="fa-solid fa-paper-plane"></i> Contact</a>
                        <a class="cgv-chip" href="{{ route('pages.privacy') }}"><i class="fa-solid fa-user-shield"></i> Confidentialité</a>
                    </div>
                </aside>
            </div>
        </div>
    </section>

    <section class="cgv-body" aria-label="Contenu CGV">
        <div class="container">
            <div class="cgv-card" id="prix">
                <div class="cgv-card__head">
                    <h2 class="cgv-card__title">Produits &amp; prix</h2>
                    <p class="cgv-card__subtitle">Informations tarifaires et disponibilité.</p>
                </div>
                <div class="cgv-card__body">
                    <p>Les prix affichés sont indiqués sur les pages produits. La disponibilité peut varier selon les stocks.</p>
                </div>
            </div>

            <div class="cgv-card" id="commande" style="margin-top:18px;">
                <div class="cgv-card__head">
                    <h2 class="cgv-card__title">Commande</h2>
                    <p class="cgv-card__subtitle">Validation et confirmation.</p>
                </div>
                <div class="cgv-card__body">
                    <p>Une commande est confirmée après validation et paiement (le cas échéant) selon le parcours d’achat.</p>
                </div>
            </div>

            <div class="cgv-card" id="contact" style="margin-top:18px;">
                <div class="cgv-card__head">
                    <h2 class="cgv-card__title">Contact</h2>
                    <p class="cgv-card__subtitle">Pour toute question, nous sommes disponibles.</p>
                </div>
                <div class="cgv-card__body">
                    <p>Pour toute question : <a href="mailto:contact@mobilier-addict.com">contact@mobilier-addict.com</a></p>
                </div>
            </div>
        </div>
    </section>
</div>
@endsection
