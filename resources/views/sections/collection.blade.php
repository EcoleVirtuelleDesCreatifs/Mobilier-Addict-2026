        <section class="collection" aria-label="Notre Collection" data-collection>
            <div class="container">
                <div class="collection__header">
                    <div class="collection__intro">
                        <span class="collection__badge">🛏️ Collection exclusive</span>
                        <h2 class="collection__title">Nos Matelas d'Exception</h2>
                        <p class="collection__subtitle">Chaque matelas est une promesse de nuits inoubliables. Trouvez celui qui vous correspond.</p>
                    </div>
                    <div class="collection__nav">
                        <button class="collection__arrow" type="button" aria-label="Précédent" data-collection-prev>
                            <svg viewBox="0 0 24 24" width="20" height="20"><path d="M15 18l-6-6 6-6" stroke="currentColor" stroke-width="2" fill="none" stroke-linecap="round"/></svg>
                        </button>
                        <button class="collection__arrow" type="button" aria-label="Suivant" data-collection-next>
                            <svg viewBox="0 0 24 24" width="20" height="20"><path d="M9 18l6-6-6-6" stroke="currentColor" stroke-width="2" fill="none" stroke-linecap="round"/></svg>
                        </button>
                    </div>
                </div>

                <div class="collection__grid" data-collection-track>
                    @foreach(($collectionProducts ?? collect()) as $product)
                        @php
                            $isFeatured = (bool) ($product->is_bestseller ?? false);
                            $tag = $product->firmness ? strtoupper(str_replace('_', '-', $product->firmness)) : null;
                            $specsParts = [];
                            if (!empty($product->size)) $specsParts[] = $product->size;
                            if (!empty($product->thickness)) $specsParts[] = 'Ép. ' . $product->thickness;
                            if (!empty($product->material)) $specsParts[] = $product->material;
                            $specs = implode(' • ', $specsParts);
                        @endphp

                        <article class="collection-card{{ $isFeatured ? ' collection-card--featured' : '' }}">
                            @if($isFeatured)
                                <div class="collection-card__badge">Best Seller</div>
                            @endif

                            <a href="{{ route('product.show', $product->slug) }}" style="text-decoration:none;color:inherit">
                                <div class="collection-card__media">
                                    <img src="{{ $product->image ? asset($product->image) : 'https://images.unsplash.com/photo-1631049307264-da0ec9d70304?w=500&h=500&fit=crop' }}" alt="{{ $product->name }}" loading="lazy" />
                                    @if($tag)
                                        <span class="collection-card__tag">{{ $tag }}</span>
                                    @endif
                                </div>
                            </a>

                            <div class="collection-card__body">
                                <div class="collection-card__rating">
                                    <span class="collection-card__stars">★★★★★</span>
                                    <span class="collection-card__reviews">({{ (int) ($product->reviews_count ?? 0) }} avis)</span>
                                </div>

                                <a href="{{ route('product.show', $product->slug) }}" style="text-decoration:none;color:inherit">
                                    <h3 class="collection-card__name">{{ $product->name }}</h3>
                                </a>

                                @if($specs)
                                    <p class="collection-card__specs">{{ $specs }}</p>
                                @else
                                    <p class="collection-card__specs">&nbsp;</p>
                                @endif

                                <div class="collection-card__footer">
                                    <span class="collection-card__price">{{ number_format((float) $product->price, 0, ',', '.') }}<small>F</small></span>

                                    <form action="{{ route('cart.add') }}" method="POST" style="margin:0">
                                        @csrf
                                        <input type="hidden" name="product_id" value="{{ $product->id }}">
                                        <input type="hidden" name="quantity" value="1">
                                        <button class="collection-card__btn" type="submit" aria-label="Ajouter au panier">
                                            <svg viewBox="0 0 24 24" width="18" height="18"><path d="M12 5v14M5 12h14" stroke="currentColor" stroke-width="2" fill="none" stroke-linecap="round"/></svg>
                                        </button>
                                    </form>
                                </div>
                            </div>
                        </article>
                    @endforeach
                </div>

                <div class="collection__cta">
                    <a class="collection__link" href="{{ route('collection.index') }}">
                        Voir toute la collection
                        <svg viewBox="0 0 24 24" width="18" height="18"><path d="M5 12h14M12 5l7 7-7 7" stroke="currentColor" stroke-width="2" fill="none" stroke-linecap="round"/></svg>
                    </a>
                </div>
            </div>
        </section>

        @push('scripts')
        <script>
        document.addEventListener('DOMContentLoaded', () => {
            const root = document.querySelector('[data-collection]');
            if (!root) return;

            const track = root.querySelector('[data-collection-track]');
            const prev = root.querySelector('[data-collection-prev]');
            const next = root.querySelector('[data-collection-next]');
            if (!track || !prev || !next) return;

            const getStep = () => {
                const card = track.querySelector('.collection-card');
                if (!card) return 320;
                const style = window.getComputedStyle(track);
                const gap = parseFloat(style.columnGap || style.gap || '24') || 24;
                return card.getBoundingClientRect().width + gap;
            };

            prev.addEventListener('click', () => {
                track.scrollBy({ left: -getStep(), behavior: 'smooth' });
            });

            next.addEventListener('click', () => {
                track.scrollBy({ left: getStep(), behavior: 'smooth' });
            });
        });
        </script>
        @endpush

        @push('styles')
        <style>
        [data-collection] [data-collection-track]{
            display:grid;
            grid-auto-flow:column;
            grid-auto-columns:minmax(260px, 1fr);
            overflow-x:auto;
            scroll-snap-type:x mandatory;
            -webkit-overflow-scrolling:touch;
            gap:24px;
            padding-bottom:10px;
        }
        [data-collection] [data-collection-track]::-webkit-scrollbar{height:0}
        [data-collection] .collection-card{scroll-snap-align:start}
        @media(min-width:1025px){
            [data-collection] [data-collection-track]{grid-auto-columns:calc((100% - 72px)/4)}
        }
        </style>
        @endpush
