        <section class="best-modern" aria-label="Nos meilleurs produits">
            <div class="container">
                <div class="best-modern__header">
                    <h2 class="best-modern__title">Découvrez Nos Best-Sellers</h2>
                    <p class="best-modern__subtitle">Les produits préférés de nos clients, qualité garantie</p>
                </div>

                <div class="best-modern__grid">
                    @forelse(($favoriteProducts ?? collect()) as $product)
                        <article class="product-card" aria-label="{{ $product->name }}">
                            @if(!empty($product->discount_percent) && (int) $product->discount_percent > 0)
                                <div class="product-card__badge">-{{ (int) $product->discount_percent }}%</div>
                            @elseif(!empty($product->badge_type) && $product->badge_type === 'new')
                                <div class="product-card__badge product-card__badge--new">NEW</div>
                            @elseif(!empty($product->badge_type) && $product->badge_type === 'hot')
                                <div class="product-card__badge product-card__badge--hot">HOT</div>
                            @endif

                            <a href="{{ $product->slug ? route('product.show', $product->slug) : route('demo.product') }}" style="text-decoration:none;color:inherit">
                                <div class="product-card__media">
                                    <img src="{{ !empty($product->image) ? asset($product->image) : 'https://via.placeholder.com/400x400?text=Produit' }}" alt="{{ $product->name }}" loading="lazy" />
                                </div>
                            </a>
                            <div class="product-card__body">
                                <a href="{{ $product->slug ? route('product.show', $product->slug) : route('demo.product') }}" style="text-decoration:none;color:inherit">
                                    <h3 class="product-card__name">{{ $product->name }}</h3>
                                </a>
                                <div class="product-card__footer">
                                    <div class="product-card__prices">
                                        <span class="product-card__price">{{ $product->formatted_price }}</span>
                                        @if(!empty($product->formatted_old_price))
                                            <span class="product-card__old">{{ $product->formatted_old_price }}</span>
                                        @endif
                                    </div>
                                </div>
                                <form action="{{ route('cart.add') }}" method="POST" class="product-card__cta" style="margin:0">
                                    @csrf
                                    <input type="hidden" name="product_id" value="{{ $product->id }}">
                                    <input type="hidden" name="quantity" value="1">
                                    <button class="product-card__buy" type="submit">Ajouter au panier</button>
                                </form>
                            </div>
                        </article>
                    @empty
                    @endforelse
                </div>
            </div>
        </section>
