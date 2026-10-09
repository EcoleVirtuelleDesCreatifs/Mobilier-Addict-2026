        <section class="best-sellers reveal is-visible" aria-label="Nos meilleurs produits">
    <div class="section-header">
        <span class="section-badge">BEST-SELLERS</span>
        <h2>Les préférés de nos clients</h2>
        <p>Qualité premium, confort durable, satisfaction garantie</p>
    </div>

    @php
        $allProducts = ($favoriteProducts ?? collect());
    @endphp

    <div class="products-grid">
        @foreach($allProducts as $product)
            <article class="product-card reveal is-visible" aria-label="{{ $product->name }}">
                @if(!empty($product->discount_percent) && (int) $product->discount_percent > 0)
                    <span class="discount">-{{ (int) $product->discount_percent }}%</span>
                @endif

                <a href="{{ $product->slug ? route('product.show', $product->slug) : route('demo.product') }}" class="product-image">
                    <img src="@image_url($product->image)" alt="{{ $product->name }}" loading="lazy">
                </a>
                <div class="product-info">
                    <h3>{{ $product->name }}</h3>
                    <p>{{ strip_tags(Str::limit($product->description ?? '', 80)) }}</p>
                    <div class="price">
                        <strong>{{ $product->formatted_price }}</strong>
                        @if(!empty($product->formatted_old_price))
                            <span>{{ $product->formatted_old_price }}</span>
                        @endif
                    </div>
                    <a href="{{ $product->slug ? route('product.show', $product->slug) : route('demo.product') }}" style="text-decoration:none">
                        <button type="button">Voir le produit</button>
                    </a>
                </div>
            </article>
        @endforeach
    </div>
</section>
