@extends('maquette.layout')

@section('title', 'FAQ — Mobilier Addict Abidjan | Livraison en Côte d\'Ivoire')
@section('meta_description', 'Questions fréquentes sur les commandes, paiements, livraisons à Abidjan et en Côte d\'Ivoire, et le service après-vente Mobilier Addict.')

@php
    $faqGroups = [
        ['id' => 'commandes', 'title' => 'Choisir & commander', 'description' => 'Produits, dimensions et disponibilité', 'items' => [
            ['Comment commander chez Mobilier Addict ?', 'Repérez votre article dans le catalogue, puis contactez la boutique pour confirmer le stock, le prix et les modalités avant tout règlement.'],
            ['Comment savoir si un article est disponible ?', 'La présence d’un produit sur le site ne garantit pas son stock. Faites confirmer la disponibilité du modèle et du coloris choisis.'],
        ]],
        ['id' => 'paiements', 'title' => 'Prix & paiements', 'description' => 'FCFA et règlement', 'items' => [
            ['Comment connaître le montant total à payer ?', 'Demandez un récapitulatif en FCFA comprenant les articles, la livraison, le montage éventuel et le total à régler.'],
            ['Quels moyens de paiement sont acceptés ?', 'Faites confirmer les moyens acceptés et le bénéficiaire auprès de la boutique avant tout transfert. Ne communiquez jamais votre code secret.'],
        ]],
        ['id' => 'livraison', 'title' => 'Livraison & installation', 'description' => 'Abidjan et intérieur du pays', 'items' => [
            ['Comment organiser une livraison ?', 'Indiquez votre commune, votre quartier, un repère, l’étage et les conditions d’accès. Les frais et le créneau doivent être confirmés.'],
            ['Le montage est-il compris ?', 'Précisez le type de meuble et les accès, puis demandez si le montage et la manutention sont proposés et à quel prix.'],
        ]],
        ['id' => 'apres-vente', 'title' => 'Suivi & après-vente', 'description' => 'Réception, entretien et assistance', 'items' => [
            ['Que vérifier à la réception ?', 'Contrôlez le modèle, le coloris, les dimensions, la quantité et l’état des articles avec le livreur lorsque cela est possible.'],
            ['Que faire si un article est abîmé ?', 'Prenez des photos, conservez les emballages et contactez rapidement la boutique avec votre référence de commande.'],
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
