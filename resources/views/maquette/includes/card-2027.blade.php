@php
    $variant = $product->variants->where('is_active', true)->sortBy('price')->first();
    $price = (float) ($variant?->price ?? $product->price);
    $places = $variant?->places ? rtrim(rtrim(number_format((float) $variant->places, 1, '.', ''), '0'), '.') . ((float) $variant->places === 1.0 ? ' place' : ' places') : null;
    $label = collect($variant ? [$places, $variant->thickness_cm ? 'Ép. ' . $variant->thickness_cm . ' cm' : null, $product->firmness] : [$product->size, $product->dimensions, $product->firmness])->filter()->unique()->join(' · ');
    $available = (int) $product->stock > 0;
    $needsOptions = str_contains(mb_strtolower($product->category?->slug ?? ''), 'drap') || str_contains(mb_strtolower($product->category?->slug ?? ''), 'taie');
@endphp
<article class="p">
    <div class="pic">
        <a href="{{ route('product.show', $product->slug) }}"><img src="{{ image_url($product->image) }}" alt="{{ $product->name }}" width="600" height="600" loading="lazy" decoding="async"></a>
        @if($product->badge)<span class="offer">{{ $product->badge }}</span>@endif
        @include('maquette.includes.favorite-button')
        @if($available && $price > 0 && !$needsOptions)
            <form class="ma27-quick-add" action="{{ route('cart.add') }}" method="POST">
                @csrf
                <input type="hidden" name="product_id" value="{{ $product->id }}">
                @if($variant)<input type="hidden" name="product_variant_id" value="{{ $variant->id }}">@endif
                <input type="hidden" name="quantity" value="1">
                <button type="submit" class="plus" aria-label="Ajouter {{ $product->name }} au panier">+</button>
            </form>
        @else
            <a class="plus" href="{{ route('product.show', $product->slug) }}" aria-label="Voir les options de {{ $product->name }}">→</a>
        @endif
    </div>
    <div class="info"><div><h3><a href="{{ route('product.show', $product->slug) }}">{{ $product->name }}</a></h3>@if($label)<p class="spec">{{ $label }}</p>@endif @unless($available)<p class="spec">Sur commande</p>@endunless</div><div class="price">@if($price > 0){{ number_format($price, 0, ',', ' ') }} <small>FCFA</small>@else Sur devis @endif</div></div>
</article>
