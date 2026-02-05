@extends('layouts.front')

@section('title', 'Contact')
@section('meta_description', "Contactez Mobilier Addict : nous sommes disponibles pour vous aider avant, pendant et après votre achat.")

@push('styles')
    <style>
        .contact-hero {
            position: relative;
            padding: 56px 0 28px;
            overflow: hidden;
        }
        .contact-hero__bg {
            position: absolute;
            inset: 0;
            background:
                radial-gradient(900px 600px at 10% 10%, rgba(255, 76, 154, .22), transparent 65%),
                radial-gradient(900px 600px at 90% 20%, rgba(122, 92, 255, .22), transparent 60%),
                radial-gradient(900px 600px at 40% 90%, rgba(18, 184, 134, .18), transparent 60%),
                linear-gradient(180deg, #0b0b12 0%, #121224 60%, #0b0b12 100%);
        }
        .contact-hero__grid {
            position: relative;
            display: grid;
            grid-template-columns: 1.1fr .9fr;
            gap: 22px;
            align-items: stretch;
        }
        .contact-hero__kicker {
            display: inline-flex;
            align-items: center;
            gap: 10px;
            padding: 8px 12px;
            border-radius: 999px;
            background: rgba(255, 255, 255, .10);
            border: 1px solid rgba(255, 255, 255, .14);
            color: rgba(255, 255, 255, .85);
            font-weight: 600;
            letter-spacing: .2px;
            font-size: 13px;
        }
        .contact-hero__title {
            margin: 14px 0 10px;
            color: #fff;
            font-weight: 800;
            letter-spacing: -0.6px;
            line-height: 1.08;
            font-size: clamp(30px, 4.3vw, 48px);
        }
        .contact-hero__subtitle {
            color: rgba(255, 255, 255, .72);
            max-width: 58ch;
            font-size: 15px;
            line-height: 1.6;
        }
        .contact-hero__actions {
            margin-top: 18px;
            display: flex;
            flex-wrap: wrap;
            gap: 12px;
        }
        .contact-btn {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 10px;
            padding: 12px 14px;
            border-radius: 14px;
            border: 1px solid rgba(255,255,255,.16);
            color: #fff;
            text-decoration: none;
            font-weight: 700;
            background: rgba(255,255,255,.10);
            backdrop-filter: blur(12px);
            transition: transform .15s ease, background .15s ease;
        }
        .contact-btn:hover { transform: translateY(-1px); background: rgba(255,255,255,.14); }
        .contact-btn--primary {
            background: linear-gradient(135deg, rgba(255, 76, 154, .92), rgba(122, 92, 255, .92));
            border-color: rgba(255,255,255,.18);
        }
        .contact-btn--primary:hover { background: linear-gradient(135deg, rgba(255, 76, 154, .98), rgba(122, 92, 255, .98)); }
        .contact-btn i { opacity: .95; }

        .contact-panel {
            border-radius: 22px;
            background: rgba(255,255,255,.08);
            border: 1px solid rgba(255,255,255,.14);
            box-shadow: 0 18px 48px rgba(0,0,0,.35);
            backdrop-filter: blur(14px);
        }
        .contact-panel__inner { padding: 18px; }

        .contact-mini {
            display: grid;
            gap: 12px;
        }
        .contact-mini__item {
            display: flex;
            gap: 12px;
            padding: 12px;
            border-radius: 16px;
            background: rgba(255,255,255,.08);
            border: 1px solid rgba(255,255,255,.10);
        }
        .contact-mini__icon {
            width: 42px;
            height: 42px;
            border-radius: 14px;
            display: grid;
            place-items: center;
            background: rgba(255,255,255,.10);
            border: 1px solid rgba(255,255,255,.14);
            color: #fff;
            flex: 0 0 auto;
        }
        .contact-mini__label {
            color: rgba(255,255,255,.62);
            font-size: 12px;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: .2px;
            margin: 0;
        }
        .contact-mini__value {
            color: #fff;
            margin: 2px 0 0;
            font-weight: 800;
            font-size: 14px;
        }
        .contact-mini__value a { color: #fff; text-decoration: none; }
        .contact-mini__value a:hover { text-decoration: underline; }

        .contact-body { padding: 26px 0 56px; background: #0b0b12; }
        .contact-body__grid {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 18px;
            margin-top: -18px;
        }
        .contact-card {
            border-radius: 22px;
            background: rgba(255,255,255,.06);
            border: 1px solid rgba(255,255,255,.10);
            box-shadow: 0 18px 48px rgba(0,0,0,.28);
            overflow: hidden;
        }
        .contact-card__head {
            padding: 18px 18px 0;
            color: #fff;
        }
        .contact-card__title {
            margin: 0;
            font-size: 18px;
            font-weight: 900;
            letter-spacing: -.2px;
        }
        .contact-card__desc { margin: 8px 0 0; color: rgba(255,255,255,.70); font-size: 14px; line-height: 1.6; }
        .contact-card__body { padding: 18px; }

        .contact-form {
            display: grid;
            gap: 12px;
        }
        .contact-form__row { display: grid; grid-template-columns: 1fr 1fr; gap: 12px; }
        .contact-input {
            width: 100%;
            padding: 12px 12px;
            border-radius: 14px;
            border: 1px solid rgba(255,255,255,.14);
            background: rgba(255,255,255,.06);
            color: #fff;
            outline: none;
        }
        .contact-input::placeholder { color: rgba(255,255,255,.52); }
        .contact-input:focus { border-color: rgba(255, 76, 154, .65); box-shadow: 0 0 0 4px rgba(255, 76, 154, .14); }
        .contact-textarea { min-height: 130px; resize: vertical; }

        .contact-cta {
            margin-top: 12px;
            display: flex;
            flex-wrap: wrap;
            gap: 12px;
            align-items: center;
        }
        .contact-note { color: rgba(255,255,255,.60); font-size: 13px; margin: 0; }

        .contact-map {
            border: 0;
            width: 100%;
            height: 320px;
            filter: grayscale(10%) contrast(105%) saturate(110%);
        }

        .contact-faq {
            margin-top: 18px;
            display: grid;
            gap: 10px;
        }
        .contact-faq details {
            border-radius: 16px;
            background: rgba(255,255,255,.06);
            border: 1px solid rgba(255,255,255,.10);
            padding: 12px;
        }
        .contact-faq summary {
            cursor: pointer;
            color: #fff;
            font-weight: 800;
            list-style: none;
        }
        .contact-faq summary::-webkit-details-marker { display: none; }
        .contact-faq p { margin: 10px 0 0; color: rgba(255,255,255,.70); font-size: 14px; line-height: 1.65; }

        @media (max-width: 991.98px) {
            .contact-hero__grid { grid-template-columns: 1fr; }
            .contact-body__grid { grid-template-columns: 1fr; }
            .contact-form__row { grid-template-columns: 1fr; }
        }
    </style>
@endpush

@section('content')
<section class="contact-hero" aria-label="Contact">
    <div class="contact-hero__bg"></div>
    <div class="container">
        <div class="contact-hero__grid">
            <div>
                <div class="contact-hero__kicker">
                    <i class="fa-solid fa-headset"></i>
                    Support premium • Réponse rapide
                </div>
                <h1 class="contact-hero__title">Contactez Mobilier Addict</h1>
                <p class="contact-hero__subtitle">
                    Une question sur un matelas, une commande, la livraison ou le SAV ?
                    Écrivez-nous ou contactez-nous directement — nous vous répondons au plus vite.
                </p>
                <div class="contact-hero__actions">
                    <a class="contact-btn contact-btn--primary" href="https://wa.me/2250799140356" target="_blank" rel="noopener">
                        <i class="fa-brands fa-whatsapp"></i>
                        WhatsApp
                        <i class="fa-solid fa-arrow-right"></i>
                    </a>
                    <a class="contact-btn" href="tel:+2250799140356">
                        <i class="fa-solid fa-phone"></i>
                        Appeler
                    </a>
                    <a class="contact-btn" href="mailto:contact@mobilier-addict.com">
                        <i class="fa-solid fa-envelope"></i>
                        Email
                    </a>
                </div>
            </div>

            <aside class="contact-panel" aria-label="Coordonnées">
                <div class="contact-panel__inner">
                    <div class="contact-mini">
                        <div class="contact-mini__item">
                            <div class="contact-mini__icon"><i class="fa-solid fa-location-dot"></i></div>
                            <div>
                                <p class="contact-mini__label">Adresse</p>
                                <p class="contact-mini__value">Abidjan, Côte d'Ivoire</p>
                            </div>
                        </div>
                        <div class="contact-mini__item">
                            <div class="contact-mini__icon"><i class="fa-solid fa-phone"></i></div>
                            <div>
                                <p class="contact-mini__label">Téléphone</p>
                                <p class="contact-mini__value"><a href="tel:+2250799140356">+225 07 99 14 03 56</a></p>
                            </div>
                        </div>
                        <div class="contact-mini__item">
                            <div class="contact-mini__icon"><i class="fa-solid fa-envelope"></i></div>
                            <div>
                                <p class="contact-mini__label">Email</p>
                                <p class="contact-mini__value"><a href="mailto:contact@mobilier-addict.com">contact@mobilier-addict.com</a></p>
                            </div>
                        </div>
                        <div class="contact-mini__item">
                            <div class="contact-mini__icon"><i class="fa-regular fa-clock"></i></div>
                            <div>
                                <p class="contact-mini__label">Horaires</p>
                                <p class="contact-mini__value">Lun-Sam : 9h - 19h</p>
                            </div>
                        </div>
                    </div>
                </div>
            </aside>
        </div>
    </div>
</section>

<section class="contact-body" aria-label="Formulaire de contact">
    <div class="container">
        <div class="contact-body__grid">
            <div class="contact-card">
                <div class="contact-card__head">
                    <h2 class="contact-card__title">Envoyez-nous un message</h2>
                    <p class="contact-card__desc">Remplissez le formulaire et envoyez-le par email en un clic.</p>
                </div>
                <div class="contact-card__body">
                    <form class="contact-form" onsubmit="event.preventDefault(); const name=this.querySelector('[name=full_name]').value||''; const email=this.querySelector('[name=email]').value||''; const phone=this.querySelector('[name=phone]').value||''; const subject=this.querySelector('[name=subject]').value||''; const message=this.querySelector('[name=message]').value||''; const body=encodeURIComponent('Nom: '+name+'\nEmail: '+email+'\nTéléphone: '+phone+'\n\n'+message); const sub=encodeURIComponent(subject?('Contact - '+subject):'Contact - Mobilier Addict'); window.location.href='mailto:contact@mobilier-addict.com?subject='+sub+'&body='+body;">
                        <div class="contact-form__row">
                            <input class="contact-input" type="text" name="full_name" placeholder="Votre nom" required>
                            <input class="contact-input" type="email" name="email" placeholder="Votre email" required>
                        </div>
                        <div class="contact-form__row">
                            <input class="contact-input" type="tel" name="phone" placeholder="Téléphone (optionnel)">
                            <input class="contact-input" type="text" name="subject" placeholder="Sujet (ex: Commande, Livraison, SAV)" required>
                        </div>
                        <textarea class="contact-input contact-textarea" name="message" placeholder="Dites-nous comment on peut vous aider..." required></textarea>

                        <div class="contact-cta">
                            <button class="contact-btn contact-btn--primary" type="submit">
                                Envoyer
                                <i class="fa-solid fa-paper-plane"></i>
                            </button>
                            <p class="contact-note">Astuce : pour une réponse plus rapide, écrivez-nous sur WhatsApp.</p>
                        </div>
                    </form>

                    <div class="contact-faq" aria-label="Questions fréquentes">
                        <details>
                            <summary>Délais de réponse</summary>
                            <p>Nous répondons généralement dans la journée (lun-sam). En cas de forte affluence, comptez 24-48h.</p>
                        </details>
                        <details>
                            <summary>Suivre une commande</summary>
                            <p>Envoyez votre numéro de commande et votre nom. Nous vous informerons du statut et du délai estimé.</p>
                        </details>
                        <details>
                            <summary>SAV / Garantie</summary>
                            <p>Décrivez le problème, joignez si possible une photo, et indiquez la date d'achat. Nous vous accompagnons rapidement.</p>
                        </details>
                    </div>
                </div>
            </div>

            <div class="contact-card">
                <div class="contact-card__head">
                    <h2 class="contact-card__title">Nous trouver</h2>
                    <p class="contact-card__desc">Abidjan, Côte d'Ivoire — contactez-nous pour un rendez-vous.</p>
                </div>
                <div class="contact-card__body">
                    <iframe
                        class="contact-map"
                        loading="lazy"
                        referrerpolicy="no-referrer-when-downgrade"
                        src="https://www.google.com/maps?q=Abidjan%2C%20C%C3%B4te%20d'Ivoire&output=embed"></iframe>

                    <div class="contact-cta" style="margin-top: 14px;">
                        <a class="contact-btn" href="https://wa.me/2250799140356" target="_blank" rel="noopener">
                            <i class="fa-brands fa-whatsapp"></i>
                            WhatsApp direct
                        </a>
                        <a class="contact-btn" href="tel:+2250799140356">
                            <i class="fa-solid fa-phone"></i>
                            Appel rapide
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
