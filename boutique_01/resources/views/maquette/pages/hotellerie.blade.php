@extends('maquette.layout')

@section('title', 'Hôtellerie — Sur-mesure | Mobilier Addict')
@section('meta_description', 'Solutions professionnelles pour hôtels, chambres d\'hôtes et résidences de tourisme : matelas, literie, mobilier et électroménager en Côte d\'Ivoire.')

@push('styles')
<style>
    .smp-site { --smp-navy: #00234d; --smp-pink: #d8327f; --smp-pale: #fdf2f8; }
    .smp-hero { background: radial-gradient(circle at 85% 8%, rgba(216,50,127,.35), rgba(216,50,127,0) 48%), linear-gradient(120deg, #00234d 0%, #0b3059 60%, #123e6d 100%); color: #fff; padding: 72px 0 80px; }
    .smp-hero-grid { display: grid; grid-template-columns: minmax(0,1.08fr) minmax(0,.92fr); gap: 56px; align-items: center; }
    .smp-kicker { display: inline-block; color: #f2a6cc; font-size: 12px; font-weight: 600; letter-spacing: 1.8px; text-transform: uppercase; margin-bottom: 18px; }
    .smp-hero h1 { font-size: clamp(34px, 4.4vw, 56px); line-height: 1.12; letter-spacing: -1.5px; font-weight: 600; color: #fff; margin: 0 0 20px; }
    .smp-hero .smp-lead { color: #dbe4f0; font-size: 16px; line-height: 1.9; }
    .smp-hero-actions { display: flex; flex-wrap: wrap; gap: 14px; margin-top: 30px; }
    .smp-btn { display: inline-flex; align-items: center; gap: 10px; padding: 15px 26px; border-radius: 999px; font-size: 14px; font-weight: 600; text-decoration: none; transition: transform .2s ease, box-shadow .2s ease, background-color .2s ease, color .2s ease; }
    .smp-btn-primary { background: var(--smp-pink); color: #fff; box-shadow: 0 8px 22px rgba(216,50,127,.4); }
    .smp-btn-primary:hover { background: #fff; color: var(--smp-navy); transform: translateY(-2px); }
    .smp-btn-ghost { border: 1px solid rgba(255,255,255,.45); color: #fff; }
    .smp-btn-ghost:hover { background: rgba(255,255,255,.12); color: #fff; }
    .smp-badges { display: flex; flex-wrap: wrap; gap: 10px; margin-top: 28px; }
    .smp-badge { border: 1px solid rgba(255,255,255,.3); border-radius: 999px; padding: 7px 16px; font-size: 12px; color: #e6edf6; }
    .smp-hero-media { position: relative; }
    .smp-hero-media::before { content: ''; position: absolute; inset: 18px -18px -18px 18px; border: 2px solid var(--smp-pink); border-radius: 22px; z-index: 0; }
    .smp-hero-media img { position: relative; z-index: 1; width: 100%; aspect-ratio: 5/4; object-fit: cover; border-radius: 18px; box-shadow: 0 28px 60px rgba(0,0,0,.35); display: block; }
    .smp-hero-tag { position: absolute; z-index: 2; left: -14px; bottom: 22px; background: #fff; color: var(--smp-navy); border-radius: 14px; padding: 14px 20px; box-shadow: 0 14px 34px rgba(0,0,0,.3); }
    .smp-hero-tag strong { display: block; font-size: 15px; font-weight: 600; }
    .smp-hero-tag span { font-size: 12px; color: #5a6675; }
    .smp-story { padding: 76px 0 14px; text-align: center; }
    .smp-story .smp-story-inner { max-width: 780px; margin: 0 auto; }
    .smp-sec-kicker { color: var(--smp-pink); font-size: 12px; font-weight: 600; letter-spacing: 1.6px; text-transform: uppercase; margin-bottom: 14px; }
    .smp-story h2 { color: var(--smp-navy); font-size: clamp(26px, 3vw, 38px); line-height: 1.25; letter-spacing: -.8px; font-weight: 600; margin-bottom: 20px; }
    .smp-story p { color: #4a5563; line-height: 1.95; font-size: 15.5px; }
    .smp-modeles { padding: 64px 0 30px; }
    .smp-modeles-head { display: flex; align-items: flex-end; justify-content: space-between; gap: 32px; margin-bottom: 36px; }
    .smp-modeles h2, .smp-equip h2 { color: var(--smp-navy); font-size: clamp(24px, 2.6vw, 34px); letter-spacing: -.6px; font-weight: 600; margin: 0; }
    .smp-modeles-sub { color: #5a6675; max-width: 480px; line-height: 1.8; font-size: 14px; margin: 0; }
    .smp-modeles-grid { display: grid; grid-template-columns: repeat(3, minmax(0,1fr)); gap: 24px; }
    .smp-modele { position: relative; background: #fff; border: 1px solid #eceef1; border-radius: 18px; overflow: hidden; transition: transform .25s ease, box-shadow .25s ease, border-color .25s ease; }
    .smp-modele:hover { transform: translateY(-6px); border-color: var(--smp-pink); box-shadow: 0 18px 40px rgba(0,35,77,.14); }
    .smp-modele-img { position: relative; }
    .smp-modele-img img { width: 100%; aspect-ratio: 4/3; object-fit: cover; display: block; transition: transform .5s ease; }
    .smp-modele:hover .smp-modele-img img { transform: scale(1.06); }
    .smp-modele-num { position: absolute; top: 16px; left: 16px; z-index: 1; background: var(--smp-pink); color: #fff; font-size: 12px; font-weight: 600; letter-spacing: 1px; padding: 6px 14px; border-radius: 999px; }
    .smp-modele-body { padding: 24px 26px 28px; }
    .smp-modele h3 { color: var(--smp-navy); font-size: 19px; font-weight: 600; margin: 0 0 10px; }
    .smp-modele p { color: #5a6675; font-size: 13px; line-height: 1.8; margin: 0; }
    .smp-equip { background: var(--smp-pale); padding: 70px 0; margin-top: 50px; }
    .smp-equip-grid { display: grid; grid-template-columns: repeat(auto-fit, minmax(220px, 1fr)); gap: 16px; margin-top: 32px; }
    .smp-equip-item { display: block; background: #fff; border: 1px solid #f0dbe7; border-radius: 14px; padding: 22px 24px; color: inherit; transition: border-color .2s, transform .2s; }
    .smp-equip-item:hover { border-color: var(--smp-pink); transform: translateY(-3px); color: inherit; text-decoration: none; }
    .smp-equip-item strong { display: block; color: var(--smp-navy); font-size: 15px; font-weight: 600; margin-bottom: 8px; }
    .smp-equip-item span { color: #5a6675; font-size: 12.5px; line-height: 1.7; display: block; }
    .smp-equip-item em { display: inline-block; margin-top: 12px; color: var(--smp-pink); font-style: normal; font-size: 12px; font-weight: 600; }
    .smp-gros { padding: 80px 0; }
    .smp-gros-card { display: grid; grid-template-columns: minmax(0,1.5fr) minmax(0,1fr); gap: 48px; align-items: center; background: linear-gradient(115deg, #00234d 0%, #0b3059 55%, #d8327f 140%); border-radius: 24px; padding: 52px 56px; color: #fff; }
    .smp-gros h2 { color: #fff; font-size: clamp(24px, 2.8vw, 36px); letter-spacing: -.8px; font-weight: 600; margin-bottom: 18px; }
    .smp-gros p { color: #dbe4f0; line-height: 1.9; font-size: 14.5px; margin: 0; }
    .smp-gros-side { text-align: center; }
    .smp-gros-side .smp-btn { width: 100%; justify-content: center; margin-bottom: 12px; }
    .smp-gros-tel { color: #fff; font-weight: 600; font-size: 15px; }
    .smp-gros-tel:hover { color: #f2a6cc; }
    .smp-gros-list { list-style: none; padding: 0; margin: 22px 0 0; display: flex; flex-wrap: wrap; gap: 10px 26px; }
    .smp-gros-list li { color: #dbe4f0; font-size: 13px; padding-left: 22px; position: relative; }
    .smp-gros-list li::before { content: ''; position: absolute; left: 0; top: 6px; width: 12px; height: 7px; border-left: 2px solid #f2a6cc; border-bottom: 2px solid #f2a6cc; transform: rotate(-45deg); }
    .smp-hotel-perks { padding: 70px 0; background: #fff; }
    .smp-perks-grid { display: grid; grid-template-columns: repeat(4, minmax(0,1fr)); gap: 20px; margin-top: 32px; }
    .smp-perk { text-align: center; padding: 28px 20px; border: 1px solid #eceef1; border-radius: 18px; }
    .smp-perk-icon { width: 48px; height: 48px; margin: 0 auto 16px; color: var(--smp-pink); }
    .smp-perk h3 { color: var(--smp-navy); font-size: 16px; font-weight: 600; margin: 0 0 8px; }
    .smp-perk p { color: #5a6675; font-size: 13px; line-height: 1.7; margin: 0; }
    @media (max-width: 991px) {
        .smp-hero-grid, .smp-gros-card { grid-template-columns: 1fr; gap: 40px; }
        .smp-hero-media { max-width: 560px; }
        .smp-modeles-grid { grid-template-columns: repeat(2, minmax(0,1fr)); }
        .smp-modeles-head { flex-direction: column; align-items: flex-start; gap: 14px; }
        .smp-gros-card { padding: 40px 32px; }
        .smp-perks-grid { grid-template-columns: repeat(2, minmax(0,1fr)); }
    }
    @media (max-width: 640px) {
        .smp-hero { padding: 56px 0 64px; }
        .smp-modeles-grid { grid-template-columns: 1fr; }
        .smp-hero-tag { left: 8px; }
        .smp-perks-grid { grid-template-columns: 1fr; }
    }
</style>
@endpush

@section('content')
@php
    $smPages = require resource_path('views/maquette/includes/surmesure-data.blade.php');
    $page = $smPages['hotellerie'];

    // Corrige les chemins d'images hérités du fichier de données
    $page['image'] = str_replace('assets/img/blog/', 'assets/maquette/img/blog/', $page['image']);
    foreach ($page['modeles'] as $i => $modele) {
        $page['modeles'][$i]['img'] = str_replace('assets/img/blog/', 'assets/maquette/img/blog/', $modele['img']);
    }

    // Routes internes pour les gammes d'équipement
    $equipRoutes = [
        'matelas.php' => route('category.show', 'luxury'),
        'oreillers-et-taies.php' => route('pages.guides.pillow'),
        'drap-et-couettes.php' => route('category.show', 'accessoires'),
        'mobilier-accessoire.php' => route('category.show', 'accessoires'),
        'electromenager.php' => route('category.show', 'climatiseurs'),
    ];
@endphp

<!-- breadcrumb start -->
<div class="breadcrumb">
    <div class="container">
        <ul class="list-unstyled d-flex align-items-center m-0">
            <li><a href="{{ route('home') }}">Accueil</a></li>
            <li>
                <svg class="icon icon-breadcrumb" width="64" height="64" viewBox="0 0 64 64" fill="none" xmlns="http://www.w3.org/2000/svg"><g opacity="0.4"><path d="M25.9375 8.5625L23.0625 11.4375L43.625 32L23.0625 52.5625L25.9375 55.4375L47.9375 33.4375L49.3125 32L47.9375 30.5625L25.9375 8.5625Z" fill="#000"/></g></svg>
            </li>
            <li>Sur-mesure</li>
            <li>
                <svg class="icon icon-breadcrumb" width="64" height="64" viewBox="0 0 64 64" fill="none" xmlns="http://www.w3.org/2000/svg"><g opacity="0.4"><path d="M25.9375 8.5625L23.0625 11.4375L43.625 32L23.0625 52.5625L25.9375 55.4375L47.9375 33.4375L49.3125 32L47.9375 30.5625L25.9375 8.5625Z" fill="#000"/></g></svg>
            </li>
            <li>{{ $page['title'] }}</li>
        </ul>
    </div>
</div>
<!-- breadcrumb end -->

<div class="smp-site">
    <section class="smp-hero">
        <div class="container">
            <div class="smp-hero-grid">
                <div>
                    <span class="smp-kicker">{{ $page['kicker'] }}</span>
                    <h1>{{ $page['title'] }}</h1>
                    <p class="smp-lead">{{ $page['lead'] }}</p>
                    <div class="smp-hero-actions">
                        <a class="smp-btn smp-btn-primary" href="{{ route('devis.create') }}">Demander un devis →</a>
                        <a class="smp-btn smp-btn-ghost" href="tel:+2250799140356">+225 07 99 14 03 56</a>
                    </div>
                    <div class="smp-badges">
                        <span class="smp-badge">Commandes en gros</span>
                        <span class="smp-badge">Devis personnalisé</span>
                        <span class="smp-badge">Livraison Côte d’Ivoire</span>
                        <span class="smp-badge">Accompagnement dédié</span>
                    </div>
                </div>
                <figure class="smp-hero-media">
                    <img src="{{ asset($page['image']) }}" alt="{{ $page['image_alt'] }}" loading="eager" fetchpriority="high" decoding="async">
                    <div class="smp-hero-tag">
                        <strong>Mobilier Addict</strong>
                        <span>Équipement hôtelier · Abidjan</span>
                    </div>
                </figure>
            </div>
        </div>
    </section>

    <section class="smp-story">
        <div class="container">
            <div class="smp-story-inner">
                <p class="smp-sec-kicker">Notre approche</p>
                <h2>{{ $page['story_title'] }}</h2>
                <p>{{ $page['story'] }}</p>
            </div>
        </div>
    </section>

    <section class="smp-hotel-perks">
        <div class="container">
            <div class="text-center mb-4">
                <p class="smp-sec-kicker">Pourquoi nous choisir</p>
                <h2 style="color: var(--smp-navy); font-size: clamp(24px, 2.6vw, 34px); font-weight: 600; letter-spacing: -.6px; margin: 0;">L'expertise hôtelière Mobilier Addict</h2>
            </div>
            <div class="smp-perks-grid">
                <div class="smp-perk">
                    <div class="smp-perk-icon">
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M3 18v-6a2 2 0 0 1 2-2h14a2 2 0 0 1 2 2v6"/><path d="M3 18h18"/><path d="M6 10V7a2 2 0 0 1 2-2h8a2 2 0 0 1 2 2v3"/></svg>
                    </div>
                    <h3>Literie hôtelière</h3>
                    <p>Matelas, oreillers et couettes conçus pour résister aux rotations et aux lavages fréquents.</p>
                </div>
                <div class="smp-perk">
                    <div class="smp-perk-icon">
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M20 9V6a2 2 0 0 0-2-2H6a2 2 0 0 0-2 2v3"/><path d="M2 16a2 2 0 0 0 2 2h16a2 2 0 0 0 2-2v-5a2 2 0 0 0-4 0v1H6v-1a2 2 0 0 0-4 0Z"/><path d="M4 18v2"/><path d="M20 18v2"/></svg>
                    </div>
                    <h3>Mobilier de chambre</h3>
                    <p>Têtes de lit, chevets et rangements assortis pour une identité visuelle cohérente.</p>
                </div>
                <div class="smp-perk">
                    <div class="smp-perk-icon">
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"/></svg>
                    </div>
                    <h3>Garantie professionnelle</h3>
                    <p>Des produits sélectionnés pour leur durabilité et leur facilité d'entretien.</p>
                </div>
                <div class="smp-perk">
                    <div class="smp-perk-icon">
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="10"/><path d="M12 6v6l4 2"/></svg>
                    </div>
                    <h3>Livraison & délais</h3>
                    <p>Livraison échelonnée selon votre planning d'ouverture ou de rénovation.</p>
                </div>
            </div>
        </div>
    </section>

    <section class="smp-modeles">
        <div class="container">
            <div class="smp-modeles-head">
                <div>
                    <p class="smp-sec-kicker">Nos modèles</p>
                    <h2>Trois ensembles pensés pour vous</h2>
                </div>
                <p class="smp-modeles-sub">Chaque ensemble se compose librement : choisissez une base, nous l’ajustons à vos dimensions, vos quantités et votre budget.</p>
            </div>
            <div class="smp-modeles-grid">
                @foreach($page['modeles'] as $i => $modele)
                    <article class="smp-modele">
                        <div class="smp-modele-img">
                            <span class="smp-modele-num">0{{ $i + 1 }}</span>
                            <img src="{{ asset($modele['img']) }}" alt="{{ $modele['name'] }}" loading="lazy" decoding="async">
                        </div>
                        <div class="smp-modele-body">
                            <h3>{{ $modele['name'] }}</h3>
                            <p>{{ $modele['desc'] }}</p>
                        </div>
                    </article>
                @endforeach
            </div>
        </div>
    </section>

    <section class="smp-equip">
        <div class="container">
            <p class="smp-sec-kicker">Tout l’intérieur, au même endroit</p>
            <h2>Équipement & accessoires</h2>
            <div class="smp-equip-grid">
                @foreach($page['equipement'] as [$label, $url, $desc])
                    <a class="smp-equip-item" href="{{ $equipRoutes[$url] ?? route('home') }}">
                        <strong>{{ $label }}</strong>
                        <span>{{ $desc }}</span>
                        <em>Voir la gamme →</em>
                    </a>
                @endforeach
            </div>
        </div>
    </section>

    <section class="smp-gros">
        <div class="container">
            <div class="smp-gros-card">
                <div>
                    <h2>Achats en gros & projets d’envergure</h2>
                    <p>{{ $page['gros'] }}</p>
                    <ul class="smp-gros-list">
                        <li>Tarifs dégressifs sur quantité</li>
                        <li>Livraison par lots</li>
                        <li>Un interlocuteur unique</li>
                        <li>Facture claire et détaillée</li>
                    </ul>
                </div>
                <div class="smp-gros-side">
                    <a class="smp-btn smp-btn-primary" href="{{ route('devis.create') }}">Demander un devis</a>
                    <a class="smp-gros-tel" href="tel:+2250799140356">+225 07 99 14 03 56</a>
                </div>
            </div>
        </div>
    </section>
</div>
@endsection
