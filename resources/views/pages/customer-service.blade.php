@extends('layouts.front')

@section('title', 'Service client')
@section('meta_description', "Service client Mobilier Addict : assistance, suivi de commande, conseils et support.")

@push('styles')
    <style>
        .support-page { background: #0b0b12; }
        .support-hero { position: relative; padding: 62px 0 24px; overflow: hidden; }
        .support-hero__bg {
            position: absolute; inset: 0;
            background:
                radial-gradient(900px 600px at 10% 10%, rgba(255, 76, 154, .22), transparent 65%),
                radial-gradient(900px 600px at 95% 20%, rgba(122, 92, 255, .22), transparent 60%),
                radial-gradient(900px 600px at 45% 90%, rgba(18, 184, 134, .18), transparent 60%),
                linear-gradient(180deg, #070710 0%, #111128 55%, #070710 100%);
        }
        .support-hero__grid { position: relative; display: grid; grid-template-columns: 1.15fr .85fr; gap: 18px; align-items: stretch; }
        .support-kicker { display: inline-flex; align-items: center; gap: 10px; padding: 8px 12px; border-radius: 999px; background: rgba(255,255,255,.10); border: 1px solid rgba(255,255,255,.14); color: rgba(255,255,255,.88); font-weight: 800; font-size: 13px; letter-spacing: .2px; }
        .support-title { margin: 14px 0 10px; color: #fff; font-weight: 900; letter-spacing: -0.8px; line-height: 1.06; font-size: clamp(30px, 4.6vw, 52px); }
        .support-subtitle { color: rgba(255,255,255,.72); max-width: 62ch; font-size: 15px; line-height: 1.7; margin: 0; }
        .support-actions { margin-top: 18px; display: flex; flex-wrap: wrap; gap: 12px; }
        .support-btn { display: inline-flex; align-items: center; justify-content: center; gap: 10px; padding: 12px 14px; border-radius: 14px; border: 1px solid rgba(255,255,255,.16); color: #fff; text-decoration: none; font-weight: 800; background: rgba(255,255,255,.10); backdrop-filter: blur(12px); transition: transform .15s ease, background .15s ease; }
        .support-btn:hover { transform: translateY(-1px); background: rgba(255,255,255,.14); }
        .support-btn--primary { background: linear-gradient(135deg, rgba(255, 76, 154, .94), rgba(122, 92, 255, .94)); border-color: rgba(255,255,255,.18); }
        .support-btn--primary:hover { background: linear-gradient(135deg, rgba(255, 76, 154, .99), rgba(122, 92, 255, .99)); }

        .support-panel { border-radius: 22px; background: rgba(255,255,255,.08); border: 1px solid rgba(255,255,255,.14); box-shadow: 0 18px 48px rgba(0,0,0,.35); backdrop-filter: blur(14px); }
        .support-panel__inner { padding: 18px; }
        .support-mini { display: grid; gap: 12px; }
        .support-mini__item { display: flex; gap: 12px; padding: 12px; border-radius: 16px; background: rgba(255,255,255,.08); border: 1px solid rgba(255,255,255,.10); }
        .support-mini__icon { width: 42px; height: 42px; border-radius: 14px; display: grid; place-items: center; background: rgba(255,255,255,.10); border: 1px solid rgba(255,255,255,.14); color: #fff; flex: 0 0 auto; }
        .support-mini__label { margin: 0; color: rgba(255,255,255,.62); font-size: 12px; font-weight: 800; text-transform: uppercase; letter-spacing: .25px; }
        .support-mini__value { margin: 2px 0 0; color: #fff; font-weight: 900; font-size: 14px; line-height: 1.3; }
        .support-mini__value a { color: #fff; text-decoration: none; }
        .support-mini__value a:hover { text-decoration: underline; }

        .support-body { padding: 18px 0 70px; }
        .support-section { margin-top: 18px; border-radius: 22px; background: rgba(255,255,255,.06); border: 1px solid rgba(255,255,255,.10); box-shadow: 0 18px 48px rgba(0,0,0,.28); overflow: hidden; }
        .support-section__head { padding: 20px 20px 0; }
        .support-section__title { margin: 0; color: #fff; font-weight: 900; letter-spacing: -.4px; font-size: 20px; }
        .support-section__subtitle { margin: 8px 0 0; color: rgba(255,255,255,.70); font-size: 14px; line-height: 1.7; }
        .support-section__body { padding: 20px; }

        .support-cards { display: grid; grid-template-columns: repeat(3, 1fr); gap: 14px; }
        .support-card { border-radius: 18px; background: rgba(255,255,255,.06); border: 1px solid rgba(255,255,255,.10); padding: 14px; }
        .support-card__icon { width: 44px; height: 44px; border-radius: 16px; display: grid; place-items: center; background: rgba(255,255,255,.10); border: 1px solid rgba(255,255,255,.14); color: #fff; margin-bottom: 10px; }
        .support-card__name { margin: 0; color: #fff; font-weight: 900; font-size: 15px; }
        .support-card__text { margin: 8px 0 0; color: rgba(255,255,255,.70); font-size: 13.5px; line-height: 1.65; }

        .support-steps { display: grid; gap: 12px; }
        .support-step { display: flex; gap: 12px; padding: 14px; border-radius: 18px; background: rgba(255,255,255,.06); border: 1px solid rgba(255,255,255,.10); }
        .support-step__dot { width: 44px; height: 44px; border-radius: 16px; display: grid; place-items: center; background: linear-gradient(135deg, rgba(255,76,154,.86), rgba(122,92,255,.86)); color: #fff; font-weight: 950; flex: 0 0 auto; }
        .support-step__title { margin: 0; color: #fff; font-weight: 900; font-size: 15px; }
        .support-step__text { margin: 8px 0 0; color: rgba(255,255,255,.70); font-size: 13.5px; line-height: 1.65; }

        .support-faq { display: grid; gap: 10px; }
        .support-faq details { border-radius: 16px; background: rgba(255,255,255,.06); border: 1px solid rgba(255,255,255,.10); padding: 12px; }
        .support-faq summary { cursor: pointer; color: #fff; font-weight: 900; list-style: none; }
        .support-faq summary::-webkit-details-marker { display: none; }
        .support-faq p { margin: 10px 0 0; color: rgba(255,255,255,.70); font-size: 14px; line-height: 1.65; }

        @media (max-width: 991.98px) {
            .support-hero__grid { grid-template-columns: 1fr; }
            .support-cards { grid-template-columns: 1fr; }
        }
    </style>
@endpush

@section('content')
<div class="support-page">
    <section class="support-hero" aria-label="Service client">
        <div class="support-hero__bg"></div>
        <div class="container">
            <div class="support-hero__grid">
                <div>
                    <div class="support-kicker">
                        <i class="fa-solid fa-headset"></i>
                        Support • Suivi • SAV
                    </div>
                    <h1 class="support-title">Service client Mobilier Addict</h1>
                    <p class="support-subtitle">
                        Besoin d’un conseil, d’un suivi de commande, d’un retour ou d’un service après-vente ?
                        Nous vous accompagnons rapidement et avec clarté.
                    </p>

                    <div class="support-actions">
                        <a class="support-btn support-btn--primary" href="https://wa.me/2250799140356" target="_blank" rel="noopener">
                            <i class="fa-brands fa-whatsapp"></i>
                            WhatsApp (réponse rapide)
                            <i class="fa-solid fa-arrow-right"></i>
                        </a>
                        <a class="support-btn" href="tel:+2250799140356">
                            <i class="fa-solid fa-phone"></i>
                            Appeler
                        </a>
                        <a class="support-btn" href="mailto:contact@mobilier-addict.com">
                            <i class="fa-solid fa-envelope"></i>
                            Email
                        </a>
                    </div>
                </div>

                <aside class="support-panel" aria-label="Coordonnées">
                    <div class="support-panel__inner">
                        <div class="support-mini">
                            <div class="support-mini__item">
                                <div class="support-mini__icon"><i class="fa-regular fa-clock"></i></div>
                                <div>
                                    <p class="support-mini__label">Horaires</p>
                                    <p class="support-mini__value">Lun-Sam : 9h - 19h</p>
                                </div>
                            </div>
                            <div class="support-mini__item">
                                <div class="support-mini__icon"><i class="fa-solid fa-location-dot"></i></div>
                                <div>
                                    <p class="support-mini__label">Zone</p>
                                    <p class="support-mini__value">Abidjan, Côte d’Ivoire</p>
                                </div>
                            </div>
                            <div class="support-mini__item">
                                <div class="support-mini__icon"><i class="fa-solid fa-list-check"></i></div>
                                <div>
                                    <p class="support-mini__label">Astuce</p>
                                    <p class="support-mini__value">Préparez votre numéro de commande si vous en avez un</p>
                                </div>
                            </div>
                            <div class="support-mini__item">
                                <div class="support-mini__icon"><i class="fa-solid fa-circle-question"></i></div>
                                <div>
                                    <p class="support-mini__label">FAQ</p>
                                    <p class="support-mini__value"><a href="{{ route('pages.faq') }}">Consulter les réponses rapides</a></p>
                                </div>
                            </div>
                        </div>
                    </div>
                </aside>
            </div>
        </div>
    </section>

    <section class="support-body" aria-label="Aide et informations">
        <div class="container">
            <div class="support-section">
                <div class="support-section__head">
                    <h2 class="support-section__title">Comment pouvons-nous vous aider ?</h2>
                    <p class="support-section__subtitle">Choisissez le sujet et gagnez du temps avec les informations essentielles.</p>
                </div>
                <div class="support-section__body">
                    <div class="support-cards">
                        <div class="support-card">
                            <div class="support-card__icon"><i class="fa-solid fa-truck-fast"></i></div>
                            <h3 class="support-card__name">Livraison</h3>
                            <p class="support-card__text">Délais, réception, modalités : tout est résumé sur notre page Livraison & Retours.</p>
                            <div style="margin-top:10px;">
                                <a class="support-btn" href="{{ route('pages.shipping-returns') }}">Voir Livraison & Retours</a>
                            </div>
                        </div>
                        <div class="support-card">
                            <div class="support-card__icon"><i class="fa-solid fa-box"></i></div>
                            <h3 class="support-card__name">Suivi de commande</h3>
                            <p class="support-card__text">Envoyez votre numéro de commande + nom. Nous vous répondons avec l’état exact.</p>
                        </div>
                        <div class="support-card">
                            <div class="support-card__icon"><i class="fa-solid fa-shield-heart"></i></div>
                            <h3 class="support-card__name">SAV / Garantie</h3>
                            <p class="support-card__text">Expliquez le problème et joignez une photo si possible. On vous accompagne rapidement.</p>
                        </div>
                    </div>
                </div>
            </div>

            <div class="support-section" aria-label="Process">
                <div class="support-section__head">
                    <h2 class="support-section__title">Process simple (et efficace)</h2>
                    <p class="support-section__subtitle">En 3 étapes, on traite votre demande proprement.</p>
                </div>
                <div class="support-section__body">
                    <div class="support-steps">
                        <div class="support-step">
                            <div class="support-step__dot">01</div>
                            <div>
                                <h3 class="support-step__title">Vous nous contactez</h3>
                                <p class="support-step__text">WhatsApp pour une réponse rapide, email pour un dossier détaillé.</p>
                            </div>
                        </div>
                        <div class="support-step">
                            <div class="support-step__dot">02</div>
                            <div>
                                <h3 class="support-step__title">On vérifie et on vous répond</h3>
                                <p class="support-step__text">On analyse votre demande et on vous donne une réponse claire + la suite à suivre.</p>
                            </div>
                        </div>
                        <div class="support-step">
                            <div class="support-step__dot">03</div>
                            <div>
                                <h3 class="support-step__title">On clôture avec une solution</h3>
                                <p class="support-step__text">Livraison, échange, retour ou solution SAV selon votre cas.</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="support-section" aria-label="FAQ Service client">
                <div class="support-section__head">
                    <h2 class="support-section__title">Questions fréquentes (Service client)</h2>
                    <p class="support-section__subtitle">Les réponses rapides avant de nous écrire.</p>
                </div>
                <div class="support-section__body">
                    <div class="support-faq">
                        <details>
                            <summary>Quel est le délai de réponse ?</summary>
                            <p>Nous répondons généralement dans la journée (lun-sam). En cas de forte affluence, comptez 24-48h.</p>
                        </details>
                        <details>
                            <summary>Que fournir pour un suivi de commande ?</summary>
                            <p>Votre numéro de commande, votre nom, et si possible le numéro de téléphone utilisé lors de l’achat.</p>
                        </details>
                        <details>
                            <summary>Comment lancer une demande SAV ?</summary>
                            <p>Expliquez le problème, indiquez la date d’achat et joignez une photo si possible.</p>
                        </details>
                    </div>

                    <div class="support-actions" style="margin-top: 16px;">
                        <a class="support-btn support-btn--primary" href="https://wa.me/2250799140356" target="_blank" rel="noopener">
                            <i class="fa-brands fa-whatsapp"></i>
                            Ouvrir WhatsApp
                            <i class="fa-solid fa-arrow-right"></i>
                        </a>
                        <a class="support-btn" href="{{ route('pages.contact') }}">
                            <i class="fa-solid fa-paper-plane"></i>
                            Page Contact
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
@endsection
