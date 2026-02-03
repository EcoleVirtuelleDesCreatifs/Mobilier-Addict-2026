@extends('layouts.front')

@section('title', 'Recherche')
@section('meta_description', 'Recherche produits sur Mobilier Addict')

@section('content')
<section class="collection" aria-label="Résultats de recherche">
    <div class="container">
        <div class="collection__header">
            <div class="collection__intro">
                <span class="collection__badge">🔎 Recherche</span>
                <h1 class="collection__title">Résultats</h1>
                @if(!empty($q))
                    <p class="collection__subtitle">Pour : <strong>{{ $q }}</strong></p>
                @else
                    <p class="collection__subtitle">Tapez un mot-clé pour rechercher un produit.</p>
                @endif
            </div>
        </div>

        @if(!empty($q) && ($products ?? collect())->isEmpty())
            <div style="padding:24px;border:1px solid #e2e8f0;border-radius:16px;background:#fff">
                Aucun produit trouvé.
            </div>
        @endif

        <div class="collection__grid">
            @foreach(($products ?? collect()) as $product)
                @php
                    $isFeatured = (bool) ($product->is_bestseller ?? false);
                    $tag = $product->firmness ? strtoupper(str_replace('_', '-', $product->firmness)) : null;
                    $specsParts = [];
                    if (!empty($product->size)) $specsParts[] = $product->size;
                    if (!empty($product->thickness)) $specsParts[] = 'Ép. ' . $product->thickness;
                    if (!empty($product->material)) $specsParts[] = $product->material;
                    $specs = implode(' • ', $specsParts);
                @endphp

                <article class="collection-card{{ $isFeatured ? ' collection-card--featured' : '' }}">
                    @if($isFeatured)
                        <div class="collection-card__badge">Best Seller</div>
                    @endif

                    <a href="{{ route('product.show', $product->slug) }}" style="text-decoration:none;color:inherit">
                        <div class="collection-card__media">
                            <img src="{{ $product->image ? asset($product->image) : 'https://images.unsplash.com/photo-1631049307264-da0ec9d70304?w=500&h=500&fit=crop' }}" alt="{{ $product->name }}" loading="lazy" />
                            @if($tag)
                                <span class="collection-card__tag">{{ $tag }}</span>
                            @endif
                        </div>
                    </a>

                    <div class="collection-card__body">
                        <div class="collection-card__rating">
                            <span class="collection-card__stars">★★★★★</span>
                            <span class="collection-card__reviews">({{ (int) ($product->reviews_count ?? 0) }} avis)</span>
                        </div>

                        <a href="{{ route('product.show', $product->slug) }}" style="text-decoration:none;color:inherit">
                            <h2 class="collection-card__name">{{ $product->name }}</h2>
                        </a>

                        @if($specs)
                            <p class="collection-card__specs">{{ $specs }}</p>
                        @else
                            <p class="collection-card__specs">&nbsp;</p>
                        @endif

                        <div class="collection-card__footer">
                            <span class="collection-card__price">{{ number_format((float) $product->price, 0, ',', '.') }}<small>F</small></span>

                            <form action="{{ route('cart.add') }}" method="POST" style="margin:0">
                                @csrf
                                <input type="hidden" name="product_id" value="{{ $product->id }}">
                                <input type="hidden" name="quantity" value="1">
                                <button class="collection-card__btn" type="submit" aria-label="Ajouter au panier">
                                    <svg viewBox="0 0 24 24" width="18" height="18"><path d="M12 5v14M5 12h14" stroke="currentColor" stroke-width="2" fill="none" stroke-linecap="round"/></svg>
                                </button>
                            </form>
                        </div>
                    </div>
                </article>
            @endforeach
        </div>
    </div>
</section>
@endsection
