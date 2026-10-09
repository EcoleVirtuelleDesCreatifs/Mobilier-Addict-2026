@extends('maquette.layout')

@section('title', 'FAQ — Mobilier Addict Abidjan | Livraison en Côte d\'Ivoire')
@section('meta_description', 'Questions fréquentes sur les commandes, paiements, livraisons à Abidjan et en Côte d\'Ivoire, et le service après-vente Mobilier Addict.')

@php
    $faqGroups = [
        ['id' => 'commandes', 'title' => 'Choisir & commander', 'description' => 'Produits, dimensions et disponibilité', 'items' => [
            ['Comment commander chez Mobilier Addict ?', 'Repérez votre article dans le catalogue, ajoutez-le au panier et validez votre commande en ligne. Vous pouvez aussi contacter la boutique sur WhatsApp pour confirmer le stock, le prix et les modalités avant tout règlement.'],
            ['Comment savoir si un article est disponible ?', 'La présence d’un produit sur le site ne garantit pas son stock. Faites confirmer la disponibilité du modèle et du coloris choisis.'],
            ['Puis-je commander un meuble sur mesure ?', 'Oui. Remplissez le formulaire « Devis sur-mesure » en décrivant votre besoin (dimensions, quantités, usage) : notre équipe vous répond avec une proposition chiffrée.'],
            ['Comment participer au Grand Jeu Mobilier Addict ?', 'Rendez-vous sur la page Jeu, créez votre badge personnalisé et partagez-le avec #MobilierAddict #MatelasAddict : les proches qui vous soutiennent font grimper votre score.'],
        ]],
        ['id' => 'paiements', 'title' => 'Prix & paiements', 'description' => 'FCFA et règlement', 'items' => [
            ['Comment connaître le montant total à payer ?', 'Le récapitulatif de votre commande affiche les articles, la livraison, le montage éventuel et le total en FCFA avant validation.'],
            ['Quels moyens de paiement sont acceptés ?', 'Faites confirmer les moyens acceptés (espèces, mobile money, virement) et le bénéficiaire auprès de la boutique avant tout transfert. Ne communiquez jamais votre code secret.'],
            ['Puis-je payer à la livraison ?', 'Selon les articles et la destination, un acompte peut être demandé à la commande. Les modalités exactes vous sont confirmées avant l’expédition.'],
        ]],
        ['id' => 'livraison', 'title' => 'Livraison & installation', 'description' => 'Abidjan et intérieur du pays', 'items' => [
            ['Comment organiser une livraison ?', 'Indiquez votre commune, votre quartier, un repère, l’étage et les conditions d’accès. Les frais et le créneau doivent être confirmés.'],
            ['Livrez-vous en dehors d’Abidjan ?', 'Oui, les livraisons sont possibles dans l’intérieur du pays. Les délais et frais dépendent de la destination : précisez votre ville lors de la commande.'],
            ['Le montage est-il compris ?', 'Précisez le type de meuble et les accès, puis demandez si le montage et la manutention sont proposés et à quel prix.'],
        ]],
        ['id' => 'apres-vente', 'title' => 'Suivi & après-vente', 'description' => 'Réception, entretien et assistance', 'items' => [
            ['Que vérifier à la réception ?', 'Contrôlez le modèle, le coloris, les dimensions, la quantité et l’état des articles avec le livreur lorsque cela est possible.'],
            ['Que faire si un article est abîmé ?', 'Prenez des photos, conservez les emballages et contactez rapidement la boutique avec votre référence de commande.'],
            ['Comment entretenir mes meubles et mon matelas ?', 'Dépoussiérez régulièrement, utilisez un protège-matelas, évitez l’humidité et retournez votre matelas tous les 3 à 6 mois pour prolonger sa durée de vie.'],
        ]],
    ];
    $faqCount = collect($faqGroups)->sum(fn ($g) => count($g['items']));
@endphp

@push('meta')
    <script type="application/ld+json">
        {!! json_encode([
            '@@context' => 'https://schema.org',
            '@type' => 'FAQPage',
            'mainEntity' => collect($faqGroups ?? [])->flatMap(fn ($g) => $g['items'])->map(fn ($i) => [
                '@type' => 'Question',
                'name' => $i[0],
                'acceptedAnswer' => ['@type' => 'Answer', 'text' => $i[1]],
            ])->values()->all(),
        ], JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE) !!}
    </script>
