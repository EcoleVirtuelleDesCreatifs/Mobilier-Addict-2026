<section class="electro" aria-label="Draps" style="background: {{ $homeSections['draps']?->background_color ?: 'linear-gradient(180deg, #f8fafc 0%, #eef2f7 100%)' }};">
    <div class="container">
        @php
            $section = $homeSections['draps'] ?? null;
            $badgeIcon = $section?->badge_icon ?: '🧺';
            $badge = $section?->badge ?: 'Draps';
            $title = $section?->title ?: 'Draps';
            $description = $section?->description;
            $sectionCover = $section?->cover_image ? image_url($section->cover_image) : null;
            $toImageUrl = function ($value) {
                if (!is_string($value) || trim($value) === '') {
                    return null;
                }
                $value = trim($value);
                if (preg_match('/^(https?:\/\/|\/\/|data:)/i', $value)) {
                    return $value;
                }
                return image_url($value);
            };
            $items = collect();

            if ($section && $section->relationLoaded('categories') && $section->categories->count()) {
                $categoriesItems = $section->categories
                    ->filter(fn ($c) => $c)
                    ->values();

                if ($categoriesItems->count() > 0) {
                    $items = $categoriesItems
                        ->map(function ($category, $index) use ($categoriesItems, $sectionCover, $toImageUrl) {
                            $wideIndex = $categoriesItems->count() >= 4 ? 3 : ($categoriesItems->count() - 1);

                            return [
                                'title' => $category->name,
                                'tag' => $category->products_rel_count ?? $category->products_count ?? null,
                                'image' => $toImageUrl($category->image) ?: $sectionCover,
                                'href' => route('univers.show', $category->slug),
                                'desc' => $category->description,
                                'hero' => $index === 0,
                                'wide' => $index === $wideIndex,
                            ];
                        })
                        ->values();
                }
            }

            if ($items->isEmpty()) {
                $items = collect(data_get($section, 'content.items', []))
                    ->filter(fn ($v) => is_array($v))
                    ->values();
            }

            if ($items->isEmpty()) {
                $items = collect([
                    [
                        'title' => 'Drap couleur unie ( Drap addict)',
                        'tag' => 'Drap',
                        'image' => 'https://images.unsplash.com/photo-1522771739844-6a9f6d5f14af?w=700&h=700&fit=crop',
                        'href' => route('univers.show', 'draps-couettes'),
                    ],
                    [
                        'title' => 'Drap avec motif (Fleurie)',
                        'tag' => 'Drap',
                        'image' => 'https://images.unsplash.com/photo-1616046229478-9901c5536a45?w=700&h=700&fit=crop',
                        'href' => route('univers.show', 'draps-couettes'),
                    ],
                    [
                        'title' => 'Drap en coton',
                        'tag' => 'Draps',
                        'image' => 'https://images.unsplash.com/photo-1560448204-603b3fc33ddc?w=1200&h=600&fit=crop',
                        'desc' => 'Nos Kits Draps et Taies',
                        'href' => route('univers.show', 'draps-couettes'),
                        'wide' => true,
                    ],
                    [
                        'title' => 'Draps',
                        'tag' => null,
                        'image' => 'https://images.unsplash.com/photo-1522771739844-6a9f6d5f14af?w=900&h=900&fit=crop',
                        'href' => route('univers.show', 'draps-couettes'),
                        'hero' => true,
                    ],
                ]);
            }

            $hero = $items->firstWhere('hero', true) ?? $items->get(3) ?? $items->first();
            $cards = $items->reject(fn ($it) => (bool) ($it['hero'] ?? false))->values();
            $card1 = $cards->get(0);
            $card2 = $cards->get(1);
            $wide = $cards->firstWhere('wide', true) ?? $cards->get(2);
            $heroList = collect(data_get($section, 'content.hero_list', []))
                ->filter(fn ($v) => is_string($v) && trim($v) !== '')
                ->values();
            if ($heroList->isEmpty()) {
                $heroList = $items
                    ->reject(fn ($it) => (bool) ($it['hero'] ?? false))
                    ->pluck('title')
                    ->filter()
                    ->take(4)
                    ->values();
            }
        @endphp

        <div class="electro__header">
            <span class="electro__badge">{{ $badgeIcon }} {{ $badge }}</span>
            <h2 class="electro__title">{{ $title }}</h2>
            @if($description)
                <p class="electro__desc">{{ $description }}</p>
            @endif
        </div>

        <div class="electro__grid">
            <a class="electro-card electro-card--large" href="{{ data_get($hero, 'href', route('univers.show', 'draps-couettes')) }}">
                <img src="{{ $toImageUrl(data_get($hero, 'image')) ?: $sectionCover ?: 'https://images.unsplash.com/photo-1522771739844-6a9f6d5f14af?w=900&h=900&fit=crop' }}" alt="{{ data_get($hero, 'title', 'Draps') }}" loading="lazy" />
                <div class="electro-card__overlay">
                    <span class="electro-card__count">{{ $heroList->count() }} modèles</span>
                    <h3 class="electro-card__title">{{ data_get($hero, 'title', strtoupper($title)) }}</h3>
                    @if(data_get($hero, 'desc'))
                        <p class="electro-card__desc">{{ data_get($hero, 'desc') }}</p>
                    @elseif($heroList->isNotEmpty())
                        <p class="electro-card__desc">{!! $heroList->map(fn ($t) => e($t))->implode('<br>') !!}</p>
                    @endif
                    <span class="electro-card__cta">Explorer <svg viewBox="0 0 24 24" width="16" height="16"><path d="M5 12h14M12 5l7 7-7 7" stroke="currentColor" stroke-width="2" fill="none" stroke-linecap="round"/></svg></span>
                </div>
            </a>

            @if($card1)
                <a class="electro-card" href="{{ data_get($card1, 'href', route('univers.show', 'draps-couettes')) }}">
                    <img src="{{ data_get($card1, 'image', 'https://images.unsplash.com/photo-1522771739844-6a9f6d5f14af?w=700&h=700&fit=crop') }}" alt="{{ data_get($card1, 'title', '') }}" loading="lazy" />
                    <div class="electro-card__overlay electro-card__overlay--gradient">
                        <span class="electro-card__count">{{ data_get($card1, 'tag', 'Drap') }}</span>
                        <h3 class="electro-card__title">{{ data_get($card1, 'title', '') }}</h3>
                        <span class="electro-card__cta">Voir →</span>
                    </div>
                </a>
            @endif

            @if($card2)
                <a class="electro-card" href="{{ data_get($card2, 'href', route('univers.show', 'draps-couettes')) }}">
                    <img src="{{ data_get($card2, 'image', 'https://images.unsplash.com/photo-1616046229478-9901c5536a45?w=700&h=700&fit=crop') }}" alt="{{ data_get($card2, 'title', '') }}" loading="lazy" />
                    <div class="electro-card__overlay">
                        <span class="electro-card__count">{{ data_get($card2, 'tag', 'Drap') }}</span>
                        <h3 class="electro-card__title">{{ data_get($card2, 'title', '') }}</h3>
                        <span class="electro-card__cta">Voir →</span>
                    </div>
                </a>
            @endif

            @if($wide)
                <a class="electro-card electro-card--wide" href="{{ data_get($wide, 'href', route('univers.show', 'draps-couettes')) }}">
                    <img src="{{ data_get($wide, 'image', 'https://images.unsplash.com/photo-1560448204-603b3fc33ddc?w=1200&h=600&fit=crop') }}" alt="{{ data_get($wide, 'title', '') }}" loading="lazy" />
                    <div class="electro-card__overlay">
                        <span class="electro-card__count">{{ data_get($wide, 'tag', 'Draps') }}</span>
                        <h3 class="electro-card__title">{{ data_get($wide, 'title', '') }}</h3>
                        @if(data_get($wide, 'desc'))
                            <p class="electro-card__desc">{{ data_get($wide, 'desc') }}</p>
                        @endif
                        <span class="electro-card__cta">Explorer <svg viewBox="0 0 24 24" width="16" height="16"><path d="M5 12h14M12 5l7 7-7 7" stroke="currentColor" stroke-width="2" fill="none" stroke-linecap="round"/></svg></span>
                    </div>
                </a>
            @endif
        </div>

        @if(($drapsProducts ?? collect())->count())
            <div class="best-modern__header" style="margin-top: 40px;">
                <h2 class="best-modern__title">Nos Draps</h2>
                <p class="best-modern__subtitle">Tous les types de draps — découvre la sélection complète en images</p>
            </div>

            <div class="best-modern__grid">
                @foreach($drapsProducts as $product)
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
                                @if($product->image)
                                    <img src="@image_url($product->image)" alt="{{ $product->name }}" loading="lazy" />
                                @else
                                    <img src="https://via.placeholder.com/400x400?text=Produit" alt="{{ $product->name }}" loading="lazy" />
                                @endif
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
                @endforeach
            </div>
        @endif
    </div>
</section>
