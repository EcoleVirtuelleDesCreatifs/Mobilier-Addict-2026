@extends('maquette.layout')

@section('title', 'Entretien de la literie — Guide | Mobilier Addict')
@section('meta_description', "Entretien literie : conseils pour prolonger la durée de vie de votre matelas et de votre linge de lit.")

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
            'name' => 'Entretien de la literie',
            'description' => 'Les bons gestes (simples) qui prolongent la durée de vie de votre matelas, gardent un lit sain et améliorent le confort nuit après nuit.',
            'kicker' => "Guide d'entretien",
        ];
        $sections = [
            [
                'title' => 'Les 3 piliers d’une literie saine',
                'body' => 'On vise : moins d’humidité, moins d’acariens/poussière, plus de fraîcheur. C’est ce qui protège le matelas et le confort dans le temps.',
                'items' => [
                    ['Aérer', 'Laisser respirer le matelas réduit l’humidité.'],
                    ['Protéger', 'Protège-matelas + linge adapté = durabilité.'],
                    ['Nettoyer', 'Gestes réguliers = hygiène constante.'],
                ],
            ],
            [
                'title' => 'Routine simple (au quotidien / semaine)',
                'steps' => [
                    ['Aérer 10–15 min', 'Ouvrir la fenêtre et, si possible, laisser le lit ouvert (draps tirés) pour évacuer l’humidité.'],
                    ['Changer / laver le linge', 'Draps et taies régulièrement. Un linge propre limite les allergènes et améliore la sensation de fraîcheur.'],
                    ['Aspirer le matelas (si besoin)', 'Un passage rapide (surtout si allergies) aide à réduire poussière et particules.'],
                ],
            ],
            [
                'title' => 'Nettoyage en profondeur (mensuel / trimestriel)',
                'body' => "Objectif : enlever l’accumulation (poussière/odeurs) sans abîmer les matériaux.\n\nAstuce : un protège-matelas facilite énormément l’entretien. Il se lave plus facilement qu’un matelas.",
            ],
            [
                'title' => 'Protection : le meilleur “hack” pour la durabilité',
                'body' => "Un protège-matelas limite les taches, l’humidité et la poussière. C’est la différence entre un matelas qui vieillit vite et un matelas qui reste propre longtemps.",
            ],
            [
                'title' => 'Checklist rapide',
                'steps' => [
                    ['A', 'Aération quotidienne.'],
                    ['B', 'Linge changé/lavé régulièrement.'],
                    ['C', 'Protège-matelas utilisé (et lavé).'],
                    ['D', 'Nettoyage doux en profondeur périodique.'],
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
                    <span class="mp-cat-hero-count">5 conseils pratiques</span>
                </div>
            </div>

            <nav class="magazine-topics mp-cat-nav" aria-label="Guides liés">
                <span>Explorer</span>
                <a href="{{ route('pages.guides.mattress') }}">Guide matelas</a>
                <a href="{{ route('pages.guides.pillow') }}">Guide oreiller</a>
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
                                                <h3>{{ $step[0] }}</h3>
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
                    <h2 class="text-center mb-4" style="color: #00234d; font-weight: 600;">FAQ — Entretien literie</h2>
                    <div class="guide-faq">
                        <details open>
                            <summary>Pourquoi mon matelas garde des odeurs ?</summary>
                            <p>Souvent à cause de l’humidité. Aère la pièce, laisse le lit ouvert le matin et utilise un protège-matelas lavable.</p>
                        </details>
                        <details>
                            <summary>À quelle fréquence laver les draps ?</summary>
                            <p>Plus c’est régulier, mieux c’est. Le but : limiter la poussière et garder un confort propre.</p>
                        </details>
                        <details>
                            <summary>Le protège-matelas est-il vraiment indispensable ?</summary>
                            <p>Oui : c’est l’accessoire le plus rentable pour garder un matelas sain et prolonger sa durée de vie.</p>
                        </details>
                    </div>
                </div>
            </div>

            <div class="text-center mt-5 mb-5">
                <a class="guide-cta" href="https://wa.me/{{ whatsapp_number() }}" target="_blank" rel="noopener"><i class="fa-brands fa-whatsapp"></i> Conseils WhatsApp</a>
                <a class="guide-cta guide-cta--outline ms-3" href="{{ route('univers.show', ['slug' => 'protection']) }}"><i class="fa-solid fa-shield"></i> Protège-matelas</a>
            </div>

        </div>
    </div>
@endsection
