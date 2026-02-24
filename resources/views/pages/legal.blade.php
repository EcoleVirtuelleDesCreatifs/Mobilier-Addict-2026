@extends('layouts.front')

@section('title', 'Mentions légales')
@section('meta_description', "Mentions légales de Mobilier Addict.")

@push('styles')
    <style>
        .legal-page{background:#0b0b12}
        .legal-hero{position:relative;padding:62px 0 18px;overflow:hidden}
        .legal-hero__bg{position:absolute;inset:0;background:radial-gradient(900px 600px at 10% 10%,rgba(255,76,154,.22),transparent 65%),radial-gradient(900px 600px at 95% 20%,rgba(122,92,255,.22),transparent 60%),radial-gradient(900px 600px at 45% 90%,rgba(18,184,134,.16),transparent 60%),linear-gradient(180deg,#070710 0%,#111128 55%,#070710 100%)}
        .legal-hero__grid{position:relative;display:grid;grid-template-columns:1.15fr .85fr;gap:18px;align-items:stretch}
        .legal-kicker{display:inline-flex;align-items:center;gap:10px;padding:8px 12px;border-radius:999px;background:rgba(255,255,255,.10);border:1px solid rgba(255,255,255,.14);color:rgba(255,255,255,.88);font-weight:800;font-size:13px;letter-spacing:.2px}
        .legal-title{margin:14px 0 10px;color:#fff;font-weight:900;letter-spacing:-.8px;line-height:1.06;font-size:clamp(30px,4.6vw,52px)}
        .legal-subtitle{color:rgba(255,255,255,.72);max-width:70ch;font-size:15px;line-height:1.7;margin:0}
        .legal-actions{margin-top:18px;display:flex;flex-wrap:wrap;gap:12px}
        .legal-btn{display:inline-flex;align-items:center;justify-content:center;gap:10px;padding:12px 14px;border-radius:14px;border:1px solid rgba(255,255,255,.16);color:#fff;text-decoration:none;font-weight:800;background:rgba(255,255,255,.10);backdrop-filter:blur(12px)}
        .legal-btn--primary{background:linear-gradient(135deg,rgba(255,76,154,.94),rgba(122,92,255,.94));border-color:rgba(255,255,255,.18)}
        .legal-panel{border-radius:22px;background:rgba(255,255,255,.08);border:1px solid rgba(255,255,255,.14);box-shadow:0 18px 48px rgba(0,0,0,.35);backdrop-filter:blur(14px)}
        .legal-panel__inner{padding:18px;display:grid;gap:10px}
        .legal-chip{display:inline-flex;align-items:center;gap:10px;padding:10px 12px;border-radius:14px;background:rgba(255,255,255,.08);border:1px solid rgba(255,255,255,.10);color:rgba(255,255,255,.86);font-weight:900;text-decoration:none;font-size:13px}
        .legal-chip:hover{background:rgba(255,255,255,.12)}
        .legal-body{padding:18px 0 70px}
        .legal-card{border-radius:22px;background:rgba(255,255,255,.06);border:1px solid rgba(255,255,255,.10);box-shadow:0 18px 48px rgba(0,0,0,.28);overflow:hidden}
        .legal-card__head{padding:20px 20px 0}
        .legal-card__title{margin:0;color:#fff;font-weight:900;letter-spacing:-.4px;font-size:20px}
        .legal-card__subtitle{margin:8px 0 0;color:rgba(255,255,255,.70);font-size:14px;line-height:1.7}
        .legal-card__body{padding:20px}
        .legal-card__body p{margin:0;color:rgba(255,255,255,.72);font-size:14px;line-height:1.75}
        .legal-card__body p+p{margin-top:10px}
        .legal-card__body a{color:#fff}
        @media(max-width:991.98px){.legal-hero__grid{grid-template-columns:1fr}}
    </style>
@endpush

@section('content')
<div class="legal-page">
    <section class="legal-hero" aria-label="Mentions légales">
        <div class="legal-hero__bg"></div>
        <div class="container">
            <div class="legal-hero__grid">
                <div>
                    <div class="legal-kicker"><i class="fa-solid fa-scale-balanced"></i> Informations légales</div>
                    <h1 class="legal-title">Mentions légales</h1>
                    <p class="legal-subtitle">Transparence, conformité et informations essentielles sur l’éditeur du site et les moyens de contact. Pour toute demande, notre support répond rapidement.</p>

                    <div class="legal-actions">
                        <a class="legal-btn legal-btn--primary" href="{{ route('pages.contact') }}"><i class="fa-solid fa-headset"></i> Contacter le support <i class="fa-solid fa-arrow-right"></i></a>
                        <a class="legal-btn" href="mailto:contact@mobilier-addict.com"><i class="fa-regular fa-envelope"></i> Email</a>
                        <a class="legal-btn" href="https://wa.me/{{ whatsapp_number() }}" target="_blank" rel="noopener"><i class="fa-brands fa-whatsapp"></i> WhatsApp</a>
                    </div>
                </div>

                <aside class="legal-panel" aria-label="Accès rapide">
                    <div class="legal-panel__inner">
                        <a class="legal-chip" href="#editeur"><i class="fa-solid fa-building"></i> Éditeur</a>
                        <a class="legal-chip" href="#contact"><i class="fa-solid fa-paper-plane"></i> Contact</a>
                        <a class="legal-chip" href="{{ route('pages.privacy') }}"><i class="fa-solid fa-user-shield"></i> Confidentialité</a>
                        <a class="legal-chip" href="{{ route('pages.cgv') }}"><i class="fa-solid fa-file-contract"></i> CGV</a>
                    </div>
                </aside>
            </div>
        </div>
    </section>

    <section class="legal-body" aria-label="Contenu mentions légales">
        <div class="container">
            <div class="legal-card" id="editeur">
                <div class="legal-card__head">
                    <h2 class="legal-card__title">Éditeur du site</h2>
                    <p class="legal-card__subtitle">Informations relatives à l’éditeur du site.</p>
                </div>
                <div class="legal-card__body">
                    <p>Mobilier Addict</p>
                </div>
            </div>

            <div class="legal-card" id="contact" style="margin-top:18px;">
                <div class="legal-card__head">
                    <h2 class="legal-card__title">Contact</h2>
                    <p class="legal-card__subtitle">Écris-nous, on répond rapidement.</p>
                </div>
                <div class="legal-card__body">
                    <p>Email : <a href="mailto:contact@mobilier-addict.com">contact@mobilier-addict.com</a></p>
                </div>
            </div>
        </div>
    </section>
</div>
@endsection
