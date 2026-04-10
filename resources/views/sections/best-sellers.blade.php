        <section class="best-modern" aria-label="Nos meilleurs produits">
            <div class="best-modern__bg"></div>
            <div class="container">
                <div class="best-modern__header">
                    <span class="best-modern__badge">Best-Sellers</span>
                    <h2 class="best-modern__title">Les préférés de nos clients</h2>
                    <p class="best-modern__subtitle">Qualité premium, satisfaction garantie, livraison rapide</p>
                </div>

                @php
                    $featured = ($favoriteProducts ?? collect())->first();
                    $others = ($favoriteProducts ?? collect())->slice(1)->take(3);
                @endphp

                <div class="best-modern__layout">
                    @if($featured)
                        <article class="best-modern__hero" aria-label="{{ $featured->name }}">
                            @if(!empty($featured->discount_percent) && (int) $featured->discount_percent > 0)
                                <div class="best-modern__hero-badge">-{{ (int) $featured->discount_percent }}%</div>
                            @elseif(!empty($featured->badge_type) && $featured->badge_type === 'new')
                                <div class="best-modern__hero-badge best-modern__hero-badge--new">NEW</div>
                            @elseif(!empty($featured->badge_type) && $featured->badge_type === 'hot')
                                <div class="best-modern__hero-badge best-modern__hero-badge--hot">HOT</div>
                            @endif

                            <div class="best-modern__hero-media">
                                <img src="@image_url($featured->image)" alt="{{ $featured->name }}" loading="eager" />
                            </div>
                            <div class="best-modern__hero-content">
                                <div class="best-modern__hero-trust">
                                    <span class="best-modern__hero-trust-icon">★</span>
                                    <span class="best-modern__hero-trust-text">4.9/5</span>
                                    <span class="best-modern__hero-trust-count">(2.4k avis)</span>
                                </div>
                                <h3 class="best-modern__hero-name">{{ $featured->name }}</h3>
                                <div class="best-modern__hero-prices">
                                    <span class="best-modern__hero-price">{{ $featured->formatted_price }}</span>
                                    @if(!empty($featured->formatted_old_price))
                                        <span class="best-modern__hero-old">{{ $featured->formatted_old_price }}</span>
                                    @endif
                                </div>
                                <div class="best-modern__hero-actions">
                                    <a href="{{ $featured->slug ? route('product.show', $featured->slug) : route('demo.product') }}" class="best-modern__hero-cta best-modern__hero-cta--primary">
                                        Voir le produit
                                    </a>
                                    <form action="{{ route('cart.add') }}" method="POST" style="margin:0">
                                        @csrf
                                        <input type="hidden" name="product_id" value="{{ $featured->id }}">
                                        <input type="hidden" name="quantity" value="1">
                                        <button class="best-modern__hero-cta best-modern__hero-cta--secondary" type="submit">
                                            <span aria-hidden="true">+</span> Panier
                                        </button>
                                    </form>
                                </div>
                            </div>
                        </article>
                    @endif

                    <div class="best-modern__list">
                        @forelse($others as $product)
                            <article class="best-modern__card" aria-label="{{ $product->name }}">
                                @if(!empty($product->discount_percent) && (int) $product->discount_percent > 0)
                                    <div class="best-modern__card-badge">-{{ (int) $product->discount_percent }}%</div>
                                @elseif(!empty($product->badge_type) && $product->badge_type === 'new')
                                    <div class="best-modern__card-badge best-modern__card-badge--new">NEW</div>
                                @elseif(!empty($product->badge_type) && $product->badge_type === 'hot')
                                    <div class="best-modern__card-badge best-modern__card-badge--hot">HOT</div>
                                @endif

                                <a href="{{ $product->slug ? route('product.show', $product->slug) : route('demo.product') }}" class="best-modern__card-media">
                                    <img src="@image_url($product->image)" alt="{{ $product->name }}" loading="lazy" />
                                </a>
                                <div class="best-modern__card-body">
                                    <h3 class="best-modern__card-name">{{ $product->name }}</h3>
                                    <div class="best-modern__card-prices">
                                        <span class="best-modern__card-price">{{ $product->formatted_price }}</span>
                                        @if(!empty($product->formatted_old_price))
                                            <span class="best-modern__card-old">{{ $product->formatted_old_price }}</span>
                                        @endif
                                    </div>
                                    <form action="{{ route('cart.add') }}" method="POST" style="margin:0">
                                        @csrf
                                        <input type="hidden" name="product_id" value="{{ $product->id }}">
                                        <input type="hidden" name="quantity" value="1">
                                        <button class="best-modern__card-cta" type="submit">Ajouter</button>
                                    </form>
                                </div>
                            </article>
                        @empty
                        @endforelse
                    </div>
                </div>
            </div>
        </section>
