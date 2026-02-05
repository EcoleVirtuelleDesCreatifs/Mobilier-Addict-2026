@extends('layouts.front')

@section('title', "Guide d'achat matelas")
@section('meta_description', "Guide d'achat matelas : fermeté, dimensions et conseils pour choisir le bon matelas.")

@push('styles')
    <style>
        .mg-page { background: #0b0b12; }
        .mg-hero { position: relative; padding: 62px 0 18px; overflow: hidden; }
        .mg-hero__bg {
            position: absolute;
            inset: 0;
            background:
                radial-gradient(900px 600px at 10% 10%, rgba(255, 76, 154, .22), transparent 65%),
                radial-gradient(900px 600px at 95% 20%, rgba(122, 92, 255, .22), transparent 60%),
                radial-gradient(900px 600px at 45% 90%, rgba(18, 184, 134, .18), transparent 60%),
                linear-gradient(180deg, #070710 0%, #111128 55%, #070710 100%);
        }
        .mg-hero__grid {
            position: relative;
            display: grid;
            grid-template-columns: 1.15fr .85fr;
            gap: 18px;
            align-items: stretch;
        }
        .mg-kicker {
            display: inline-flex;
            align-items: center;
            gap: 10px;
            padding: 8px 12px;
            border-radius: 999px;
            background: rgba(255,255,255,.10);
            border: 1px solid rgba(255,255,255,.14);
            color: rgba(255,255,255,.88);
            font-weight: 800;
            font-size: 13px;
            letter-spacing: .2px;
        }
        .mg-title {
            margin: 14px 0 10px;
            color: #fff;
            font-weight: 900;
            letter-spacing: -0.8px;
            line-height: 1.06;
            font-size: clamp(30px, 4.6vw, 52px);
        }
        .mg-subtitle {
            color: rgba(255,255,255,.72);
            max-width: 68ch;
            font-size: 15px;
            line-height: 1.7;
            margin: 0;
        }
        .mg-actions { margin-top: 18px; display: flex; flex-wrap: wrap; gap: 12px; }
        .mg-btn {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 10px;
            padding: 12px 14px;
            border-radius: 14px;
            border: 1px solid rgba(255,255,255,.16);
            color: #fff;
            text-decoration: none;
            font-weight: 800;
            background: rgba(255,255,255,.10);
            backdrop-filter: blur(12px);
            transition: transform .15s ease, background .15s ease;
        }
        .mg-btn:hover { transform: translateY(-1px); background: rgba(255,255,255,.14); }
        .mg-btn--primary {
            background: linear-gradient(135deg, rgba(255, 76, 154, .94), rgba(122, 92, 255, .94));
            border-color: rgba(255,255,255,.18);
        }
        .mg-btn--primary:hover {
            background: linear-gradient(135deg, rgba(255, 76, 154, .99), rgba(122, 92, 255, .99));
        }

        .mg-panel {
            border-radius: 22px;
            background: rgba(255,255,255,.08);
            border: 1px solid rgba(255,255,255,.14);
            box-shadow: 0 18px 48px rgba(0,0,0,.35);
            backdrop-filter: blur(14px);
        }
        .mg-panel__inner { padding: 18px; }
        .mg-toc { display: grid; gap: 10px; }
        .mg-toc__title { margin: 0 0 8px; color: #fff; font-weight: 900; font-size: 16px; letter-spacing: -.2px; }
        .mg-toc__link {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 10px;
            padding: 10px 12px;
            border-radius: 14px;
            background: rgba(255,255,255,.08);
            border: 1px solid rgba(255,255,255,.10);
            color: rgba(255,255,255,.90);
            text-decoration: none;
            font-weight: 900;
            font-size: 13px;
        }
        .mg-toc__link:hover { background: rgba(255,255,255,.12); }
        .mg-toc__link span { opacity: .85; font-weight: 800; }

        .mg-body { padding: 18px 0 70px; }
        .mg-section {
            margin-top: 18px;
            border-radius: 22px;
            background: rgba(255,255,255,.06);
            border: 1px solid rgba(255,255,255,.10);
            box-shadow: 0 18px 48px rgba(0,0,0,.28);
            overflow: hidden;
        }
        .mg-section__head { padding: 20px 20px 0; }
        .mg-section__title { margin: 0; color: #fff; font-weight: 900; letter-spacing: -.4px; font-size: 20px; }
        .mg-section__subtitle { margin: 8px 0 0; color: rgba(255,255,255,.70); font-size: 14px; line-height: 1.7; }
        .mg-section__body { padding: 20px; }
        .mg-section__body p { color: rgba(255,255,255,.72); font-size: 14px; line-height: 1.75; margin: 0; }
        .mg-section__body p + p { margin-top: 10px; }
        .mg-section__body a { color: #fff; }

        .mg-grid { display: grid; grid-template-columns: repeat(3, 1fr); gap: 14px; }
        .mg-card { border-radius: 18px; background: rgba(255,255,255,.06); border: 1px solid rgba(255,255,255,.10); padding: 14px; }
        .mg-card__icon { width: 44px; height: 44px; border-radius: 16px; display: grid; place-items: center; background: rgba(255,255,255,.10); border: 1px solid rgba(255,255,255,.14); color: #fff; margin-bottom: 10px; }
        .mg-card__name { margin: 0; color: #fff; font-weight: 900; font-size: 15px; }
        .mg-card__text { margin: 8px 0 0; color: rgba(255,255,255,.70); font-size: 13.5px; line-height: 1.65; }

        .mg-check { display: grid; gap: 10px; }
        .mg-check__item { display: flex; gap: 10px; align-items: flex-start; padding: 12px; border-radius: 16px; background: rgba(255,255,255,.06); border: 1px solid rgba(255,255,255,.10); }
        .mg-check__icon { width: 28px; height: 28px; border-radius: 10px; display: grid; place-items: center; background: rgba(18, 184, 134, .20); border: 1px solid rgba(18, 184, 134, .35); color: #fff; flex: 0 0 auto; margin-top: 2px; }
        .mg-check__text { color: rgba(255,255,255,.72); font-size: 13.5px; line-height: 1.65; }

        .mg-faq { display: grid; gap: 10px; }
        .mg-faq details { border-radius: 16px; background: rgba(255,255,255,.06); border: 1px solid rgba(255,255,255,.10); padding: 12px; }
        .mg-faq summary { cursor: pointer; color: #fff; font-weight: 900; list-style: none; }
        .mg-faq summary::-webkit-details-marker { display: none; }
        .mg-faq p { margin: 10px 0 0; color: rgba(255,255,255,.72); font-size: 14px; line-height: 1.7; }

        @media (max-width: 991.98px) {
            .mg-hero__grid { grid-template-columns: 1fr; }
            .mg-grid { grid-template-columns: 1fr; }
        }
    </style>
@endpush

@section('content')
<div class="mg-page">
    <section class="mg-hero" aria-label="Guide d'achat matelas">
        <div class="mg-hero__bg"></div>
        <div class="container">
            <div class="mg-hero__grid">
                <div>
                    <div class="mg-kicker">
                        <i class="fa-solid fa-bed"></i>
                        Guide premium • Simple • Concret
                    </div>
                    <h1 class="mg-title">Guide d’achat matelas</h1>
                    <p class="mg-subtitle">
                        Choisir un matelas, c’est choisir votre niveau d’énergie au quotidien.
                        Voici une méthode simple (mais complète) pour trouver le bon soutien, la bonne fermeté et les bonnes dimensions.
                    </p>

                    <div class="mg-actions">
                        <a class="mg-btn mg-btn--primary" href="https://wa.me/2250799140356" target="_blank" rel="noopener">
                            <i class="fa-brands fa-whatsapp"></i>
                            Demander conseil
                            <i class="fa-solid fa-arrow-right"></i>
                        </a>
                        <a class="mg-btn" href="{{ route('univers.show', ['slug' => 'matelas']) }}">
                            <i class="fa-solid fa-store"></i>
                            Voir les matelas
                        </a>
                        <a class="mg-btn" href="{{ route('pages.contact') }}">
                            <i class="fa-solid fa-headset"></i>
                            Contact
                        </a>
                    </div>
                </div>

                <aside class="mg-panel" aria-label="Sommaire">
                    <div class="mg-panel__inner">
                        <p class="mg-toc__title">Sommaire</p>
                        <div class="mg-toc">
                            <a class="mg-toc__link" href="#fermete">Fermeté <span>01</span></a>
                            <a class="mg-toc__link" href="#morphologie">Morphologie <span>02</span></a>
                            <a class="mg-toc__link" href="#dimensions">Dimensions <span>03</span></a>
                            <a class="mg-toc__link" href="#matieres">Matières <span>04</span></a>
                            <a class="mg-toc__link" href="#chaleur">Chaleur <span>05</span></a>
                            <a class="mg-toc__link" href="#hygiene">Hygiène <span>06</span></a>
                        </div>
                    </div>
                </aside>
            </div>
        </div>
    </section>

    <section class="mg-body" aria-label="Contenu du guide">
        <div class="container">
            <div class="mg-section" id="fermete">
                <div class="mg-section__head">
                    <h2 class="mg-section__title">1) La fermeté : le bon soutien, sans douleur</h2>
                    <p class="mg-section__subtitle">Le but n’est pas “dur” ou “mou”, mais un alignement correct du corps.</p>
                </div>
                <div class="mg-section__body">
                    <div class="mg-grid">
                        <div class="mg-card">
                            <div class="mg-card__icon"><i class="fa-solid fa-scale-balanced"></i></div>
                            <h3 class="mg-card__name">Mi-ferme (souvent idéal)</h3>
                            <p class="mg-card__text">Équilibre : soutien + confort. Recommandé si tu hésites.</p>
                        </div>
                        <div class="mg-card">
                            <div class="mg-card__icon"><i class="fa-solid fa-dumbbell"></i></div>
                            <h3 class="mg-card__name">Ferme</h3>
                            <p class="mg-card__text">Plus de maintien. Souvent apprécié si tu veux un soutien prononcé.</p>
                        </div>
                        <div class="mg-card">
                            <div class="mg-card__icon"><i class="fa-solid fa-cloud"></i></div>
                            <h3 class="mg-card__name">Moelleux</h3>
                            <p class="mg-card__text">Accueil plus doux. À équilibrer avec un soutien suffisant.</p>
                        </div>
                    </div>
                    <p style="margin-top: 12px;">Astuce : si tu te réveilles avec des douleurs, c’est souvent un problème d’alignement. Le bon matelas maintient les hanches et les épaules sans “casser” le dos.</p>
                </div>
            </div>

            <div class="mg-section" id="morphologie">
                <div class="mg-section__head">
                    <h2 class="mg-section__title">2) Morphologie &amp; position de sommeil</h2>
                    <p class="mg-section__subtitle">Un même matelas peut être parfait pour quelqu’un et moyen pour une autre personne.</p>
                </div>
                <div class="mg-section__body">
                    <p>Sur le côté : il faut un bon accueil pour les épaules et les hanches, sinon tu ressens des points de pression.</p>
                    <p>Sur le dos : vise un soutien uniforme (lombaires bien maintenues) et une fermeté plutôt équilibrée.</p>
                    <p>Sur le ventre : évite trop moelleux (risque de cambrer) — privilégie un soutien plus stable.</p>
                </div>
            </div>

            <div class="mg-section" id="dimensions">
                <div class="mg-section__head">
                    <h2 class="mg-section__title">3) Dimensions : confort + espace</h2>
                    <p class="mg-section__subtitle">Un bon matelas doit aussi “respirer” dans ta chambre et dans tes mouvements.</p>
                </div>
                <div class="mg-section__body">
                    <p>Solo : 90x190 ou 90x200. Duo : 140x190, 160x200 (confort ++), 180x200 (premium).</p>
                    <p>Si vous bougez beaucoup la nuit, une largeur plus grande change la qualité du sommeil.</p>
                </div>
            </div>

            <div class="mg-section" id="matieres">
                <div class="mg-section__head">
                    <h2 class="mg-section__title">4) Matières : confort, durabilité, sensation</h2>
                    <p class="mg-section__subtitle">Chaque matière a un “ressenti” différent (accueil, rebond, chaleur).</p>
                </div>
                <div class="mg-section__body">
                    <p>Mousse : confort progressif, bon rapport confort/prix. Mémoire de forme : accueil enveloppant, très appréciée contre les points de pression.</p>
                    <p>Ressorts : bonne ventilation et sensation plus dynamique. Hybride : équilibre entre soutien et accueil.</p>
                </div>
            </div>

            <div class="mg-section" id="chaleur">
                <div class="mg-section__head">
                    <h2 class="mg-section__title">5) Chaleur &amp; ventilation</h2>
                    <p class="mg-section__subtitle">Un matelas trop chaud = micro-réveils = fatigue.</p>
                </div>
                <div class="mg-section__body">
                    <p>Si tu as chaud la nuit, privilégie une bonne ventilation (structure respirante, mousse ventilée, ou ressorts selon les gammes).</p>
                    <p>Ajoute des draps respirants et pense à l’entretien régulier.</p>
                </div>
            </div>

            <div class="mg-section" id="hygiene">
                <div class="mg-section__head">
                    <h2 class="mg-section__title">6) Hygiène : protège-matelas et entretien</h2>
                    <p class="mg-section__subtitle">C’est le petit détail qui prolonge vraiment la durée de vie.</p>
                </div>
                <div class="mg-section__body">
                    <p>Nous conseillons d’ajouter une protection adaptée : <a href="{{ route('univers.show', ['slug' => 'protection']) }}">Protège-Matelas</a>. Cela aide contre l’humidité, la poussière et les taches.</p>
                    <p>Pense aussi à choisir de bons accessoires : <a href="{{ route('univers.show', ['slug' => 'oreillers']) }}">oreillers</a> et <a href="{{ route('univers.show', ['slug' => 'draps-couettes']) }}">draps &amp; couettes</a>.</p>
                </div>
            </div>

            <div class="mg-section" aria-label="Checklist">
                <div class="mg-section__head">
                    <h2 class="mg-section__title">Checklist rapide (avant d’acheter)</h2>
                    <p class="mg-section__subtitle">Si tu coches tout, tu fais un choix sûr.</p>
                </div>
                <div class="mg-section__body">
                    <div class="mg-check">
                        <div class="mg-check__item"><div class="mg-check__icon"><i class="fa-solid fa-check"></i></div><div class="mg-check__text">Ta position de sommeil (dos/côté/ventre) est prise en compte.</div></div>
                        <div class="mg-check__item"><div class="mg-check__icon"><i class="fa-solid fa-check"></i></div><div class="mg-check__text">Tu as choisi une fermeté cohérente avec ton ressenti (soutien vs accueil).</div></div>
                        <div class="mg-check__item"><div class="mg-check__icon"><i class="fa-solid fa-check"></i></div><div class="mg-check__text">Les dimensions sont adaptées à ta chambre et à tes mouvements.</div></div>
                        <div class="mg-check__item"><div class="mg-check__icon"><i class="fa-solid fa-check"></i></div><div class="mg-check__text">Tu as prévu une protection (protège-matelas) pour l’hygiène et la durée de vie.</div></div>
                    </div>

                    <div class="mg-actions" style="margin-top: 16px;">
                        <a class="mg-btn mg-btn--primary" href="https://wa.me/2250799140356" target="_blank" rel="noopener">
                            <i class="fa-brands fa-whatsapp"></i>
                            Je veux un conseil personnalisé
                            <i class="fa-solid fa-arrow-right"></i>
                        </a>
                        <a class="mg-btn" href="{{ route('univers.show', ['slug' => 'matelas']) }}">
                            <i class="fa-solid fa-store"></i>
                            Voir la collection
                        </a>
                    </div>
                </div>
            </div>

            <div class="mg-section" aria-label="FAQ guide">
                <div class="mg-section__head">
                    <h2 class="mg-section__title">FAQ (Guide matelas)</h2>
                    <p class="mg-section__subtitle">Les questions les plus fréquentes avant l’achat.</p>
                </div>
                <div class="mg-section__body">
                    <div class="mg-faq">
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
        </div>
    </section>
</div>
@endsection
