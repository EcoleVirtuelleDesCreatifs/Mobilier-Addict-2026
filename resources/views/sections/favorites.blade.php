        <section class="favorites-new" aria-label="Nos coups de cœur">
            <div class="container">
                <div class="favorites-new__header">
                    <span class="favorites-new__badge"><i class="fa-solid fa-heart"></i> Coup de Cœur</span>
                    <h2 class="favorites-new__title">Les Essentiels<br><span>de Votre Bien-Être</span></h2>
                    <p class="favorites-new__subtitle">Découvrez les produits adorés par notre communauté</p>
                </div>

                <div class="favorites-new__grid">
                    @php
                        $items = ($favoriteProducts ?? collect())->values();
                        $hero = $items->first();
                        $rest = $items->slice(1, 3)->values();
                    @endphp

                    @if($hero)
                        <article class="fav-new fav-new--hero">
                            <a href="{{ route('product.show', $hero->slug) }}" style="text-decoration:none;color:inherit">
                                <div class="fav-new__image">
                                    <img src="{{ $hero->image ? asset($hero->image) : 'https://images.unsplash.com/photo-1505693416388-ac5ce068fe85?w=800&h=900&fit=crop' }}" alt="{{ $hero->name }}" loading="lazy" />
                                    <div class="fav-new__badge-rank"><i class="fa-solid fa-crown"></i> #1</div>
                                </div>
                            </a>

                            <div class="fav-new__overlay">
                                <div class="fav-new__stats">
                                    <span class="fav-new__votes"><i class="fa-solid fa-fire"></i> {{ (int) ($hero->reviews_count ?? 0) }} votes</span>
                                    <span class="fav-new__rating"><i class="fa-solid fa-star"></i> {{ number_format((float) ($hero->rating ?? 0), 1, ',', '.') }}</span>
                                </div>

                                <a href="{{ route('product.show', $hero->slug) }}" style="text-decoration:none;color:inherit">
                                    <h3 class="fav-new__name">{{ $hero->name }}</h3>
                                </a>

                                <p class="fav-new__desc">{{ $hero->short_description ?: ' ' }}</p>

                                <div class="fav-new__bottom">
                                    <div class="fav-new__price">
                                        <span class="fav-new__price-current">{{ number_format((float) $hero->price, 0, ',', '.') }}<small>F</small></span>
                                        @if(!empty($hero->old_price))
                                            <span class="fav-new__price-old">{{ number_format((float) $hero->old_price, 0, ',', '.') }}F</span>
                                        @endif
                                    </div>

                                    <form action="{{ route('cart.add') }}" method="POST" style="margin:0">
                                        @csrf
                                        <input type="hidden" name="product_id" value="{{ $hero->id }}">
                                        <input type="hidden" name="quantity" value="1">
                                        <button class="fav-new__btn" type="submit">
                                            <i class="fa-solid fa-bag-shopping"></i> Ajouter
                                        </button>
                                    </form>
                                </div>
                            </div>
                        </article>
                    @endif

                    @foreach($rest as $i => $product)
                        <article class="fav-new">
                            <a href="{{ route('product.show', $product->slug) }}" style="text-decoration:none;color:inherit">
                                <div class="fav-new__image">
                                    <img src="{{ $product->image ? asset($product->image) : 'https://images.unsplash.com/photo-1592789705501-f9ae4287c4a9?w=500&h=600&fit=crop' }}" alt="{{ $product->name }}" loading="lazy" />
                                    <div class="fav-new__badge-rank">#{{ $i + 2 }}</div>
                                </div>
                            </a>
                            <div class="fav-new__overlay">
                                <span class="fav-new__rating"><i class="fa-solid fa-star"></i> {{ number_format((float) ($product->rating ?? 0), 1, ',', '.') }}</span>
                                <a href="{{ route('product.show', $product->slug) }}" style="text-decoration:none;color:inherit">
                                    <h3 class="fav-new__name">{{ $product->name }}</h3>
                                </a>
                                <div class="fav-new__bottom">
                                    <span class="fav-new__price-current">{{ number_format((float) $product->price, 0, ',', '.') }}<small>F</small></span>
                                    <form action="{{ route('cart.add') }}" method="POST" style="margin:0">
                                        @csrf
                                        <input type="hidden" name="product_id" value="{{ $product->id }}">
                                        <input type="hidden" name="quantity" value="1">
                                        <button class="fav-new__add" type="submit" aria-label="Ajouter au panier"><i class="fa-solid fa-plus"></i></button>
                                    </form>
                                </div>
                            </div>
                        </article>
                    @endforeach
                </div>
            </div>
        </section>
