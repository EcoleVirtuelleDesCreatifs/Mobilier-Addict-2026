@extends('layouts.front')

@section('title', 'B2B - Achats en Gros')

@section('content')
<section class="b2b-hero" style="background: linear-gradient(135deg, #0f172a, #1e293b); padding: 100px 0 70px; color: #fff;">
    <div class="container">
        <div class="text-center">
            <h1 style="font-size: 3rem; font-weight: 950; margin-bottom: 20px;">Espace B2B</h1>
            <p style="font-size: 1.25rem; opacity: 0.9; max-width: 600px; margin: 0 auto;">
                Achetez en gros nos matelas pour votre entreprise. Sélectionnez une catégorie pour commander un minimum de 5 produits.
            </p>
        </div>
    </div>
</section>

<section class="b2b-categories" style="padding: 80px 0; background: #f8fafc;">
    <div class="container">
        <div class="row">
            @foreach($categories as $category)
                <div class="col-md-6 col-lg-3 mb-4">
                    <a href="{{ route('b2b.category', $category->key) }}" class="text-decoration-none">
                        <div class="b2b-category-card" style="background: #fff; border-radius: 20px; overflow: hidden; box-shadow: 0 4px 20px rgba(0,0,0,0.08); transition: transform 0.3s ease, box-shadow 0.3s ease; height: 100%;">
                            <div style="height: 180px; background: {{ $category->color }}; display: flex; align-items: center; justify-content: center; position: relative;">
                                <span style="font-size: 4rem; font-weight: 950; color: #fff;">{{ $category->name[0] }}</span>
                                <div style="position: absolute; bottom: 16px; right: 16px; background: rgba(255,255,255,0.95); padding: 8px 16px; border-radius: 50px; font-weight: 900; font-size: 0.875rem; color: #1e293b; box-shadow: 0 2px 10px rgba(0,0,0,0.1);">
                                    Min. {{ $category->min_products }} produits
                                </div>
                            </div>
                            <div style="padding: 24px;">
                                <h3 style="font-size: 1.5rem; font-weight: 950; color: #1e293b; margin: 0 0 8px;">{{ $category->name }}</h3>
                                <p style="font-size: 0.9375rem; color: #64748b; margin: 0;">{{ $category->description }}</p>
                            </div>
                        </div>
                    </a>
                </div>
            @endforeach
        </div>
    </div>
</section>

<style>
.b2b-category-card:hover {
    transform: translateY(-8px);
    box-shadow: 0 12px 40px rgba(0,0,0,0.15);
}
</style>
@endsection
