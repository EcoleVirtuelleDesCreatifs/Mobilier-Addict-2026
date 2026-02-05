@extends('layouts.front')

@section('title', 'FAQ')
@section('meta_description', "FAQ Mobilier Addict : questions fréquentes sur les produits, commandes et livraison.")

@push('styles')
    <style>
        .faq-page { background: #0b0b12; }
        .faq-hero { position: relative; padding: 62px 0 18px; overflow: hidden; }
        .faq-hero__bg {
            position: absolute;
            inset: 0;
            background:
                radial-gradient(900px 600px at 10% 10%, rgba(255, 76, 154, .22), transparent 65%),
                radial-gradient(900px 600px at 95% 20%, rgba(122, 92, 255, .22), transparent 60%),
                radial-gradient(900px 600px at 45% 90%, rgba(18, 184, 134, .18), transparent 60%),
                linear-gradient(180deg, #070710 0%, #111128 55%, #070710 100%);
        }
        .faq-hero__grid {
            position: relative;
            display: grid;
            grid-template-columns: 1.15fr .85fr;
            gap: 18px;
            align-items: stretch;
        }
        .faq-kicker {
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
        .faq-title {
            margin: 14px 0 10px;
            color: #fff;
            font-weight: 900;
            letter-spacing: -0.8px;
            line-height: 1.06;
            font-size: clamp(30px, 4.6vw, 52px);
        }
        .faq-subtitle {
            color: rgba(255,255,255,.72);
            max-width: 62ch;
            font-size: 15px;
            line-height: 1.7;
            margin: 0;
        }
        .faq-actions { margin-top: 18px; display: flex; flex-wrap: wrap; gap: 12px; }
        .faq-btn {
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
        .faq-btn:hover { transform: translateY(-1px); background: rgba(255,255,255,.14); }
        .faq-btn--primary {
            background: linear-gradient(135deg, rgba(255, 76, 154, .94), rgba(122, 92, 255, .94));
            border-color: rgba(255,255,255,.18);
        }
        .faq-btn--primary:hover {
            background: linear-gradient(135deg, rgba(255, 76, 154, .99), rgba(122, 92, 255, .99));
        }

        .faq-panel {
            border-radius: 22px;
            background: rgba(255,255,255,.08);
            border: 1px solid rgba(255,255,255,.14);
            box-shadow: 0 18px 48px rgba(0,0,0,.35);
            backdrop-filter: blur(14px);
        }
        .faq-panel__inner { padding: 18px; display: grid; gap: 10px; }
        .faq-chip {
            display: inline-flex;
            align-items: center;
            gap: 10px;
            padding: 10px 12px;
            border-radius: 14px;
            background: rgba(255,255,255,.08);
            border: 1px solid rgba(255,255,255,.10);
            color: rgba(255,255,255,.86);
            font-weight: 900;
            text-decoration: none;
            font-size: 13px;
        }
        .faq-chip:hover { background: rgba(255,255,255,.12); }
        .faq-chip i { opacity: .95; }

        .faq-body { padding: 18px 0 70px; }
        .faq-section {
            margin-top: 18px;
            border-radius: 22px;
            background: rgba(255,255,255,.06);
            border: 1px solid rgba(255,255,255,.10);
            box-shadow: 0 18px 48px rgba(0,0,0,.28);
            overflow: hidden;
        }
        .faq-section__head { padding: 20px 20px 0; }
        .faq-section__title { margin: 0; color: #fff; font-weight: 900; letter-spacing: -.4px; font-size: 20px; }
        .faq-section__subtitle { margin: 8px 0 0; color: rgba(255,255,255,.70); font-size: 14px; line-height: 1.7; }
        .faq-section__body { padding: 20px; }

        .faq-list { display: grid; gap: 10px; }
        .faq-item {
            border-radius: 16px;
            background: rgba(255,255,255,.06);
            border: 1px solid rgba(255,255,255,.10);
            padding: 12px;
        }
        .faq-item summary {
            cursor: pointer;
            color: #fff;
            font-weight: 900;
            list-style: none;
        }
        .faq-item summary::-webkit-details-marker { display: none; }
        .faq-item p {
            margin: 10px 0 0;
            color: rgba(255,255,255,.72);
            font-size: 14px;
            line-height: 1.7;
        }
        .faq-item a { color: #fff; }

        @media (max-width: 991.98px) {
            .faq-hero__grid { grid-template-columns: 1fr; }
        }
    </style>
@endpush

@section('content')
<div class="faq-page">
    <section class="faq-hero" aria-label="FAQ">
        <div class="faq-hero__bg"></div>
        <div class="container">
            <div class="faq-hero__grid">
                <div>
                    <div class="faq-kicker">
                        <i class="fa-solid fa-circle-question"></i>
                        Réponses rapides • Support • Conseils
                    </div>
                    <h1 class="faq-title">FAQ Mobilier Addict</h1>
                    <p class="faq-subtitle">Les réponses aux questions les plus fréquentes : choix du produit, commandes, livraison et retours. Si tu ne trouves pas ta réponse, écris-nous directement.</p>

                    <div class="faq-actions">
                        <a class="faq-btn faq-btn--primary" href="https://wa.me/2250799140356" target="_blank" rel="noopener">
                            <i class="fa-brands fa-whatsapp"></i>
                            WhatsApp
                            <i class="fa-solid fa-arrow-right"></i>
                        </a>
                        <a class="faq-btn" href="{{ route('pages.contact') }}"><i class="fa-solid fa-headset"></i> Contact</a>
                        <a class="faq-btn" href="{{ route('pages.guides.mattress') }}"><i class="fa-solid fa-bed"></i> Guide matelas</a>
                    </div>
                </div>

                <aside class="faq-panel" aria-label="Accès rapide">
                    <div class="faq-panel__inner">
                        <a class="faq-chip" href="#produits"><i class="fa-solid fa-bed"></i> Produits</a>
                        <a class="faq-chip" href="#commande"><i class="fa-solid fa-bag-shopping"></i> Commande</a>
                        <a class="faq-chip" href="#livraison"><i class="fa-solid fa-truck-fast"></i> Livraison</a>
                        <a class="faq-chip" href="#retours"><i class="fa-solid fa-rotate-left"></i> Retours</a>
                    </div>
                </aside>
            </div>
        </div>
    </section>

    <section class="faq-body" aria-label="Questions fréquentes">
        <div class="container">
            <div class="faq-section" id="produits">
                <div class="faq-section__head">
                    <h2 class="faq-section__title">Produits &amp; conseils</h2>
                    <p class="faq-section__subtitle">Bien choisir, c’est la clé d’un confort durable.</p>
                </div>
                <div class="faq-section__body">
                    <div class="faq-list">
                        <details class="faq-item" open>
                            <summary>Comment choisir mon matelas ?</summary>
                            <p>Consulte notre <a href="{{ route('pages.guides.mattress') }}">guide d'achat matelas</a>. Nous recommandons de choisir selon ta morphologie, ta position de sommeil et la fermeté souhaitée.</p>
                        </details>
                        <details class="faq-item">
                            <summary>Quelle fermeté choisir (ferme / mi-ferme / moelleux) ?</summary>
                            <p>En général : mi-ferme pour l’équilibre, ferme pour plus de soutien. Si tu hésites, écris-nous sur WhatsApp avec ton poids/taille et ta position de sommeil.</p>
                        </details>
                        <details class="faq-item">
                            <summary>Les photos sont-elles fidèles ?</summary>
                            <p>Nous faisons au mieux pour refléter le rendu réel. De légères variations peuvent exister selon l’éclairage et l’écran.</p>
                        </details>
                    </div>
                </div>
            </div>

            <div class="faq-section" id="commande">
                <div class="faq-section__head">
                    <h2 class="faq-section__title">Commande &amp; paiement</h2>
                    <p class="faq-section__subtitle">Tout ce qu’il faut pour passer commande sereinement.</p>
                </div>
                <div class="faq-section__body">
                    <div class="faq-list">
                        <details class="faq-item" open>
                            <summary>Comment suivre ma commande ?</summary>
                            <p>Si tu as un numéro de commande, contacte le <a href="{{ route('pages.customer-service') }}">service client</a> pour obtenir le suivi.</p>
                        </details>
                        <details class="faq-item">
                            <summary>Quels moyens de contact sont disponibles ?</summary>
                            <p>Tu peux nous joindre via la page <a href="{{ route('pages.contact') }}">Contact</a>, par email (<a href="mailto:contact@mobilier-addict.com">contact@mobilier-addict.com</a>) ou par WhatsApp.</p>
                        </details>
                        <details class="faq-item">
                            <summary>Je me suis trompé dans mon adresse / numéro, que faire ?</summary>
                            <p>Écris-nous rapidement (idéalement WhatsApp) avec ton numéro de commande pour que l’on corrige avant l’expédition.</p>
                        </details>
                    </div>
                </div>
            </div>

            <div class="faq-section" id="livraison">
                <div class="faq-section__head">
                    <h2 class="faq-section__title">Livraison</h2>
                    <p class="faq-section__subtitle">Réception, délais et recommandations.</p>
                </div>
                <div class="faq-section__body">
                    <div class="faq-list">
                        <details class="faq-item" open>
                            <summary>Quels sont les délais de livraison ?</summary>
                            <p>Les délais varient selon le produit. Les informations sont communiquées lors de la commande et via le suivi.</p>
                        </details>
                        <details class="faq-item">
                            <summary>Que faire si le colis est abîmé ?</summary>
                            <p>Prends une photo et contacte-nous rapidement avec ton numéro de commande. On te guide pour la suite.</p>
                        </details>
                        <details class="faq-item">
                            <summary>Où trouver les infos Livraison &amp; Retours ?</summary>
                            <p>Tout est détaillé ici : <a href="{{ route('pages.shipping-returns') }}">Livraison &amp; Retours</a>.</p>
                        </details>
                    </div>
                </div>
            </div>

            <div class="faq-section" id="retours">
                <div class="faq-section__head">
                    <h2 class="faq-section__title">Retours &amp; SAV</h2>
                    <p class="faq-section__subtitle">La procédure la plus simple pour une prise en charge rapide.</p>
                </div>
                <div class="faq-section__body">
                    <div class="faq-list">
                        <details class="faq-item" open>
                            <summary>Comment lancer un retour / échange ?</summary>
                            <p>Contacte le service client avec ton numéro de commande. Explique la demande et, si nécessaire, joins une photo.</p>
                        </details>
                        <details class="faq-item">
                            <summary>Comment ouvrir une demande SAV ?</summary>
                            <p>Décris le problème, indique la date d’achat, et ajoute une photo si possible. Nous te proposerons une solution adaptée.</p>
                        </details>
                        <details class="faq-item">
                            <summary>Je n’ai pas trouvé ma réponse</summary>
                            <p>Écris-nous sur WhatsApp : c’est le plus rapide. Sinon, passe par la page <a href="{{ route('pages.contact') }}">Contact</a>.</p>
                        </details>
                    </div>

                    <div class="faq-actions" style="margin-top: 16px;">
                        <a class="faq-btn faq-btn--primary" href="https://wa.me/2250799140356" target="_blank" rel="noopener">
                            <i class="fa-brands fa-whatsapp"></i>
                            Ouvrir WhatsApp
                            <i class="fa-solid fa-arrow-right"></i>
                        </a>
                        <a class="faq-btn" href="{{ route('pages.contact') }}"><i class="fa-solid fa-paper-plane"></i> Écrire au support</a>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
@endsection
