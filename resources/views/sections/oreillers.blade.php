 <section class="electro" aria-label="Oreillers" style="background: {{ $homeSections['oreillers']?->background_color ?: 'radial-gradient(900px circle at 18% 22%, rgba(79, 70, 229, .40) 0%, rgba(79, 70, 229, 0) 60%), radial-gradient(800px circle at 82% 28%, rgba(236, 72, 153, .32) 0%, rgba(236, 72, 153, 0) 58%), linear-gradient(135deg, rgba(79,70,229,.24) 0%, rgba(236,72,153,.18) 100%)' }};">
    <div class="container">
        @php
            $section = $homeSections['oreillers'] ?? null;
            $badgeIcon = $section?->badge_icon ?: '🛏️';
            $badge = $section?->badge ?: 'Oreillers';
            $title = $section?->title ?: 'Oreillers';
            $description = $section?->description;
            $sectionCover = $section?->cover_image ? asset($section->cover_image) : null;
            $toImageUrl = function ($value) {
                if (!is_string($value) || trim($value) === '') {
                    return null;
                }
                $value = trim($value);
                if (preg_match('/^(https?:\/\/|\/\/|data:)/i', $value)) {
                    return $value;
                }
                return asset($value);
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
                        'title' => 'Oreiller pH2 avec motif',
                        'tag' => 'Oreiller',
                        'image' => 'https://images.unsplash.com/photo-1584100936595-c0654b55a2e2?w=700&h=700&fit=crop',
                        'href' => route('univers.show', 'oreillers'),
                    ],
                    [
                        'title' => 'Oreiller basique avec motif',
                        'tag' => 'Oreiller',
                        'image' => 'https://images.unsplash.com/photo-1617325247661-675ab4b64b2a?w=700&h=700&fit=crop',
                        'href' => route('univers.show', 'oreillers'),
                    ],
                    [
                        'title' => 'Oreillers en ouate',
                        'tag' => 'Ouate',
                        'image' => 'https://images.unsplash.com/photo-1522771739844-6a9f6d5f14af?w=1200&h=600&fit=crop',
                        'desc' => 'Oreiller en Ouate mini • Oreiller en ouate extra',
                        'href' => route('univers.show', 'oreillers'),
                        'wide' => true,
                    ],
                    [
                        'title' => 'Oreillers',
                        'tag' => null,
                        'image' => 'https://images.unsplash.com/photo-1582582429416-03ad554aab0d?w=900&h=900&fit=crop',
                        'href' => route('univers.show', 'oreillers'),
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
            <a class="electro-card electro-card--large" href="{{ data_get($hero, 'href', route('univers.show', 'oreillers')) }}">
                <img src="{{ $toImageUrl(data_get($hero, 'image')) ?: $sectionCover ?: 'https://images.unsplash.com/photo-1582582429416-03ad554aab0d?w=900&h=900&fit=crop' }}" alt="{{ data_get($hero, 'title', 'Oreillers') }}" loading="lazy" />
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
                <a class="electro-card" href="{{ data_get($card1, 'href', route('univers.show', 'oreillers')) }}">
                    <img src="{{ data_get($card1, 'image', 'https://images.unsplash.com/photo-1584100936595-c0654b55a2e2?w=700&h=700&fit=crop') }}" alt="{{ data_get($card1, 'title', '') }}" loading="lazy" />
                    <div class="electro-card__overlay electro-card__overlay--gradient">
                        <span class="electro-card__count">{{ data_get($card1, 'tag', 'Oreiller') }}</span>
                        <h3 class="electro-card__title">{{ data_get($card1, 'title', '') }}</h3>
                        <span class="electro-card__cta">Voir →</span>
                    </div>
                </a>
            @endif

            @if($card2)
                <a class="electro-card" href="{{ data_get($card2, 'href', route('univers.show', 'oreillers')) }}">
                    <img src="{{ data_get($card2, 'image', 'https://images.unsplash.com/photo-1617325247661-675ab4b64b2a?w=700&h=700&fit=crop') }}" alt="{{ data_get($card2, 'title', '') }}" loading="lazy" />
                    <div class="electro-card__overlay">
                        <span class="electro-card__count">{{ data_get($card2, 'tag', 'Oreiller') }}</span>
                        <h3 class="electro-card__title">{{ data_get($card2, 'title', '') }}</h3>
                        <span class="electro-card__cta">Voir →</span>
                    </div>
                </a>
            @endif

            @if($wide)
                <a class="electro-card electro-card--wide" href="{{ data_get($wide, 'href', route('univers.show', 'oreillers')) }}">
                    <img src="{{ data_get($wide, 'image', 'https://images.unsplash.com/photo-1522771739844-6a9f6d5f14af?w=1200&h=600&fit=crop') }}" alt="{{ data_get($wide, 'title', '') }}" loading="lazy" />
                    <div class="electro-card__overlay">
                        <span class="electro-card__count">{{ data_get($wide, 'tag', 'Ouate') }}</span>
                        <h3 class="electro-card__title">{{ data_get($wide, 'title', '') }}</h3>
                        @if(data_get($wide, 'desc'))
                            <p class="electro-card__desc">{{ data_get($wide, 'desc') }}</p>
                        @endif
                        <span class="electro-card__cta">Explorer <svg viewBox="0 0 24 24" width="16" height="16"><path d="M5 12h14M12 5l7 7-7 7" stroke="currentColor" stroke-width="2" fill="none" stroke-linecap="round"/></svg></span>
                    </div>
                </a>
            @endif
        </div>

        @if(($pillowProducts ?? collect())->count())
            <div class="best-modern__header" style="margin-top: 40px;">
                <h2 class="best-modern__title">Nos Oreillers</h2>
                <p class="best-modern__subtitle">Tous les oreillers et types d’oreillers — découvre la sélection complète</p>
            </div>

            <div class="best-modern__grid">
                @foreach($pillowProducts as $product)
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
