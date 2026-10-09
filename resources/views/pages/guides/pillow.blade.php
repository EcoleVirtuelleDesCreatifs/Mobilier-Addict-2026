@extends('maquette.layout')

@section('title', 'Choisir son oreiller — Guide | Mobilier Addict')
@section('meta_description', "Choisir son oreiller : hauteur, maintien et confort selon votre position de sommeil.")

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
            'name' => 'Choisir son oreiller',
            'description' => 'Un oreiller bien choisi aligne la nuque et détend les épaules. Résultat : moins de tensions et un sommeil plus profond.',
            'kicker' => 'Guide d\'achat',
        ];
        $sections = [
            [
                'title' => 'Les 3 critères qui font tout',
                'body' => 'La position de sommeil détermine la hauteur. La morphologie influence le soutien. La matière règle la sensation (moelleux/ferme) et la chaleur.',
                'items' => [
                    ['Hauteur', 'Plus tu dors sur le côté, plus l’oreiller doit être haut.'],
                    ['Maintien', 'Un bon soutien évite les tensions cervicales.'],
                    ['Matière', 'Mousse, fibres, latex… le ressenti et la ventilation changent.'],
                ],
            ],
            [
                'title' => 'Choisir selon la position de sommeil',
                'steps' => [
                    ['Sur le dos', 'Vise un oreiller de hauteur moyenne. L’objectif : combler l’espace entre nuque et matelas, sans pousser la tête vers l’avant.'],
                    ['Sur le côté', 'Prends plus haut et plus ferme : il faut compenser la largeur d’épaule pour garder la colonne alignée.'],
                    ['Sur le ventre', 'Privilégie un oreiller fin et souple (ou parfois pas d’oreiller). Trop haut = nuque en torsion.'],
                ],
            ],
            [
                'title' => 'Hauteur & fermeté',
                'body' => 'Si tes épaules sont larges ou si ton matelas est très ferme, tu auras souvent besoin d’un peu plus de hauteur. Si ton matelas est moelleux, la tête “s’enfonce” déjà : l’oreiller peut être un peu moins haut.\n\nConseil simple : tu dois sentir que ton cou est “posé”, pas plié. Si tu te réveilles avec des tensions, ajuste d’abord la hauteur.',
            ],
            [
                'title' => 'Matières : confort, chaleur, allergies',
                'items' => [
                    ['Mousse', 'Soutien stable, sensation enveloppante. Bon choix pour les cervicales.'],
                    ['Fibres', 'Confort moelleux, souvent plus léger. Idéal si tu aimes le “gonflant”.'],
                    ['Technologies hybrides', 'Équilibre entre maintien et respirabilité selon les gammes.'],
                ],
                'body' => 'Si tu as chaud la nuit, privilégie les matières plus respirantes et une taie adaptée. En cas d’allergies, favorise les solutions faciles à entretenir et aérer.',
            ],
            [
                'title' => 'Checklist avant d’acheter',
                'steps' => [
                    ['1', 'Ta position principale de sommeil est identifiée (dos/côté/ventre).'],
                    ['2', 'Tu as choisi une hauteur cohérente avec tes épaules et ton matelas.'],
                    ['3', 'La fermeté apporte un maintien sans points de pression.'],
                    ['4', 'La matière correspond à ton ressenti (moelleux/ferme) et à ta chaleur nocturne.'],
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
                    <h2 class="text-center mb-4" style="color: #00234d; font-weight: 600;">FAQ — Oreiller</h2>
                    <div class="guide-faq">
                        <details open>
                            <summary>J’ai mal à la nuque au réveil, que faire ?</summary>
                            <p>La cause est souvent une hauteur inadaptée. Ajuste d’abord la hauteur, puis la fermeté. Si besoin, contacte-nous pour un conseil personnalisé.</p>
                        </details>
                        <details>
                            <summary>Dois-je changer d’oreiller quand je change de matelas ?</summary>
                            <p>Souvent oui : un matelas plus ferme ou plus moelleux change l’alignement du cou. Un petit ajustement d’oreiller peut tout améliorer.</p>
                        </details>
                        <details>
                            <summary>Quelle est la meilleure matière ?</summary>
                            <p>Il n’y a pas de “meilleure” pour tout le monde. L’idéal est celle qui combine maintien, confort et chaleur adaptée à toi.</p>
                        </details>
                    </div>
                </div>
            </div>

            <div class="text-center mt-5 mb-5">
                <a class="guide-cta" href="https://wa.me/{{ whatsapp_number() }}" target="_blank" rel="noopener"><i class="fa-brands fa-whatsapp"></i> Conseils WhatsApp</a>
                <a class="guide-cta guide-cta--outline ms-3" href="{{ route('univers.show', ['slug' => 'oreillers']) }}"><i class="fa-solid fa-store"></i> Voir les oreillers</a>
            </div>

        </div>
    </div>
@endsection
