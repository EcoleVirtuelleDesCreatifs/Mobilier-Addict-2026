        <section class="electro" aria-label="Électroménager & Meubles">
            <div class="container">
                @php($section = $homeSections['electro'] ?? null)

                <div class="electro__header">
                    <span class="electro__badge">{{ trim(($section?->badge_icon ? $section->badge_icon . ' ' : '') . ($section?->badge ?? '')) }}</span>
                    <h2 class="electro__title">{{ $section?->title ?? 'Équipez Votre Maison' }}</h2>
                </div>

                <div class="electro__grid">
                    @if($section && $section->categories->count())
                        @foreach($section->categories as $i => $category)
                            @php($cardClass = $i === 0 ? 'electro-card electro-card--large' : ($i === 3 ? 'electro-card electro-card--wide' : 'electro-card'))
                            <a class="{{ $cardClass }}" href="#">
                                <img src="{{ asset($category->image) }}" alt="{{ $category->image_alt ?: $category->name }}" loading="lazy" />
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
                    @else
                        <a class="electro-card electro-card--large" href="#">
                            <img src="https://images.unsplash.com/photo-1556909114-f6e7ad7d3136?w=800&h=600&fit=crop" alt="Cuisine" loading="lazy" />
                            <div class="electro-card__overlay">
                                <span class="electro-card__count">25 produits</span>
                                <h3 class="electro-card__title">Cuisine</h3>
                                <p class="electro-card__desc">Gazinière, Mixeur, Bouilloire, Réfrigérateur, Congélateur</p>
                                <span class="electro-card__cta">Explorer <svg viewBox="0 0 24 24" width="16" height="16"><path d="M5 12h14M12 5l7 7-7 7" stroke="currentColor" stroke-width="2" fill="none" stroke-linecap="round"/></svg></span>
                            </div>
                        </a>
                        <a class="electro-card" href="#">
                            <img src="https://images.unsplash.com/photo-1585771724684-38269d6639fd?w=500&h=400&fit=crop" alt="Climatisation" loading="lazy" />
                            <div class="electro-card__overlay electro-card__overlay--gradient">
                                <span class="electro-card__count">12 produits</span>
                                <h3 class="electro-card__title">Froid & Climatisation</h3>
                                <span class="electro-card__cta">Voir →</span>
                            </div>
                        </a>
                        <a class="electro-card" href="#">
                            <img src="https://images.unsplash.com/photo-1555041469-a586c61ea9bc?w=500&h=400&fit=crop" alt="Salon" loading="lazy" />
                            <div class="electro-card__overlay">
                                <span class="electro-card__count">18 produits</span>
                                <h3 class="electro-card__title">Salon</h3>
                                <span class="electro-card__cta">Voir →</span>
                            </div>
                        </a>
                        <a class="electro-card electro-card--wide" href="#">
                            <img src="https://images.unsplash.com/photo-1593359677879-a4bb92f829d1?w=900&h=400&fit=crop" alt="Multi-Media" loading="lazy" />
                            <div class="electro-card__overlay">
                                <span class="electro-card__count">30 produits</span>
                                <h3 class="electro-card__title">Multi-Média</h3>
                                <p class="electro-card__desc">Télévisions, Woofers, Accessoires audio & vidéo</p>
                                <span class="electro-card__cta">Découvrir la collection <svg viewBox="0 0 24 24" width="16" height="16"><path d="M5 12h14M12 5l7 7-7 7" stroke="currentColor" stroke-width="2" fill="none" stroke-linecap="round"/></svg></span>
                            </div>
                        </a>
                    @endif
                </div>
            </div>
        </section>
