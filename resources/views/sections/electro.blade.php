        @php($section = $homeSections['electro'] ?? null)
        @if($section && $section->categories->count())
            <section class="electro" aria-label="Électroménager & Meubles">
                <div class="container">
                    <div class="electro__header">
                        <span class="electro__badge">{{ trim(($section?->badge_icon ? $section->badge_icon . ' ' : '') . ($section?->badge ?? '')) }}</span>
                        <h2 class="electro__title">{{ $section?->title }}</h2>
                    </div>

                    <div class="electro__grid">
                        @foreach($section->categories as $i => $category)
                            @php($cardClass = $i === 0 ? 'electro-card electro-card--large' : ($i === 3 ? 'electro-card electro-card--wide' : 'electro-card'))
                            <a class="{{ $cardClass }}" href="{{ route('univers.show', $category->slug) }}">
                                <img src="@image_url($category->image)" alt="{{ $category->image_alt ?: $category->name }}" loading="lazy" />
                                <div class="electro-card__overlay{{ $i === 1 ? ' electro-card__overlay--gradient' : '' }}">
                                    <span class="electro-card__count">{{ $category->products_rel_count ?? $category->products_count ?? 0 }} produits</span>
                                    <h3 class="electro-card__title">{{ $category->name }}</h3>
                                    @if($i === 0 || $i === 3)
                                        <p class="electro-card__desc">{{ $category->description }}</p>
                                        <span class="electro-card__cta">Explorer <svg viewBox="0 0 24 24" width="16" height="16"><path d="M5 12h14M12 5l7 7-7 7" stroke="currentColor" stroke-width="2" fill="none" stroke-linecap="round"/></svg></span>
                                    @else
                                        <span class="electro-card__cta">Voir →</span>
                                    @endif
                                </div>
                            </a>
                        @endforeach
                    </div>
                </div>
            </section>
        @endif
