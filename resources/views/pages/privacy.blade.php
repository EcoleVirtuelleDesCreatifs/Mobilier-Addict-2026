@extends('layouts.front')

@section('title', 'Politique de confidentialité')
@section('meta_description', "Politique de confidentialité Mobilier Addict.")

@push('styles')
    <style>
        .privacy-page{background:#0b0b12}
        .privacy-hero{position:relative;padding:62px 0 18px;overflow:hidden}
        .privacy-hero__bg{position:absolute;inset:0;background:radial-gradient(900px 600px at 10% 10%,rgba(255,76,154,.22),transparent 65%),radial-gradient(900px 600px at 95% 20%,rgba(122,92,255,.22),transparent 60%),radial-gradient(900px 600px at 45% 90%,rgba(18,184,134,.16),transparent 60%),linear-gradient(180deg,#070710 0%,#111128 55%,#070710 100%)}
        .privacy-hero__grid{position:relative;display:grid;grid-template-columns:1.15fr .85fr;gap:18px;align-items:stretch}
        .privacy-kicker{display:inline-flex;align-items:center;gap:10px;padding:8px 12px;border-radius:999px;background:rgba(255,255,255,.10);border:1px solid rgba(255,255,255,.14);color:rgba(255,255,255,.88);font-weight:800;font-size:13px;letter-spacing:.2px}
        .privacy-title{margin:14px 0 10px;color:#fff;font-weight:900;letter-spacing:-.8px;line-height:1.06;font-size:clamp(30px,4.6vw,52px)}
        .privacy-subtitle{color:rgba(255,255,255,.72);max-width:70ch;font-size:15px;line-height:1.7;margin:0}
        .privacy-actions{margin-top:18px;display:flex;flex-wrap:wrap;gap:12px}
        .privacy-btn{display:inline-flex;align-items:center;justify-content:center;gap:10px;padding:12px 14px;border-radius:14px;border:1px solid rgba(255,255,255,.16);color:#fff;text-decoration:none;font-weight:800;background:rgba(255,255,255,.10);backdrop-filter:blur(12px)}
        .privacy-btn--primary{background:linear-gradient(135deg,rgba(255,76,154,.94),rgba(122,92,255,.94));border-color:rgba(255,255,255,.18)}
        .privacy-panel{border-radius:22px;background:rgba(255,255,255,.08);border:1px solid rgba(255,255,255,.14);box-shadow:0 18px 48px rgba(0,0,0,.35);backdrop-filter:blur(14px)}
        .privacy-panel__inner{padding:18px;display:grid;gap:10px}
        .privacy-chip{display:inline-flex;align-items:center;gap:10px;padding:10px 12px;border-radius:14px;background:rgba(255,255,255,.08);border:1px solid rgba(255,255,255,.10);color:rgba(255,255,255,.86);font-weight:900;text-decoration:none;font-size:13px}
        .privacy-chip:hover{background:rgba(255,255,255,.12)}
        .privacy-body{padding:18px 0 70px}
        .privacy-card{border-radius:22px;background:rgba(255,255,255,.06);border:1px solid rgba(255,255,255,.10);box-shadow:0 18px 48px rgba(0,0,0,.28);overflow:hidden}
        .privacy-card__head{padding:20px 20px 0}
        .privacy-card__title{margin:0;color:#fff;font-weight:900;letter-spacing:-.4px;font-size:20px}
        .privacy-card__subtitle{margin:8px 0 0;color:rgba(255,255,255,.70);font-size:14px;line-height:1.7}
        .privacy-card__body{padding:20px}
        .privacy-card__body p{margin:0;color:rgba(255,255,255,.72);font-size:14px;line-height:1.75}
        .privacy-card__body p+p{margin-top:10px}
        .privacy-card__body a{color:#fff}
        @media(max-width:991.98px){.privacy-hero__grid{grid-template-columns:1fr}}
    </style>
@endpush

@section('content')
<div class="privacy-page">
    <section class="privacy-hero" aria-label="Politique de confidentialité">
        <div class="privacy-hero__bg"></div>
        <div class="container">
            <div class="privacy-hero__grid">
                <div>
                    <div class="privacy-kicker"><i class="fa-solid fa-user-shield"></i> Données personnelles</div>
                    <h1 class="privacy-title">Politique de confidentialité</h1>
                    <p class="privacy-subtitle">Nous attachons une grande importance à la protection de vos données. Cette page explique simplement ce que nous collectons et pourquoi, ainsi que vos droits.</p>

                    <div class="privacy-actions">
                        <a class="privacy-btn privacy-btn--primary" href="{{ route('pages.contact') }}"><i class="fa-solid fa-headset"></i> Exercer un droit / Contact <i class="fa-solid fa-arrow-right"></i></a>
                        <a class="privacy-btn" href="mailto:contact@mobilier-addict.com"><i class="fa-regular fa-envelope"></i> Email</a>
                        <a class="privacy-btn" href="https://wa.me/{{ whatsapp_number() }}" target="_blank" rel="noopener"><i class="fa-brands fa-whatsapp"></i> WhatsApp</a>
                    </div>
                </div>

                <aside class="privacy-panel" aria-label="Accès rapide">
                    <div class="privacy-panel__inner">
                        <a class="privacy-chip" href="#collecte"><i class="fa-solid fa-database"></i> Données collectées</a>
                        <a class="privacy-chip" href="#newsletter"><i class="fa-solid fa-envelope-open-text"></i> Newsletter</a>
                        <a class="privacy-chip" href="{{ route('pages.legal') }}"><i class="fa-solid fa-scale-balanced"></i> Mentions légales</a>
                        <a class="privacy-chip" href="{{ route('pages.cgv') }}"><i class="fa-solid fa-file-contract"></i> CGV</a>
                    </div>
                </aside>
            </div>
        </div>
    </section>

    <section class="privacy-body" aria-label="Contenu confidentialité">
        <div class="container">
            <div class="privacy-card" id="collecte">
                <div class="privacy-card__head">
                    <h2 class="privacy-card__title">Données collectées</h2>
                    <p class="privacy-card__subtitle">Informations nécessaires au service et au traitement des commandes.</p>
                </div>
                <div class="privacy-card__body">
                    <p>Les données peuvent inclure vos informations de contact et les informations nécessaires au traitement des commandes.</p>
                </div>
            </div>

            <div class="privacy-card" id="newsletter" style="margin-top:18px;">
                <div class="privacy-card__head">
                    <h2 class="privacy-card__title">Newsletter</h2>
                    <p class="privacy-card__subtitle">Tu gardes le contrôle : désinscription à tout moment.</p>
                </div>
                <div class="privacy-card__body">
                    <p>Vous pouvez vous désinscrire à tout moment en nous contactant à <a href="mailto:contact@mobilier-addict.com">contact@mobilier-addict.com</a>.</p>
                </div>
            </div>
        </div>
    </section>
</div>
@endsection