@endpush

@push('styles')
    <style>
        .faq-topic.is-hidden { display: none; }
        .faq-question[hidden], .faq-group[hidden] { display: none; }

        /* Hero */
        .faq-hero{background:#00234D;padding:70px 0;color:#fff;position:relative;overflow:hidden;}
        .faq-hero::before,.faq-hero::after{content:'';position:absolute;border-radius:50%;border:1px solid rgba(236,72,153,.35);pointer-events:none;}
        .faq-hero::before{width:420px;height:420px;top:-160px;right:-120px;}
        .faq-hero::after{width:260px;height:260px;bottom:-140px;left:-80px;border-color:rgba(255,255,255,.08);}
        .faq-hero-layout{display:grid;grid-template-columns:1.4fr .9fr;gap:44px;align-items:center;position:relative;z-index:1;}
        .faq-eyebrow{font-size:12px;font-weight:700;letter-spacing:.14em;text-transform:uppercase;color:#ec4899;margin-bottom:14px;}
        .faq-hero h1{font-size:clamp(30px,4vw,46px);font-weight:800;line-height:1.15;margin-bottom:16px;}
        .faq-hero h1 span{color:#ec4899;}
        .faq-intro{color:rgba(255,255,255,.75);font-size:15.5px;line-height:1.7;max-width:520px;margin-bottom:28px;}
        .faq-search label{display:block;font-weight:700;font-size:14px;margin-bottom:10px;color:#fff;}
        .faq-search-field{display:flex;align-items:center;gap:12px;background:#fff;border-radius:999px;padding:6px 8px 6px 20px;color:#00234D;}
        .faq-search-field input{flex:1;border:none;outline:none;font-size:15px;padding:10px 0;background:transparent;color:#00234D;min-width:0;}
        .faq-search-status{font-size:12.5px;color:rgba(255,255,255,.6);margin:10px 4px 0;}

        .faq-contact-card{background:rgba(255,255,255,.06);border:1px solid rgba(255,255,255,.14);border-radius:24px;padding:32px;backdrop-filter:blur(6px);}
        .faq-card-label{font-size:11px;font-weight:700;letter-spacing:.14em;text-transform:uppercase;color:#ec4899;display:block;margin-bottom:12px;}
        .faq-contact-card h2{font-size:24px;font-weight:800;margin-bottom:12px;color:#fff;}
        .faq-contact-card p{font-size:13.5px;color:rgba(255,255,255,.7);line-height:1.65;margin-bottom:20px;}
        .faq-call{display:inline-flex;align-items:center;gap:8px;background:#ec4899;color:#fff;font-weight:700;font-size:15px;padding:13px 24px;border-radius:999px;text-decoration:none;transition:.15s;}
        .faq-call:hover{background:#d1357f;color:#fff;transform:translateY(-2px);box-shadow:0 10px 24px rgba(236,72,153,.4);}
        .faq-contact-note{display:block;font-size:12px;color:rgba(255,255,255,.55);margin-top:14px;}

        /* Rubriques */
        .faq-topics{display:grid;grid-template-columns:repeat(auto-fit,minmax(200px,1fr));gap:14px;margin:44px 0;}
        .faq-topic{background:#fff;border:1px solid #f0e8ee;border-radius:18px;padding:20px;text-decoration:none;transition:.15s;display:block;}
        .faq-topic:hover{border-color:#ec4899;transform:translateY(-3px);box-shadow:0 12px 28px rgba(0,35,77,.08);}
        .faq-topic-number{display:block;font-size:12px;font-weight:800;color:#ec4899;letter-spacing:.1em;margin-bottom:8px;}
        .faq-topic strong{display:block;color:#00234D;font-size:15px;margin-bottom:4px;}
        .faq-topic span:last-child{font-size:12.5px;color:#888;}

        /* Contenu */
        .faq-content-layout{display:grid;grid-template-columns:300px 1fr;gap:36px;align-items:start;margin-bottom:44px;}
        .faq-guide{position:sticky;top:110px;background:#fff;border:1px solid #f0e8ee;border-radius:20px;padding:28px;}
        .faq-guide h2{color:#00234D;font-size:20px;font-weight:800;margin-bottom:16px;}
        .faq-guide ul{padding-left:0;list-style:none;margin-bottom:16px;}
        .faq-guide li{font-size:13.5px;color:#555;padding:8px 0 8px 24px;position:relative;border-bottom:1px dashed #f0e8ee;}
        .faq-guide li:last-child{border-bottom:none;}
        .faq-guide li::before{content:'✓';position:absolute;left:0;color:#ec4899;font-weight:800;}
        .faq-guide-note{font-size:12px;color:#999;line-height:1.6;margin-bottom:16px;}
        .faq-guide a{color:#ec4899;font-weight:700;font-size:13.5px;text-decoration:none;}
        .faq-guide a:hover{text-decoration:underline;}

        .faq-group{margin-bottom:34px;scroll-margin-top:100px;}
        .faq-group-heading{display:flex;align-items:center;gap:14px;margin-bottom:16px;}
        .faq-group-heading span{font-size:13px;font-weight:800;color:#ec4899;letter-spacing:.1em;}
        .faq-group-heading h2{color:#00234D;font-size:20px;font-weight:800;margin:0;}
        .faq-question{background:#fff;border:1px solid #f0e8ee;border-radius:16px;margin-bottom:10px;overflow:hidden;transition:border-color .15s;}
        .faq-question[open]{border-color:#ec4899;}
        .faq-question summary{list-style:none;cursor:pointer;padding:18px 22px;font-weight:600;font-size:15px;color:#00234D;display:flex;align-items:center;justify-content:space-between;gap:16px;}
        .faq-question summary::-webkit-details-marker{display:none;}
        .faq-toggle{flex:0 0 22px;width:22px;height:22px;border-radius:50%;background:rgba(236,72,153,.1);position:relative;transition:.2s;}
        .faq-toggle::before,.faq-toggle::after{content:'';position:absolute;background:#ec4899;border-radius:2px;top:50%;left:50%;transform:translate(-50%,-50%);}
        .faq-toggle::before{width:10px;height:2px;}
        .faq-toggle::after{width:2px;height:10px;transition:.2s;}
        .faq-question[open] .faq-toggle{background:#ec4899;}
        .faq-question[open] .faq-toggle::before,.faq-question[open] .faq-toggle::after{background:#fff;}
        .faq-question[open] .faq-toggle::after{transform:translate(-50%,-50%) rotate(90deg);opacity:0;}
        .faq-answer{padding:0 22px 20px;font-size:14px;color:#666;line-height:1.7;}
        .faq-answer p{margin:0;}

        .faq-empty{text-align:center;padding:44px 20px;background:#fff;border:1px dashed #ec4899;border-radius:20px;}
        .faq-empty h2{color:#00234D;font-size:20px;font-weight:800;}
        .faq-empty p{color:#777;font-size:14px;margin:8px 0 18px;}

        .faq-bottom{background:#00234D;border-radius:24px;padding:40px;color:#fff;display:flex;align-items:center;justify-content:space-between;gap:28px;flex-wrap:wrap;margin-bottom:60px;}
        .faq-bottom h2{font-size:24px;font-weight:800;margin-bottom:8px;}
        .faq-bottom p{color:rgba(255,255,255,.7);font-size:14px;max-width:520px;margin:0;}
        .faq-action{display:inline-flex;align-items:center;gap:8px;background:#ec4899;color:#fff;font-weight:700;font-size:14px;padding:13px 26px;border-radius:999px;text-decoration:none;border:none;cursor:pointer;transition:.15s;}
        .faq-action:hover{background:#d1357f;color:#fff;transform:translateY(-2px);box-shadow:0 10px 24px rgba(236,72,153,.35);}
        .faq-bottom .faq-action:last-child{background:transparent;border:1px solid rgba(255,255,255,.4);}
        .faq-bottom .faq-action:last-child:hover{border-color:#ec4899;background:rgba(236,72,153,.15);}

        @media (max-width:991.98px){
            .faq-hero-layout{grid-template-columns:1fr;}
            .faq-content-layout{grid-template-columns:1fr;}
            .faq-guide{position:static;}
        }
    </style>
@endpush

@section('content')
    <!-- breadcrumb start -->
    <div class="breadcrumb">
        <div class="container">
            <ul class="list-unstyled d-flex align-items-center m-0">
                <li><a href="{{ route('home') }}">Accueil</a></li>
                <li>
                    <svg class="icon icon-breadcrumb" width="64" height="64" viewBox="0 0 64 64" fill="none" xmlns="http://www.w3.org/2000/svg"><g opacity="0.4"><path d="M25.9375 8.5625L23.0625 11.4375L43.625 32L23.0625 52.5625L25.9375 55.4375L47.9375 33.4375L49.3125 32L47.9375 30.5625L25.9375 8.5625Z" fill="#000"/></g></svg>
                </li>
                <li>FAQ</li>
            </ul>
        </div>
    </div>
    <!-- breadcrumb end -->

            <section class="faq-hero" aria-labelledby="faq-title">
                <div class="container">
                    <div class="faq-hero-layout">
                        <div>
                            <p class="faq-eyebrow">Mobilier Addict · Côte d’Ivoire</p>
                            <h1 id="faq-title">Bien choisir.<br><span>Acheter sereinement.</span></h1>
                            <p class="faq-intro">Du choix de votre matelas à la réception de vos meubles, retrouvez les réponses utiles pour aménager votre chez-vous.</p>
                            <div class="faq-search" id="faq-search-box">
                                <label for="faq-search-input">Quelle est votre question ?</label>
                                <div class="faq-search-field">
                                    <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" aria-hidden="true"><circle cx="10.5" cy="10.5" r="6.5"></circle><path d="m16 16 5 5"></path></svg>
                                    <input id="faq-search-input" type="search" placeholder="Ex. : livraison, paiement, matelas…" aria-controls="faq-answers" autocomplete="off">
                                </div>
                                <p id="faq-search-status" role="status" aria-live="polite" aria-atomic="true">{{ $faqCount }} réponses pour vous guider.</p>
                            </div>
                        </div>
                        <aside class="faq-contact-card" aria-labelledby="faq-contact-title">
                            <span class="faq-card-label">Parlons de votre projet</span>
                            <h2 id="faq-contact-title">Un doute avant<br>de commander ?</h2>
                            <p>Une référence, une dimension, une adresse de livraison : préparez vos informations et échangez directement avec la boutique.</p>
                            <a class="faq-call" href="tel:+2250799140356">+225 07 99 14 03 56 <span aria-hidden="true">↗</span></a>
                            <span class="faq-contact-note">Pour confirmer votre commande et ses modalités.</span>
                        </aside>
                    </div>
                </div>
            </section>

            <div class="container">
                <nav class="faq-topics" aria-label="Rubriques de la FAQ">
                    @foreach($faqGroups as $index => $group)
                        <a class="faq-topic" href="#{{ $group['id'] }}">
                            <span class="faq-topic-number" aria-hidden="true">0{{ $index + 1 }}</span>
                            <strong>{{ htmlspecialchars($group['title'], ENT_QUOTES, 'UTF-8') }}</strong>
                            <span>{{ htmlspecialchars($group['description'], ENT_QUOTES, 'UTF-8') }}</span>
                        </a>
                    @endforeach
                </nav>

                <div class="faq-content-layout">
                    <aside class="faq-guide" aria-labelledby="faq-guide-title">
                        <p class="faq-eyebrow">Les bons réflexes</p>
                        <h2 id="faq-guide-title">Avant de valider<br>votre achat</h2>
                        <ul>
                            <li>Confirmez le stock et les dimensions.</li>
                            <li>Demandez le total en FCFA, livraison comprise.</li>
                            <li>Précisez votre commune et un repère de livraison.</li>
                            <li>Conservez votre reçu et les conditions de vente.</li>
                        </ul>
                        <p class="faq-guide-note">Les modalités peuvent varier selon l’article et votre destination. Faites-les confirmer avant tout paiement.</p>
                        <a href="{{ route('collection.index') }}">Explorer le catalogue <span aria-hidden="true">→</span></a>
                    </aside>

                    <div id="faq-answers">
                        @foreach($faqGroups as $index => $group)
                            <section class="faq-group" id="{{ $group['id'] }}" aria-labelledby="{{ $group['id'] }}-title">
                                <div class="faq-group-heading">
                                    <span aria-hidden="true">0{{ $index + 1 }}</span>
                                    <h2 id="{{ $group['id'] }}-title">{{ htmlspecialchars($group['title'], ENT_QUOTES, 'UTF-8') }}</h2>
                                </div>
                                @foreach($group['items'] as $item)
                                    <details class="faq-question">
                                        <summary>{{ htmlspecialchars($item[0], ENT_QUOTES, 'UTF-8') }}<span class="faq-toggle" aria-hidden="true"></span></summary>
                                        <div class="faq-answer"><p>{{ htmlspecialchars($item[1], ENT_QUOTES, 'UTF-8') }}</p></div>
                                    </details>
                                @endforeach
                            </section>
                        @endforeach
                        <div class="faq-empty" id="faq-empty" hidden>
                            <h2>Aucune réponse trouvée</h2>
                            <p>Essayez un mot plus simple, comme « paiement » ou « livraison », ou appelez la boutique.</p>
                            <button class="faq-action" id="faq-reset" type="button">Afficher toutes les questions</button>
                        </div>
                    </div>
                </div>

                <section class="faq-bottom" aria-labelledby="faq-bottom-title">
                    <div>
                        <p class="faq-eyebrow">Votre intérieur, votre projet</p>
                        <h2 id="faq-bottom-title">Besoin d’une réponse personnalisée ?</h2>
                        <p>Gardez la référence de votre article à portée de main. Pour une livraison, indiquez aussi votre ville et votre quartier.</p>
                    </div>
                    <div class="d-flex flex-wrap gap-3">
                        <a class="faq-action" href="tel:+2250799140356">Appeler la boutique <span aria-hidden="true">↗</span></a>
                        <a class="faq-action" href="{{ route('devis.create') }}">Demander un devis <span aria-hidden="true">→</span></a>
                    </div>
                </section>
            </div>

@push('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            var input = document.getElementById('faq-search-input');
            var status = document.getElementById('faq-search-status');
            var answers = document.getElementById('faq-answers');
            var empty = document.getElementById('faq-empty');
            var reset = document.getElementById('faq-reset');
            if (!input || !answers) return;

            var questions = Array.prototype.slice.call(answers.querySelectorAll('.faq-question'));
            var groups = Array.prototype.slice.call(answers.querySelectorAll('.faq-group'));
            var topics = Array.prototype.slice.call(document.querySelectorAll('.faq-topic'));
            var total = questions.length;

            var normalize = function (s) {
                return (s || '').toLowerCase().normalize('NFD').replace(/[\u0300-\u036f]/g, '');
            };

            var applyFilter = function () {
                var q = normalize(input.value.trim());
                var visible = 0;

                questions.forEach(function (el) {
                    var match = q === '' || normalize(el.textContent).indexOf(q) !== -1;
                    el.hidden = !match;
                    if (match) visible++;
                });

                groups.forEach(function (g) {
                    var hasVisible = Array.prototype.slice.call(g.querySelectorAll('.faq-question')).some(function (el) { return !el.hidden; });
                    g.hidden = !hasVisible;
                });

                topics.forEach(function (t) {
                    var id = (t.getAttribute('href') || '').replace('#', '');
                    var g = document.getElementById(id);
                    t.classList.toggle('is-hidden', !!(g && g.hidden));
                });

                if (empty) empty.hidden = visible !== 0;
                if (status) {
                    status.textContent = q === ''
                        ? total + ' réponses pour vous guider.'
                        : visible + ' réponse' + (visible > 1 ? 's' : '') + ' pour « ' + input.value.trim() + ' »';
                }
            };

            input.addEventListener('input', applyFilter);
            if (reset) {
                reset.addEventListener('click', function () {
                    input.value = '';
                    applyFilter();
                    input.focus();
                });
            }
        });
    </script>
@endpush
@endsection
