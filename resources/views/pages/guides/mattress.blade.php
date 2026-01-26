@extends('layouts.front')

@section('title', "Guide d'achat matelas")
@section('meta_description', "Guide d'achat matelas : fermeté, dimensions et conseils pour choisir le bon matelas.")

@section('content')
<div class="container py-5">
    <h1 class="mb-3">Guide d'achat matelas</h1>
    <p class="text-muted">Les critères essentiels pour choisir un matelas adapté à votre confort.</p>

    <h2 class="h4 mt-4">1. La fermeté</h2>
    <p>Un matelas mi-ferme convient à la plupart des dormeurs. La fermeté idéale dépend de votre morphologie et de vos habitudes de sommeil.</p>

    <h2 class="h4 mt-4">2. Les dimensions</h2>
    <p>Choisissez des dimensions adaptées à votre espace et à votre confort : 140x190, 160x200, etc.</p>

    <h2 class="h4 mt-4">3. La ventilation &amp; l’hygiène</h2>
    <p class="mb-0">Pensez à ajouter une protection : <a href="{{ route('univers.show', ['slug' => 'protection']) }}">Protège-Matelas</a>.</p>
</div>
@endsection
