@extends('maquette.layout')

@section('title', "Guide d'achat matelas — Guide | Mobilier Addict")
@section('meta_description', "Guide d'achat matelas : fermeté, dimensions et conseils pour choisir le bon matelas.")

@push('styles')
    <style>
        .guide-card { background: #fff; border: 1px solid #eceef1; border-radius: 18px; padding: 26px 28px; height: 100%; transition: transform .25s ease, box-shadow .25s ease, border-color .25s ease; }
        .guide-card:hover { transform: translateY(-5px); border-color: #d8327f; box-shadow: 0 18px 40px rgba(0,35,77,.12); }
        .guide-card h2 { color: #00234d; font-size: 20px; font-weight: 600; margin: 0 0 14px; }
        .guide-card h3 { color: #00234d; font-size: 16px; font-weight: 600; margin: 0 0 8px; }
        .guide-card p { color: #4a5563; font-size: 14px; line-height: 1.75; margin: 0 0 12px; }
        .guide-card p:last-child { margin-bottom: 0; }
        .guide-dot { width: 36px; height: 36px; border-radius: 12px; display: inline-grid; place-items: center; background: linear-gradient(135deg, #d8327f, #8b5cf6); color: #fff; font-weight: 700; font-size: 14px; margin-right: 10px; }
        .guide-step { display: flex; gap: 14px; align-items: flex-start; padding: 14px 0; border-bottom: 1px solid #f1f3f6; }
        .guide-step:last-child { border-bottom: none; padding-bottom: 0; }
        .guide-step p { margin: 0; }
        .guide-faq details { border-radius: 16px; background: #fff; border: 1px solid #eceef1; padding: 18px 22px; margin-bottom: 12px; }
        .guide-faq summary { cursor: pointer; color: #00234d; font-weight: 600; list-style: none; }
        .guide-faq summary::-webkit-details-marker { display: none; }
        .guide-faq p { color: #4a5563; font-size: 14px; line-height: 1.75; margin: 10px 0 0; }
        .guide-cta { display: inline-flex; align-items: center; gap: 10px; padding: 14px 24px; border-radius: 999px; font-size: 14px; font-weight: 600; text-decoration: none; background: #00234d; color: #fff; }
        .guide-cta:hover { background: #d8327f; color: #fff; }
        .guide-cta--outline { background: transparent; color: #00234d; border: 1px solid #00234d; }
        .guide-cta--outline:hover { background: #00234d; color: #fff; }
    </style>
@endpush

@section('content')
    @php
        $guide = (object) [
            'name' => "Guide d'achat matelas",
            'description' => 'Choisir un matelas, c’est choisir votre niveau d’énergie au quotidien. Voici une méthode simple (mais complète) pour trouver le bon soutien, la bonne fermeté et les bonnes dimensions.',
            'kicker' => "Guide d'achat",
        ];
        $sections = [
            [
                'title' => 'La fermeté : le bon soutien, sans douleur',
                'body' => 'Le but n’est pas “dur” ou “mou”, mais un alignement correct du corps. Si tu te réveilles avec des douleurs, c’est souvent un problème d’alignement. Le bon matelas maintient les hanches et les épaules sans “casser” le dos.',
                'items' => [
                    ['Mi-ferme', 'Équilibre : soutien + confort. Recommandé si tu hésites.'],
                    ['Ferme', 'Plus de maintien. Souvent apprécié si tu veux un soutien prononcé.'],
                    ['Moelleux', 'Accueil plus doux. À équilibrer avec un soutien suffisant.'],
                ],
            ],
            [
                'title' => 'Morphologie & position de sommeil',
                'body' => "Un même matelas peut être parfait pour quelqu’un et moyen pour une autre personne.\n\nSur le côté : il faut un bon accueil pour les épaules et les hanches, sinon tu ressens des points de pression.\n\nSur le dos : vise un soutien uniforme (lombaires bien maintenues) et une fermeté plutôt équilibrée.\n\nSur le ventre : évite trop moelleux (risque de cambrer) — privilégie un soutien plus stable.",
            ],
            [
                'title' => 'Dimensions : confort + espace',
                'body' => "Un bon matelas doit aussi “respirer” dans ta chambre et dans tes mouvements.\n\nSolo : 90x190 ou 90x200. Duo : 140x190, 160x200 (confort ++), 180x200 (premium).\n\nSi vous bougez beaucoup la nuit, une largeur plus grande change la qualité du sommeil.",
            ],
            [
                'title' => 'Matières : confort, durabilité, sensation',
                'body' => 'Chaque matière a un “ressenti” différent (accueil, rebond, chaleur).\n\nMousse : confort progressif, bon rapport confort/prix. Mémoire de forme : accueil enveloppant, très appréciée contre les points de pression.\n\nRessorts : bonne ventilation et sensation plus dynamique. Hybride : équilibre entre soutien et accueil.',
            ],
            [
                'title' => 'Chaleur & ventilation',
                'body' => "Un matelas trop chaud = micro-réveils = fatigue.\n\nSi tu as chaud la nuit, privilégie une bonne ventilation (structure respirante, mousse ventilée, ou ressorts selon les gammes).\n\nAjoute des draps respirants et pense à l’entretien régulier.",
            ],
            [
                'title' => 'Hygiène : protège-matelas et entretien',
                'body' => "C’est le petit détail qui prolonge vraiment la durée de vie.\n\nNous conseillons d’ajouter une protection adaptée. Cela aide contre l’humidité, la poussière et les taches.\n\nPense aussi à choisir de bons accessoires : oreillers et draps & couettes.",
            ],
            [
                'title' => 'Checklist rapide (avant d’acheter)',
                'steps' => [
                    ['1', 'Ta position de sommeil (dos/côté/ventre) est prise en compte.'],
                    ['2', 'Tu as choisi une fermeté cohérente avec ton ressenti (soutien vs accueil).'],
                    ['3', 'Les dimensions sont adaptées à ta chambre et à tes mouvements.'],
                    ['4', 'Tu as prévu une protection pour l’hygiène et la durée de vie.'],
                ],
            ],
        ];
    @endphp

    <div class="collection col-v2 mt-100">
        <div class="container">

            <div class="mp-cat-hero" data-aos="fade-up" data-aos-duration="700">
                <div class="mp-cat-hero-content">
                    <p class="mp-cat-hero-kicker">
                        <a href="{{ route('home') }}">Accueil</a>
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="m9 18 6-6-6-6"/></svg>
                        <a href="{{ route('blog.index') }}">Guides</a>
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="m9 18 6-6-6-6"/></svg>
                        <span>{{ $guide->kicker }}</span>
                    </p>
                    <h1 class="mp-cat-hero-title">{{ $guide->name }}</h1>
                    <p class="mp-cat-hero-sub">{{ $guide->description }}</p>
                    <span class="mp-cat-hero-count">6 conseils pratiques</span>
                </div>
            </div>

            <nav class="magazine-topics mp-cat-nav" aria-label="Guides liés">
                <span>Explorer</span>
                <a href="{{ route('pages.guides.pillow') }}">Guide oreiller</a>
                <a href="{{ route('pages.guides.care') }}">Entretien literie</a>
                <a href="{{ route('blog.index') }}">Magazine</a>
            </nav>

            <div class="row g-4 mt-4">
                @foreach($sections as $index => $section)
                    <div class="col-lg-6" data-aos="fade-up" data-aos-duration="700" data-aos-delay="{{ $index * 100 }}">
                        <article class="guide-card" id="section-{{ $index + 1 }}">
                            <h2>{{ $section['title'] }}</h2>

                            @if(!empty($section['body']))
                                @foreach(explode("\n\n", $section['body']) as $paragraph)
                                    <p>{{ $paragraph }}</p>
                                @endforeach
                            @endif

                            @if(!empty($section['items']))
                                <div class="row g-3 mt-2">
                                    @foreach($section['items'] as $item)
                                        <div class="col-12">
                                            <h3>{{ $item[0] }}</h3>
                                            <p>{{ $item[1] }}</p>
                                        </div>
                                    @endforeach
                                </div>
                            @endif

                            @if(!empty($section['steps']))
                                <div class="mt-2">
                                    @foreach($section['steps'] as $step)
                                        <div class="guide-step">
                                            <span class="guide-dot">{{ $loop->iteration }}</span>
                                            <div>
                                                <p>{{ $step[1] }}</p>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            @endif
                        </article>
                    </div>
                @endforeach
            </div>

            <div class="row mt-5">
                <div class="col-lg-8 mx-auto">
                    <h2 class="text-center mb-4" style="color: #00234d; font-weight: 600;">FAQ — Guide matelas</h2>
                    <div class="guide-faq">
                        <details open>
                            <summary>Je ne sais pas quelle fermeté choisir</summary>
                            <p>Si tu hésites, prends “mi-ferme” puis affine selon ton confort. Envoie-nous ton poids/taille et ta position de sommeil sur WhatsApp.</p>
                        </details>
                        <details>
                            <summary>J’ai mal au dos au réveil : c’est forcément le matelas ?</summary>
                            <p>Souvent oui, mais pas uniquement. L’oreiller compte beaucoup. Vérifie aussi l’état du sommier et la position de sommeil.</p>
                        </details>
                        <details>
                            <summary>Quel accessoire est le plus important ?</summary>
                            <p>Le protège-matelas pour l’hygiène + un bon oreiller pour l’alignement cervical. Les deux font une vraie différence.</p>
                        </details>
                    </div>
                </div>
            </div>

            <div class="text-center mt-5 mb-5">
                <a class="guide-cta" href="https://wa.me/{{ whatsapp_number() }}" target="_blank" rel="noopener"><i class="fa-brands fa-whatsapp"></i> Conseils WhatsApp</a>
                <a class="guide-cta guide-cta--outline ms-3" href="{{ route('univers.show', ['slug' => 'matelas']) }}"><i class="fa-solid fa-store"></i> Voir les matelas</a>
            </div>

        </div>
    </div>
@endsection
