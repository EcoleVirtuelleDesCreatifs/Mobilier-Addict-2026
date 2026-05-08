        <section class="mattress-section" id="collection" aria-label="Notre Collection">
    <div class="hero">
        <div class="hero-content">
            <span class="badge">🛏 Collection exclusive</span>
            <h1>Nos Matelas <span>d'Exception</span></h1>
            <p>Chaque matelas est une promesse de nuits inoubliables. Trouvez celui qui vous correspond.</p>
            <div class="features">
                <div>💎 <strong>Qualité Premium</strong><small>Matériaux haut de gamme</small></div>
                <div>🌙 <strong>Confort Absolu</strong><small>Soutien et douceur parfaits</small></div>
                <div>🛡 <strong>Garantie 10 Ans</strong><small>Sérénité et durabilité</small></div>
            </div>
        </div>
        <div class="hero-visual">
            <button>‹</button>
            <button>›</button>
        </div>
    </div>

    <div class="products-grid">
        @foreach(($collectionProducts ?? collect()) as $product)
            @php
                $isFeatured = (bool) ($product->is_bestseller ?? false);
                $specsParts = [];
                if (!empty($product->size)) $specsParts[] = $product->size;
                if (!empty($product->thickness)) $specsParts[] = 'Ép. ' . $product->thickness;
                $specs = implode(' • ', $specsParts);
            @endphp

            <div class="product-card">
                @if(!empty($product->discount_percent) && (int) $product->discount_percent > 0)
                    <span class="discount">-{{ (int) $product->discount_percent }}%</span>
                @elseif($isFeatured)
                    <span class="tag">BEST SELLER</span>
                @endif

                <img src="@image_url($product->image)" alt="{{ $product->name }}" loading="lazy">
                <h3>{{ $product->name }}</h3>
                <p>{{ $specs }}</p>
                <div class="price">
                    <strong>{{ $product->formatted_price }}</strong>
                    @if(!empty($product->formatted_old_price))
                        <span>{{ $product->formatted_old_price }}</span>
                    @endif
                </div>
                <form action="{{ route('cart.add') }}" method="POST" style="margin:0">
                    @csrf
                    <input type="hidden" name="product_id" value="{{ $product->id }}">
                    <input type="hidden" name="quantity" value="1">
                    <button class="add-btn{{ $isFeatured ? ' purple' : '' }}" type="submit">🛒 <span>+</span></button>
                </form>
            </div>
        @endforeach
    </div>

    <a href="{{ route('collection.index') }}" class="main-btn">Voir toute la collection →</a>
</section>
