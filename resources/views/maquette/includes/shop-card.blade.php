@php
    $galleryImages = is_array($product->gallery) ? $product->gallery : [];
    $secondaryImage = !empty($galleryImages) ? $galleryImages[0] : $product->image;
    $discount = null;
    $defaultVariant = $product->variants->sortBy('price')->first();
    $displayPrice = $defaultVariant?->price ?? $product->price;
    if ($product->old_price && $product->old_price > $displayPrice) {
        $discount = round((($product->old_price - $displayPrice) / $product->old_price) * 100);
    }
    $variantLabel = null;
    if ($defaultVariant) {
        $parts = array_filter([
            $defaultVariant->places ? str_pad((string) $defaultVariant->places, 2, '0', STR_PAD_LEFT) . ' Places' : null,
            $defaultVariant->size ?? null,
            $defaultVariant->dimensions ?? null,
        ]);
        $variantLabel = implode(' — ', $parts);
    }
    $variantLabel = $variantLabel ?: ($product->size ?: $product->dimensions);
    $inStock = (int) $product->stock > 0;
@endphp
<div class="mp-card">
    <div class="mp-card-media">
        <a class="hover-switch" href="{{ route('product.show', $product->slug) }}">
            <img loading="lazy" decoding="async" class="secondary-img" src="@image_url($secondaryImage)" alt="{{ $product->name }}">
            <img loading="lazy" decoding="async" class="primary-img" src="@image_url($product->image)" alt="{{ $product->name }}">
        </a>
        @if($discount)
            <span class="mp-badge">-{{ $discount }}%</span>
        @elseif($product->badge)
            <span class="mp-badge">{{ $product->badge }}</span>
        @endif
        <button type="button" class="mp-wish" aria-label="Ajouter {{ $product->name }} aux favoris">
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><path d="M19 14c1.49-1.46 3-3.21 3-5.5A5.5 5.5 0 0 0 16.5 3c-1.76 0-3 .5-4.5 2-1.5-1.5-2.74-2-4.5-2A5.5 5.5 0 0 0 2 8.5c0 2.3 1.5 4.05 3 5.5l7 7Z"/></svg>
        </button>
    </div>
    <div class="mp-card-body">
        <h3 class="mp-card-name">
            <a href="{{ route('product.show', $product->slug) }}">{{ $product->name }}</a>
        </h3>
        @if($variantLabel)
            <p class="mp-card-variant">{{ $variantLabel }}</p>
        @endif
        <div class="mp-card-price-row">
            <span class="mp-price">{{ number_format((float) $displayPrice, 0, ',', ' ') }} FCFA</span>
            @if($discount)
                <span class="mp-price-compare">{{ number_format((float) $product->old_price, 0, ',', ' ') }} FCFA</span>
            @endif
            <span class="mp-stock {{ $inStock ? 'is-in' : 'is-out' }}">{{ $inStock ? 'En stock' : 'Rupture' }}</span>
        </div>
        <form class="mp-form" action="{{ route('cart.add') }}" method="POST">
            @csrf
            <input type="hidden" name="product_id" value="{{ $product->id }}">
            @if($defaultVariant)
                <input type="hidden" name="product_variant_id" value="{{ $defaultVariant->id }}">
            @endif
            <input type="hidden" name="redirect_to" value="">
            <div class="mp-card-actions">
                <div class="mp-qty">
                    <button type="button" class="mp-qty-btn" data-qty-step="-1" aria-label="Diminuer la quantité">−</button>
                    <input class="mp-qty-input" type="text" name="quantity" value="1" inputmode="numeric" aria-label="Quantité">
                    <button type="button" class="mp-qty-btn" data-qty-step="1" aria-label="Augmenter la quantité">+</button>
                </div>
                <button type="submit" class="mp-add"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.9" stroke-linecap="round" stroke-linejoin="round" width="15" height="15" aria-hidden="true"><circle cx="9" cy="20" r="1.6"/><circle cx="17" cy="20" r="1.6"/><path d="M2.5 3.5h2l2.6 11.4a1.6 1.6 0 0 0 1.6 1.3h7.9a1.6 1.6 0 0 0 1.6-1.3L20.5 7H5.2"/></svg>Ajouter au panier</button>
            </div>
            <button type="submit" class="mp-buy" data-redirect="shipping">Commander directement</button>
        </form>
    </div>
</div>
@once
<script>
    document.addEventListener('click', function (e) {
        var stepBtn = e.target.closest('[data-qty-step]');
        if (stepBtn) {
            var input = stepBtn.closest('.mp-qty').querySelector('.mp-qty-input');
            var next = (parseInt(input.value, 10) || 1) + parseInt(stepBtn.dataset.qtyStep, 10);
            input.value = Math.min(10, Math.max(1, next));
            return;
        }
        var buyBtn = e.target.closest('.mp-buy[data-redirect]');
        if (buyBtn) {
            buyBtn.form.querySelector('[name="redirect_to"]').value = buyBtn.dataset.redirect;
        }
    });
</script>
@endonce
