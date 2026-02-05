@extends('layouts.front')

@section('title', 'À propos')
@section('meta_description', "Découvrez Mobilier Addict : notre mission, nos engagements et notre sélection dédiée au confort et au bien-être.")

@push('styles')
    <style>
        .about-page { background: #0b0b12; }
        .about-hero { position: relative; padding: 64px 0 22px; overflow: hidden; }
        .about-hero__bg {
            position: absolute; inset: 0;
            background:
                radial-gradient(900px 600px at 10% 10%, rgba(255, 76, 154, .24), transparent 65%),
                radial-gradient(900px 600px at 95% 20%, rgba(122, 92, 255, .22), transparent 60%),
                radial-gradient(900px 600px at 45% 90%, rgba(18, 184, 134, .18), transparent 60%),
                linear-gradient(180deg, #070710 0%, #111128 55%, #070710 100%);
        }
        .about-hero__grid { position: relative; display: grid; grid-template-columns: 1.15fr .85fr; gap: 18px; align-items: stretch; }
        .about-kicker { display: inline-flex; align-items: center; gap: 10px; padding: 8px 12px; border-radius: 999px; background: rgba(255,255,255,.10); border: 1px solid rgba(255,255,255,.14); color: rgba(255,255,255,.88); font-weight: 800; font-size: 13px; letter-spacing: .2px; }
        .about-title { margin: 14px 0 10px; color: #fff; font-weight: 900; letter-spacing: -0.8px; line-height: 1.06; font-size: clamp(30px, 4.6vw, 52px); }
        .about-subtitle { color: rgba(255,255,255,.72); max-width: 62ch; font-size: 15px; line-height: 1.7; margin: 0; }
        .about-actions { margin-top: 18px; display: flex; flex-wrap: wrap; gap: 12px; }
        .about-btn { display: inline-flex; align-items: center; justify-content: center; gap: 10px; padding: 12px 14px; border-radius: 14px; border: 1px solid rgba(255,255,255,.16); color: #fff; text-decoration: none; font-weight: 800; background: rgba(255,255,255,.10); backdrop-filter: blur(12px); transition: transform .15s ease, background .15s ease; }
        .about-btn:hover { transform: translateY(-1px); background: rgba(255,255,255,.14); }
        .about-btn--primary { background: linear-gradient(135deg, rgba(255, 76, 154, .94), rgba(122, 92, 255, .94)); border-color: rgba(255,255,255,.18); }
        .about-btn--primary:hover { background: linear-gradient(135deg, rgba(255, 76, 154, .99), rgba(122, 92, 255, .99)); }

        .about-panel { border-radius: 22px; background: rgba(255,255,255,.08); border: 1px solid rgba(255,255,255,.14); box-shadow: 0 18px 48px rgba(0,0,0,.35); backdrop-filter: blur(14px); }
        .about-panel__inner { padding: 18px; }
        .about-highlight { display: grid; gap: 12px; }
        .about-highlight__item { display: flex; gap: 12px; padding: 12px; border-radius: 16px; background: rgba(255,255,255,.08); border: 1px solid rgba(255,255,255,.10); }
        .about-highlight__icon { width: 42px; height: 42px; border-radius: 14px; display: grid; place-items: center; background: rgba(255,255,255,.10); border: 1px solid rgba(255,255,255,.14); color: #fff; flex: 0 0 auto; }
        .about-highlight__label { margin: 0; color: rgba(255,255,255,.62); font-size: 12px; font-weight: 800; text-transform: uppercase; letter-spacing: .25px; }
        .about-highlight__value { margin: 2px 0 0; color: #fff; font-weight: 900; font-size: 14px; line-height: 1.3; }

        .about-body { padding: 18px 0 70px; }
        .about-section { margin-top: 18px; border-radius: 22px; background: rgba(255,255,255,.06); border: 1px solid rgba(255,255,255,.10); box-shadow: 0 18px 48px rgba(0,0,0,.28); overflow: hidden; }
        .about-section__head { padding: 20px 20px 0; }
        .about-section__title { margin: 0; color: #fff; font-weight: 900; letter-spacing: -.4px; font-size: 20px; }
        .about-section__subtitle { margin: 8px 0 0; color: rgba(255,255,255,.70); font-size: 14px; line-height: 1.7; }
        .about-section__body { padding: 20px; }

        .about-cards { display: grid; grid-template-columns: repeat(3, 1fr); gap: 14px; }
        .about-card { border-radius: 18px; background: rgba(255,255,255,.06); border: 1px solid rgba(255,255,255,.10); padding: 14px; }
        .about-card__icon { width: 44px; height: 44px; border-radius: 16px; display: grid; place-items: center; background: rgba(255,255,255,.10); border: 1px solid rgba(255,255,255,.14); color: #fff; margin-bottom: 10px; }
        .about-card__name { margin: 0; color: #fff; font-weight: 900; font-size: 15px; }
        .about-card__text { margin: 8px 0 0; color: rgba(255,255,255,.70); font-size: 13.5px; line-height: 1.65; }

        .about-stats { display: grid; grid-template-columns: repeat(4, 1fr); gap: 12px; }
        .about-stat { border-radius: 18px; background: rgba(255,255,255,.06); border: 1px solid rgba(255,255,255,.10); padding: 14px; }
        .about-stat__num { color: #fff; font-weight: 950; font-size: 22px; letter-spacing: -.4px; }
        .about-stat__label { color: rgba(255,255,255,.66); font-size: 13px; margin-top: 6px; line-height: 1.4; }

        .about-timeline { display: grid; gap: 12px; }
        .about-step { display: flex; gap: 12px; padding: 14px; border-radius: 18px; background: rgba(255,255,255,.06); border: 1px solid rgba(255,255,255,.10); }
        .about-step__dot { width: 44px; height: 44px; border-radius: 16px; display: grid; place-items: center; background: linear-gradient(135deg, rgba(255,76,154,.86), rgba(122,92,255,.86)); color: #fff; font-weight: 950; flex: 0 0 auto; }
        .about-step__title { margin: 0; color: #fff; font-weight: 900; font-size: 15px; }
        .about-step__text { margin: 8px 0 0; color: rgba(255,255,255,.70); font-size: 13.5px; line-height: 1.65; }

        @media (max-width: 991.98px) {
            .about-hero__grid { grid-template-columns: 1fr; }
            .about-cards { grid-template-columns: 1fr; }
            .about-stats { grid-template-columns: repeat(2, 1fr); }
        }
    </style>
@endpush

@section('content')
<div class="about-page">
    <section class="about-hero" aria-label="À propos">
        <div class="about-hero__bg"></div>
        <div class="container">
            <div class="about-hero__grid">
                <div>
                    <div class="about-kicker">
                        <i class="fa-solid fa-moon"></i>
                        Depuis 2015 • Confort • Excellence
                    </div>
                    <h1 class="about-title">À propos de Mobilier Addict</h1>
                    <p class="about-subtitle">
                        Chez Mobilier Addict, nous croyons que le sommeil change tout.
                        Notre mission : vous aider à mieux dormir et à mieux vivre grâce à une sélection exigeante,
                        des conseils utiles et un accompagnement sincère — avant, pendant et après l’achat.
                    </p>

                    <div class="about-actions">
                        <a class="about-btn about-btn--primary" href="https://wa.me/2250799140356" target="_blank" rel="noopener">
                            <i class="fa-brands fa-whatsapp"></i>
                            Discuter sur WhatsApp
                            <i class="fa-solid fa-arrow-right"></i>
                        </a>
                        <a class="about-btn" href="{{ route('pages.contact') }}">
                            <i class="fa-solid fa-headset"></i>
                            Contacter le support
                        </a>
                    </div>
                </div>

                <aside class="about-panel" aria-label="Nos points forts">
                    <div class="about-panel__inner">
                        <div class="about-highlight">
                            <div class="about-highlight__item">
                                <div class="about-highlight__icon"><i class="fa-solid fa-bed"></i></div>
                                <div>
                                    <p class="about-highlight__label">Sélection</p>
                                    <p class="about-highlight__value">Matelas & literie pensés pour le confort au quotidien</p>
                                </div>
                            </div>
                            <div class="about-highlight__item">
                                <div class="about-highlight__icon"><i class="fa-solid fa-shield-heart"></i></div>
                                <div>
                                    <p class="about-highlight__label">Confiance</p>
                                    <p class="about-highlight__value">Conseils clairs, transparence et accompagnement</p>
                                </div>
                            </div>
                            <div class="about-highlight__item">
                                <div class="about-highlight__icon"><i class="fa-solid fa-truck-fast"></i></div>
                                <div>
                                    <p class="about-highlight__label">Service</p>
                                    <p class="about-highlight__value">Support réactif, suivi et solutions rapides</p>
                                </div>
                            </div>
                            <div class="about-highlight__item">
                                <div class="about-highlight__icon"><i class="fa-solid fa-leaf"></i></div>
                                <div>
                                    <p class="about-highlight__label">Qualité</p>
                                    <p class="about-highlight__value">Durabilité, finitions soignées, confort vérifié</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </aside>
            </div>
        </div>
    </section>

    <section class="about-body" aria-label="Notre histoire">
        <div class="container">
            <div class="about-section">
                <div class="about-section__head">
                    <h2 class="about-section__title">Notre mission</h2>
                    <p class="about-section__subtitle">
                        Proposer une expérience simple, rassurante et premium : choisir le bon produit, au bon prix,
                        avec les bonnes informations, et un service client qui répond vraiment.
                    </p>
                </div>
                <div class="about-section__body">
                    <div class="about-cards">
                        <div class="about-card">
                            <div class="about-card__icon"><i class="fa-solid fa-bullseye"></i></div>
                            <h3 class="about-card__name">Clarté</h3>
                            <p class="about-card__text">Des fiches produits compréhensibles, des conseils concrets, et un parcours d’achat fluide.</p>
                        </div>
                        <div class="about-card">
                            <div class="about-card__icon"><i class="fa-solid fa-gem"></i></div>
                            <h3 class="about-card__name">Exigence</h3>
                            <p class="about-card__text">Nous privilégions la qualité et la durabilité, pour un confort qui se ressent chaque nuit.</p>
                        </div>
                        <div class="about-card">
                            <div class="about-card__icon"><i class="fa-solid fa-handshake"></i></div>
                            <h3 class="about-card__name">Accompagnement</h3>
                            <p class="about-card__text">Avant et après l’achat : conseils, suivi, réponses rapides et solutions.</p>
                        </div>
                    </div>
                </div>
            </div>

            <div class="about-section" aria-label="Chiffres clés">
                <div class="about-section__head">
                    <h2 class="about-section__title">Chiffres clés</h2>
                    <p class="about-section__subtitle">Une marque construite sur la constance, la qualité et la satisfaction.</p>
                </div>
                <div class="about-section__body">
                    <div class="about-stats">
                        <div class="about-stat">
                            <div class="about-stat__num">2015</div>
                            <div class="about-stat__label">Année de création</div>
                        </div>
                        <div class="about-stat">
                            <div class="about-stat__num">10 ans</div>
                            <div class="about-stat__label">Ambition : une référence du confort en Côte d’Ivoire</div>
                        </div>
                        <div class="about-stat">
                            <div class="about-stat__num">Sélection</div>
                            <div class="about-stat__label">Matelas, oreillers, draps, accessoires et univers maison</div>
                        </div>
                        <div class="about-stat">
                            <div class="about-stat__num">Support</div>
                            <div class="about-stat__label">Réponse rapide via WhatsApp & email (lun-sam)</div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="about-section" aria-label="Notre histoire">
                <div class="about-section__head">
                    <h2 class="about-section__title">Notre histoire (en 4 étapes)</h2>
                    <p class="about-section__subtitle">Une progression simple : comprendre, sélectionner, accompagner, améliorer.</p>
                </div>
                <div class="about-section__body">
                    <div class="about-timeline">
                        <div class="about-step">
                            <div class="about-step__dot">01</div>
                            <div>
                                <h3 class="about-step__title">Comprendre vos besoins</h3>
                                <p class="about-step__text">Morphologie, fermeté, confort, chaleur : chaque détail compte pour bien dormir.</p>
                            </div>
                        </div>
                        <div class="about-step">
                            <div class="about-step__dot">02</div>
                            <div>
                                <h3 class="about-step__title">Sélectionner le meilleur</h3>
                                <p class="about-step__text">Nous retenons des produits qui offrent un vrai gain de confort et une bonne durabilité.</p>
                            </div>
                        </div>
                        <div class="about-step">
                            <div class="about-step__dot">03</div>
                            <div>
                                <h3 class="about-step__title">Accompagner et rassurer</h3>
                                <p class="about-step__text">Conseils, suivi de commande, SAV : on ne vous laisse pas seul après l’achat.</p>
                            </div>
                        </div>
                        <div class="about-step">
                            <div class="about-step__dot">04</div>
                            <div>
                                <h3 class="about-step__title">Améliorer en continu</h3>
                                <p class="about-step__text">Nous optimisons l’expérience, le contenu, les produits et le service selon vos retours.</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="about-section" aria-label="CTA">
                <div class="about-section__head">
                    <h2 class="about-section__title">Prêt à transformer vos nuits ?</h2>
                    <p class="about-section__subtitle">Dites-nous ce que vous recherchez — nous vous orientons vers le bon confort.</p>
                </div>
                <div class="about-section__body">
                    <div class="about-actions" style="margin-top:0;">
                        <a class="about-btn about-btn--primary" href="https://wa.me/2250799140356" target="_blank" rel="noopener">
                            <i class="fa-brands fa-whatsapp"></i>
                            Conseils immédiats
                            <i class="fa-solid fa-arrow-right"></i>
                        </a>
                        <a class="about-btn" href="{{ route('home') }}">
                            <i class="fa-solid fa-store"></i>
                            Découvrir la collection
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
@endsection
