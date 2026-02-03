        <section class="best-modern" aria-label="Nos meilleurs produits">
            <div class="container">
                <div class="best-modern__header">
                    <h2 class="best-modern__title">Découvrez Nos Best-Sellers</h2>
                    <p class="best-modern__subtitle">Les produits préférés de nos clients, qualité garantie</p>
                </div>

                <div class="best-modern__grid">
                    @forelse(($favoriteProducts ?? collect()) as $product)
                        <a href="{{ $product->slug ? route('product.show', $product->slug) : route('demo.product') }}" class="product-card">
                            @if(!empty($product->discount_percent) && (int) $product->discount_percent > 0)
                                <div class="product-card__badge">-{{ (int) $product->discount_percent }}%</div>
                            @elseif(!empty($product->badge_type) && $product->badge_type === 'new')
                                <div class="product-card__badge product-card__badge--new">NEW</div>
                            @elseif(!empty($product->badge_type) && $product->badge_type === 'hot')
                                <div class="product-card__badge product-card__badge--hot">HOT</div>
                            @endif

                            <div class="product-card__media">
                                <img src="{{ !empty($product->image) ? asset($product->image) : 'https://via.placeholder.com/400x400?text=Produit' }}" alt="{{ $product->name }}" loading="lazy" />
                            </div>
                            <div class="product-card__body">
                                <h3 class="product-card__name">{{ $product->name }}</h3>
                                <div class="product-card__footer">
                                    <div class="product-card__prices">
                                        <span class="product-card__price">{{ $product->formatted_price }}</span>
                                        @if(!empty($product->formatted_old_price))
                                            <span class="product-card__old">{{ $product->formatted_old_price }}</span>
                                        @endif
                                    </div>
                                    <span class="product-card__btn">
                                        <svg viewBox="0 0 24 24" width="18" height="18"><path d="M17 18c-1.1 0-1.99.9-1.99 2s.89 2 1.99 2 2-.9 2-2-.9-2-2-2zM7 18c-1.1 0-1.99.9-1.99 2S5.9 22 7 22s2-.9 2-2-.9-2-2-2zm0-3l1.1-2h7.45c.75 0 1.41-.41 1.75-1.03L21.7 4H5.21l-.94-2H1v2h2l3.6 7.59L3.62 17H19v-2H7z" fill="currentColor"/></svg>
                                    </span>
                                </div>
                            </div>
                        </a>
                    @empty
                    @endforelse
                </div>
            </div>
        </section>
