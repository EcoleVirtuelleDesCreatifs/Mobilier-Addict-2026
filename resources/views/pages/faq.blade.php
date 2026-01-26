@extends('layouts.front')

@section('title', 'FAQ')
@section('meta_description', "FAQ Mobilier Addict : questions fréquentes sur les produits, commandes et livraison.")

@section('content')
<div class="container py-5">
    <h1 class="mb-3">FAQ</h1>
    <p class="text-muted">Les réponses aux questions les plus fréquentes.</p>

    <div class="accordion mt-4" id="faqAccordion">
        <div class="accordion-item">
            <h2 class="accordion-header" id="faq1">
                <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#faqCollapse1" aria-expanded="true" aria-controls="faqCollapse1">
                    Comment choisir mon matelas ?
                </button>
            </h2>
            <div id="faqCollapse1" class="accordion-collapse collapse show" aria-labelledby="faq1" data-bs-parent="#faqAccordion">
                <div class="accordion-body">
                    Consultez notre <a href="{{ route('pages.guides.mattress') }}">guide d'achat matelas</a> pour trouver le niveau de fermeté et les dimensions adaptés.
                </div>
            </div>
        </div>

        <div class="accordion-item">
            <h2 class="accordion-header" id="faq2">
                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#faqCollapse2" aria-expanded="false" aria-controls="faqCollapse2">
                    Quels sont les moyens de contact ?
                </button>
            </h2>
            <div id="faqCollapse2" class="accordion-collapse collapse" aria-labelledby="faq2" data-bs-parent="#faqAccordion">
                <div class="accordion-body">
                    Vous pouvez nous joindre via la page <a href="{{ route('pages.contact') }}">Contact</a> ou par email à <a href="mailto:contact@mobilier-addict.com">contact@mobilier-addict.com</a>.
                </div>
            </div>
        </div>

        <div class="accordion-item">
            <h2 class="accordion-header" id="faq3">
                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#faqCollapse3" aria-expanded="false" aria-controls="faqCollapse3">
                    Comment suivre ma commande ?
                </button>
            </h2>
            <div id="faqCollapse3" class="accordion-collapse collapse" aria-labelledby="faq3" data-bs-parent="#faqAccordion">
                <div class="accordion-body">
                    Si vous avez un numéro de commande, contactez le <a href="{{ route('pages.customer-service') }}">service client</a> pour obtenir le suivi.
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
