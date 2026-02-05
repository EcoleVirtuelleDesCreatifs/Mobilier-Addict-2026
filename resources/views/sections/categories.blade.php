        <section class="categories" aria-label="Nos univers">
            <div class="container">
                @php($section = $homeSections['categories'] ?? null)

                <div class="categories__header">
                    <span class="categories__badge">{{ trim(($section?->badge_icon ? $section->badge_icon . ' ' : '') . ($section?->badge ?? '')) }}</span>
                    <h2 class="categories__title">{{ $section?->title ?? 'Trouvez Votre Bonheur' }}</h2>
                </div>
                <div class="categories__grid">
                    @if($section && $section->categories->count())
                        @foreach($section->categories as $i => $category)
                            @php($cardClass = $i === 0 ? 'cat-card cat-card--large' : ($i === 3 ? 'cat-card cat-card--wide' : 'cat-card'))
                            <a class="{{ $cardClass }}" href="{{ route('univers.show', $category->slug) }}">
                                <img src="{{ asset($category->image) }}" alt="{{ $category->image_alt ?: $category->name }}" loading="lazy" />
                                <div class="cat-card__overlay">
                                    <span class="cat-card__count">{{ $category->products_rel_count ?? $category->products_count ?? 0 }} produits</span>
                                    <h3 class="cat-card__title">{{ $category->name }}</h3>
                                    @if($i === 0 || $i === 3)
                                        <p class="cat-card__desc">{{ $category->description }}</p>
                                        <span class="cat-card__cta">Explorer <svg viewBox="0 0 24 24" width="16" height="16"><path d="M5 12h14M12 5l7 7-7 7" stroke="currentColor" stroke-width="2" fill="none" stroke-linecap="round"/></svg></span>
                                    @else
                                        <span class="cat-card__cta">Voir →</span>
                                    @endif
                                </div>
                            </a>
                        @endforeach
                    @else
                        <a class="cat-card cat-card--large" href="{{ route('univers.show', 'matelas') }}">
                            <img src="https://images.unsplash.com/photo-1631049307264-da0ec9d70304?w=800&h=600&fit=crop" alt="Matelas" loading="lazy" />
                            <div class="cat-card__overlay">
                                <span class="cat-card__count">48 produits</span>
                                <h3 class="cat-card__title">Matelas</h3>
                                <p class="cat-card__desc">Du ferme au moelleux, trouvez votre équilibre parfait</p>
                                <span class="cat-card__cta">Explorer <svg viewBox="0 0 24 24" width="16" height="16"><path d="M5 12h14M12 5l7 7-7 7" stroke="currentColor" stroke-width="2" fill="none" stroke-linecap="round"/></svg></span>
                            </div>
                        </a>
                        <a class="cat-card" href="{{ route('univers.show', 'oreillers') }}">
                            <img src="https://images.unsplash.com/photo-1584100936595-c0654b55a2e2?w=500&h=400&fit=crop" alt="Oreillers" loading="lazy" />
                            <div class="cat-card__overlay">
                                <span class="cat-card__count">24 produits</span>
                                <h3 class="cat-card__title">Oreillers</h3>
                                <span class="cat-card__cta">Voir →</span>
                            </div>
                        </a>
                        <a class="cat-card" href="{{ route('univers.show', 'draps-couettes') }}">
                            <img src="https://images.unsplash.com/photo-1522771739844-6a9f6d5f14af?w=500&h=400&fit=crop" alt="Draps & Couettes" loading="lazy" />
                            <div class="cat-card__overlay">
                                <span class="cat-card__count">36 produits</span>
                                <h3 class="cat-card__title">Draps & Couettes</h3>
                                <span class="cat-card__cta">Voir →</span>
                            </div>
                        </a>
                        <a class="cat-card cat-card--wide" href="{{ route('univers.show', 'lits-sommiers') }}">
                            <img src="https://images.unsplash.com/photo-1505693416388-ac5ce068fe85?w=900&h=400&fit=crop" alt="Lits" loading="lazy" />
                            <div class="cat-card__overlay">
                                <span class="cat-card__count">18 produits</span>
                                <h3 class="cat-card__title">Lits & Sommiers</h3>
                                <p class="cat-card__desc">Structures élégantes pour sublimer votre chambre</p>
                                <span class="cat-card__cta">Découvrir la collection <svg viewBox="0 0 24 24" width="16" height="16"><path d="M5 12h14M12 5l7 7-7 7" stroke="currentColor" stroke-width="2" fill="none" stroke-linecap="round"/></svg></span>
                            </div>
                        </a>
                    @endif
                </div>

                @if(($mattressProducts ?? collect())->count())
                    <div class="best-modern__header" style="margin-top: 40px;">
                        <h2 class="best-modern__title">Nos Matelas</h2>
                        <p class="best-modern__subtitle">Tous les produits des catégories Matelas — découvrez la sélection complète</p>
                    </div>

                    <div class="best-modern__grid">
                        @foreach($mattressProducts as $product)
                            <a href="{{ $product->slug ? route('product.show', $product->slug) : route('demo.product') }}" class="product-card">
                                @if(!empty($product->discount_percent) && (int) $product->discount_percent > 0)
                                    <div class="product-card__badge">-{{ (int) $product->discount_percent }}%</div>
                                @elseif(!empty($product->badge_type) && $product->badge_type === 'new')
                                    <div class="product-card__badge product-card__badge--new">NEW</div>
                                @elseif(!empty($product->badge_type) && $product->badge_type === 'hot')
                                    <div class="product-card__badge product-card__badge--hot">HOT</div>
                                @endif

                                <div class="product-card__media">
                                    @if($product->image)
                                        <img src="@image_url($product->image)" alt="{{ $product->name }}" loading="lazy" />
                                    @else
                                        <img src="https://via.placeholder.com/400x400?text=Produit" alt="{{ $product->name }}" loading="lazy" />
                                    @endif
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
                        @endforeach
                    </div>
                @endif
            </div>
        </section>
