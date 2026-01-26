@extends('layouts.front')

@section('title', 'Service client')
@section('meta_description', "Service client Mobilier Addict : assistance, suivi de commande, conseils et support.")

@section('content')
<div class="container py-5">
    <h1 class="mb-3">Service client</h1>
    <p class="text-muted">Nous sommes là pour vous accompagner : choix produit, disponibilité, suivi de commande, retours.</p>

    <div class="row g-4 mt-1">
        <div class="col-12 col-lg-8">
            <div class="p-4 border rounded-4">
                <h2 class="h5">Besoin d’aide ?</h2>
                <p>Écrivez-nous à <a href="mailto:contact@mobilier-addict.com">contact@mobilier-addict.com</a> ou appelez le <a href="tel:+2250799140356">+225 0799140356</a>.</p>
                <p class="mb-0">Vous pouvez aussi consulter la <a href="{{ route('pages.faq') }}">FAQ</a> et nos <a href="{{ route('pages.guides.mattress') }}">guides</a>.</p>
            </div>
        </div>
        <div class="col-12 col-lg-4">
            <div class="p-4 border rounded-4">
                <h2 class="h5">Horaires</h2>
                <p class="mb-0">Lun-Sam : 9h - 19h</p>
            </div>
        </div>
    </div>
</div>
@endsection
