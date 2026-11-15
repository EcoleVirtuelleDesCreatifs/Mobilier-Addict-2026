@php
    $activeVariants = $product->variants->where('is_active', true)->sortBy('price');
    $variant = $product->preferredVariant();
    $price = (float) ($variant?->price ?? $product->price);
    $places = $variant?->places ? rtrim(rtrim(number_format((float) $variant->places, 1, '.', ''), '0'), '.') . ((float) $variant->places === 1.0 ? ' place' : ' places') : null;
    $label = collect($variant ? [$places, $variant->thickness_cm ? 'Ép. ' . $variant->thickness_cm . ' cm' : null, $product->firmness] : [$product->size, $product->dimensions, $product->firmness])->filter()->unique()->join(' · ');
    $available = $product->isInStock($variant);
    $categoryLabel = mb_strtolower(($product->category?->slug ?? '') . ' ' . ($product->category?->name ?? ''));
    $needsOptions = $activeVariants->count() > 1 || count((array) $product->available_colors) > 1 || str_contains($categoryLabel, 'drap') || str_contains($categoryLabel, 'taie');
    $optionsUrl = route('product.show', $product->slug) . '#product-options';
@endphp
<article class="p">
    <div class="pic">
        <a href="{{ route('product.show', $product->slug) }}"><img src="{{ image_url($product->image) }}" alt="{{ $product->name }}" width="600" height="600" loading="lazy" decoding="async"></a>
        @if($product->badge)<span class="offer">{{ $product->badge }}</span>@endif
        @include('maquette.includes.favorite-button')
    </div>
    <div class="info"><div><h3><a href="{{ route('product.show', $product->slug) }}">{{ $product->name }}</a></h3>@if($label)<p class="spec">{{ $label }}</p>@endif @unless($available)<p class="spec">Sur commande</p>@endunless</div><div class="price">@if($price > 0){{ number_format($price, 0, ',', ' ') }} <small>FCFA</small>@else Sur devis @endif</div></div>
    @if($available && $price > 0 && !$needsOptions)
        <form class="ma27-quick-add ma27-card-actions" action="{{ route('cart.add') }}" method="POST">
            @csrf
            <input type="hidden" name="product_id" value="{{ $product->id }}">
            @if($variant)<input type="hidden" name="product_variant_id" value="{{ $variant->id }}">@endif
            <input type="hidden" name="quantity" value="1">
            <button type="submit" class="ma27-card-buy" name="redirect_to" value="shipping" aria-label="Commander directement {{ $product->name }}">Commander directement</button>
            <button type="submit" class="ma27-card-add" aria-label="Ajouter {{ $product->name }} au panier">Ajouter au panier</button>
        </form>
    @elseif($available && $price > 0)
        <div class="ma27-card-actions">
            <a class="ma27-card-buy" href="{{ $optionsUrl }}" aria-label="Choisir les options et commander {{ $product->name }}">Commander directement</a>
            <a class="ma27-card-add" href="{{ $optionsUrl }}" aria-label="Voir les options de {{ $product->name }} avant l’ajout au panier">Ajouter au panier</a>
            <span class="ma27-card-options">Choisissez vos options sur la fiche.</span>
        </div>
    @else
        <div class="ma27-card-actions">
            <button class="ma27-card-buy" type="button" disabled>Commander directement</button>
            <button class="ma27-card-add" type="button" disabled>Ajouter au panier</button>
        </div>
    @endif
</article>
