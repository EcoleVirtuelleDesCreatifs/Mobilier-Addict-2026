@extends('layouts.front')

@section('title', 'Contact')
@section('meta_description', "Contactez Mobilier Addict : nous sommes disponibles pour vous aider avant, pendant et après votre achat.")

@section('content')
<div class="container py-5">
    <h1 class="mb-3">Contactez-nous</h1>
    <p class="text-muted">Une question sur un produit, une commande ou la livraison ? Écrivez-nous, nous vous répondrons au plus vite.</p>

    <div class="row g-4 mt-1">
        <div class="col-12 col-md-6">
            <div class="p-4 border rounded-4 h-100">
                <h2 class="h5">Coordonnées</h2>
                <p class="mb-1">📍 Abidjan, Côte d'Ivoire</p>
                <p class="mb-1">📞 +225 0799140356</p>
                <p class="mb-0">✉️ contact@mobilier-addict.com</p>
            </div>
        </div>
        <div class="col-12 col-md-6">
            <div class="p-4 border rounded-4 h-100">
                <h2 class="h5">Horaires</h2>
                <p class="mb-0">🕐 Lun-Sam : 9h - 19h</p>
            </div>
        </div>
    </div>
</div>
@endsection
