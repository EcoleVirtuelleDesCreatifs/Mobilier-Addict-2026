<section class="new-modern" aria-label="Nouveaux produits">
    <div class="container">
        <div class="new-modern__head">
            <div class="new-modern__head-text">
                <h2 class="new-modern__title">Nouveaux produits</h2>
                <p class="new-modern__subtitle">Découvrez les dernières nouveautés ajoutées à notre catalogue</p>
            </div>
        </div>

        <div class="new-modern__grid">
            @forelse(($newProducts ?? collect()) as $product)
                <article class="new-modern-card" aria-label="{{ $product->name }}">
                    @if(!empty($product->discount_percent) && (int) $product->discount_percent > 0)
                        <div class="new-modern-card__badge">-{{ (int) $product->discount_percent }}%</div>
                    @elseif(!empty($product->badge_type) && $product->badge_type === 'new')
                        <div class="new-modern-card__badge new-modern-card__badge--new">NEW</div>
                    @elseif(!empty($product->badge_type) && $product->badge_type === 'hot')
                        <div class="new-modern-card__badge new-modern-card__badge--hot">HOT</div>
                    @endif

                    <a class="new-modern-card__link" href="{{ $product->slug ? route('product.show', $product->slug) : route('demo.product') }}">
                        <div class="new-modern-card__media">
                            <img class="new-modern-card__img" src="@image_url($product->image)" alt="{{ $product->name }}" loading="lazy" />
                        </div>
                    </a>

                    <div class="new-modern-card__body">
                        <a class="new-modern-card__link" href="{{ $product->slug ? route('product.show', $product->slug) : route('demo.product') }}">
                            <h3 class="new-modern-card__name">{{ $product->name }}</h3>
                        </a>

                        <div class="new-modern-card__meta">
                            <div class="new-modern-card__prices">
                                <span class="new-modern-card__price">{{ $product->formatted_price }}</span>
                                @if(!empty($product->formatted_old_price))
                                    <span class="new-modern-card__old">{{ $product->formatted_old_price }}</span>
                                @endif
                            </div>
                        </div>

                        <form action="{{ route('cart.add') }}" method="POST" class="new-modern-card__cta" style="margin:0">
                            @csrf
                            <input type="hidden" name="product_id" value="{{ $product->id }}">
                            <input type="hidden" name="quantity" value="1">
                            <button class="new-modern-card__buy" type="submit">
                                <span>Ajouter au panier</span>
                                <span aria-hidden="true">→</span>
                            </button>
                        </form>
                    </div>
                </article>
            @empty
            @endforelse
        </div>

        <div class="new-modern__more">
            <a class="new-modern__more-btn" href="{{ route('nouveautes.index') }}">Voir plus de nouveau produit</a>
        </div>
    </div>
</section>
