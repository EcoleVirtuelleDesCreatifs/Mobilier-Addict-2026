        <section class="bestsellers-modern" aria-label="Nos meilleurs produits">
    <style>
        .bestsellers-modern {
            position: relative;
            padding: 100px 0;
            background: linear-gradient(135deg, #1a1a2e 0%, #16213e 50%, #0f3460 100%);
            overflow: hidden
        }

        .bestsellers-modern::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: url('data:image/svg+xml,<svg xmlns=%22http://www.w3.org/2000/svg%22 viewBox=%220 0 100 100%22><circle cx=%2250%22 cy=%2250%22 r=%221%22 fill=%22rgba(255,255,255,.02)%22/></svg>');
            background-size: 60px 60px
        }

        .bestsellers-modern__bg-circle {
            position: absolute;
            border-radius: 50%;
            filter: blur(120px);
            pointer-events: none
        }

        .bestsellers-modern__bg-circle--1 {
            width: 700px;
            height: 700px;
            background: rgba(236,72,153,.2);
            top: -250px;
            right: -150px
        }

        .bestsellers-modern__bg-circle--2 {
            width: 500px;
            height: 500px;
            background: rgba(59,130,246,.15);
            bottom: -150px;
            left: -150px
        }

        .bestsellers-modern__container {
            position: relative;
            max-width: 1400px;
            margin: 0 auto;
            padding: 0 20px
        }

        .bestsellers-modern__header {
            text-align: center;
            margin-bottom: 60px
        }

        .bestsellers-modern__badge {
            display: inline-flex;
            align-items: center;
            gap: 10px;
            padding: 12px 32px;
            background: linear-gradient(135deg, #ec4899 0%, #be185d 100%);
            border-radius: 50px;
            margin-bottom: 24px;
            color: #fff;
            font-size: 0.9375rem;
            font-weight: 700;
            letter-spacing: 2px;
            text-transform: uppercase;
            box-shadow: 0 8px 32px rgba(236,72,153,.4)
        }

        .bestsellers-modern__title {
            font-size: clamp(2.5rem, 5vw, 4rem);
            font-weight: 900;
            color: #fff;
            margin: 0 0 20px;
            letter-spacing: -0.03em;
            line-height: 1.1;
            text-shadow: 0 4px 30px rgba(0,0,0,.3)
        }

        .bestsellers-modern__title span {
            background: linear-gradient(135deg, #ffd700 0%, #ffed4e 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text
        }

        .bestsellers-modern__subtitle {
            font-size: 1.25rem;
            color: rgba(255,255,255,.75);
            margin: 0;
            max-width: 600px;
            margin-left: auto;
            margin-right: auto;
            line-height: 1.6
        }

        .bestsellers-modern__layout {
            display: grid;
            grid-template-columns: 1fr 1fr 1fr;
            gap: 40px;
            align-items: start
        }

        .bestsellers-modern__hero {
            background: rgba(255,255,255,.05);
            backdrop-filter: blur(20px);
            border-radius: 32px;
            overflow: hidden;
            border: 1px solid rgba(255,255,255,.1);
            box-shadow: 0 30px 80px rgba(0,0,0,.3);
            position: relative;
            grid-column: 1 / 3
        }

        .bestsellers-modern__hero-badge {
            position: absolute;
            top: 24px;
            left: 24px;
            padding: 10px 24px;
            background: linear-gradient(135deg, #ec4899 0%, #be185d 100%);
            color: #fff;
            border-radius: 20px;
            font-size: 0.875rem;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            box-shadow: 0 8px 24px rgba(236,72,153,.4);
            z-index: 10
        }

        .bestsellers-modern__hero-badge--new {
            background: linear-gradient(135deg, #10b981 0%, #059669 100%)
        }

        .bestsellers-modern__hero-badge--hot {
            background: linear-gradient(135deg, #f59e0b 0%, #d97706 100%)
        }

        .bestsellers-modern__hero-media {
            position: relative;
            min-height: 400px;
            overflow: hidden;
            background: rgba(255,255,255,.03)
        }

        .bestsellers-modern__hero-media img {
            width: 100%;
            height: 100%;
            object-fit: contain;
            padding: 40px;
            transition: transform .5s ease
        }

        .bestsellers-modern__hero:hover .bestsellers-modern__hero-media img {
            transform: scale(1.05)
        }

        .bestsellers-modern__hero-content {
            padding: 40px
        }

        .bestsellers-modern__hero-trust {
            display: flex;
            align-items: center;
            gap: 12px;
            margin-bottom: 20px;
            padding: 12px 20px;
            background: rgba(255,215,0,.1);
            border-radius: 50px;
            border: 1px solid rgba(255,215,0,.2);
            width: fit-content
        }

        .bestsellers-modern__hero-trust-icon {
            font-size: 1.25rem;
            color: #ffd700
        }

        .bestsellers-modern__hero-trust-text {
            color: #ffd700;
            font-weight: 800;
            font-size: 1rem
        }

        .bestsellers-modern__hero-trust-count {
            color: rgba(255,255,255,.7);
            font-size: 0.875rem
        }

        .bestsellers-modern__hero-name {
            font-size: 1.75rem;
            font-weight: 900;
            color: #fff;
            margin: 0 0 20px;
            line-height: 1.2;
            letter-spacing: -0.02em
        }

        .bestsellers-modern__hero-prices {
            display: flex;
            align-items: center;
            gap: 16px;
            margin-bottom: 24px
        }

        .bestsellers-modern__hero-price {
            font-size: 2rem;
            font-weight: 900;
            color: #ffd700;
            letter-spacing: -0.02em
        }

        .bestsellers-modern__hero-old {
            font-size: 1.25rem;
            color: rgba(255,255,255,.5);
            text-decoration: line-through;
            font-weight: 600
        }

        .bestsellers-modern__hero-actions {
            display: flex;
            gap: 16px;
            flex-wrap: wrap
        }

        .bestsellers-modern__hero-cta {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            padding: 16px 32px;
            border-radius: 50px;
            text-decoration: none;
            font-weight: 800;
            font-size: 1rem;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            transition: all .3s ease;
            border: none;
            cursor: pointer
        }

        .bestsellers-modern__hero-cta--primary {
            background: linear-gradient(135deg, #ec4899 0%, #8b5cf6 100%);
            color: #fff;
            box-shadow: 0 10px 40px rgba(236,72,153,.4)
        }

        .bestsellers-modern__hero-cta--primary:hover {
            transform: translateY(-3px);
            box-shadow: 0 15px 50px rgba(236,72,153,.5)
        }

        .bestsellers-modern__hero-cta--secondary {
            background: rgba(255,255,255,.1);
            backdrop-filter: blur(10px);
            border: 1px solid rgba(255,255,255,.2);
            color: #fff
        }

        .bestsellers-modern__hero-cta--secondary:hover {
            background: rgba(255,255,255,.15);
            transform: translateY(-2px)
        }

        .bestsellers-modern__list {
            display: grid;
            grid-template-columns: 1fr;
            gap: 24px
        }

        .bestsellers-modern__card {
            background: rgba(255,255,255,.05);
            backdrop-filter: blur(20px);
            border-radius: 24px;
            overflow: hidden;
            border: 1px solid rgba(255,255,255,.1);
            box-shadow: 0 20px 60px rgba(0,0,0,.2);
            transition: all .4s ease;
            position: relative
        }

        .bestsellers-modern__card:hover {
            transform: translateY(-8px);
            box-shadow: 0 30px 80px rgba(0,0,0,.3)
        }

        .bestsellers-modern__card-badge {
            position: absolute;
            top: 16px;
            left: 16px;
            padding: 6px 16px;
            background: linear-gradient(135deg, #ec4899 0%, #be185d 100%);
            color: #fff;
            border-radius: 16px;
            font-size: 0.75rem;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            box-shadow: 0 6px 20px rgba(236,72,153,.4);
            z-index: 10
        }

        .bestsellers-modern__card-badge--new {
            background: linear-gradient(135deg, #10b981 0%, #059669 100%)
        }

        .bestsellers-modern__card-badge--hot {
            background: linear-gradient(135deg, #f59e0b 0%, #d97706 100%)
        }

        .bestsellers-modern__card-media {
            position: relative;
            height: 200px;
            overflow: hidden;
            background: rgba(255,255,255,.03)
        }

        .bestsellers-modern__card-media img {
            width: 100%;
            height: 100%;
            object-fit: contain;
            padding: 20px;
            transition: transform .5s ease
        }

        .bestsellers-modern__card:hover .bestsellers-modern__card-media img {
            transform: scale(1.08)
        }

        .bestsellers-modern__card-body {
            padding: 24px
        }

        .bestsellers-modern__card-name {
            font-size: 1.125rem;
            font-weight: 800;
            color: #fff;
            margin: 0 0 16px;
            line-height: 1.3;
            letter-spacing: -0.01em
        }

        .bestsellers-modern__card-prices {
            display: flex;
            align-items: center;
            gap: 12px;
            margin-bottom: 20px
        }

        .bestsellers-modern__card-price {
            font-size: 1.5rem;
            font-weight: 900;
            color: #ffd700;
            letter-spacing: -0.02em
        }

        .bestsellers-modern__card-old {
            font-size: 1rem;
            color: rgba(255,255,255,.5);
            text-decoration: line-through;
            font-weight: 600
        }

        .bestsellers-modern__card-cta {
            width: 100%;
            padding: 14px 24px;
            background: linear-gradient(135deg, #ec4899 0%, #8b5cf6 100%);
            color: #fff;
            border: none;
            border-radius: 50px;
            font-weight: 800;
            font-size: 0.9375rem;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            cursor: pointer;
            transition: all .3s ease
        }

        .bestsellers-modern__card-cta:hover {
            transform: translateY(-2px);
            box-shadow: 0 10px 30px rgba(236,72,153,.4)
        }

        @media (max-width: 1024px) {
            .bestsellers-modern__layout {
                grid-template-columns: 1fr 1fr
            }

            .bestsellers-modern__hero {
                grid-column: 1 / 2
            }

            .bestsellers-modern__list {
                grid-column: 2 / 3;
                grid-template-columns: 1fr
            }
        }

        @media (max-width: 768px) {
            .bestsellers-modern {
                padding: 60px 0
            }

            .bestsellers-modern__layout {
                grid-template-columns: 1fr
            }

            .bestsellers-modern__hero {
                grid-column: 1 / 2
            }

            .bestsellers-modern__list {
                grid-column: 1 / 2;
                grid-template-columns: 1fr
            }

            .bestsellers-modern__hero-media {
                min-height: 300px
            }

            .bestsellers-modern__hero-content {
                padding: 28px
            }

            .bestsellers-modern__hero-name {
                font-size: 1.5rem
            }

            .bestsellers-modern__hero-actions {
                flex-direction: column
            }

            .bestsellers-modern__hero-cta {
                width: 100%
            }
        }
    </style>

    <div class="bestsellers-modern__bg-circle bestsellers-modern__bg-circle--1"></div>
    <div class="bestsellers-modern__bg-circle bestsellers-modern__bg-circle--2"></div>

    <div class="bestsellers-modern__container">
        <div class="bestsellers-modern__header">
            <span class="bestsellers-modern__badge">
                <i class="fa-solid fa-crown"></i> Best-Sellers
            </span>
            <h2 class="bestsellers-modern__title">Les préférés de <span>nos clients</span></h2>
            <p class="bestsellers-modern__subtitle">Qualité premium, satisfaction garantie, livraison rapide</p>
        </div>

        @php
            $featured = ($favoriteProducts ?? collect())->first();
            $others = ($favoriteProducts ?? collect())->slice(1)->take(3);
        @endphp

        <div class="bestsellers-modern__layout">
            @if($featured)
                <article class="bestsellers-modern__hero" aria-label="{{ $featured->name }}">
                    @if(!empty($featured->discount_percent) && (int) $featured->discount_percent > 0)
                        <div class="bestsellers-modern__hero-badge">-{{ (int) $featured->discount_percent }}%</div>
                    @elseif(!empty($featured->badge_type) && $featured->badge_type === 'new')
                        <div class="bestsellers-modern__hero-badge bestsellers-modern__hero-badge--new">NEW</div>
                    @elseif(!empty($featured->badge_type) && $featured->badge_type === 'hot')
                        <div class="bestsellers-modern__hero-badge bestsellers-modern__hero-badge--hot">HOT</div>
                    @endif

                    <div class="bestsellers-modern__hero-media">
                        <img src="@image_url($featured->image)" alt="{{ $featured->name }}" loading="eager" />
                    </div>
                    <div class="bestsellers-modern__hero-content">
                        <div class="bestsellers-modern__hero-trust">
                            <span class="bestsellers-modern__hero-trust-icon">★</span>
                            <span class="bestsellers-modern__hero-trust-text">4.9/5</span>
                            <span class="bestsellers-modern__hero-trust-count">(2.4k avis)</span>
                        </div>
                        <h3 class="bestsellers-modern__hero-name">{{ $featured->name }}</h3>
                        <div class="bestsellers-modern__hero-prices">
                            <span class="bestsellers-modern__hero-price">{{ $featured->formatted_price }}</span>
                            @if(!empty($featured->formatted_old_price))
                                <span class="bestsellers-modern__hero-old">{{ $featured->formatted_old_price }}</span>
                            @endif
                        </div>
                        <div class="bestsellers-modern__hero-actions">
                            <a href="{{ $featured->slug ? route('product.show', $featured->slug) : route('demo.product') }}" class="bestsellers-modern__hero-cta bestsellers-modern__hero-cta--primary">
                                Voir le produit
                            </a>
                            <form action="{{ route('cart.add') }}" method="POST" style="margin:0">
                                @csrf
                                <input type="hidden" name="product_id" value="{{ $featured->id }}">
                                <input type="hidden" name="quantity" value="1">
                                <button class="bestsellers-modern__hero-cta bestsellers-modern__hero-cta--secondary" type="submit">
                                    <span aria-hidden="true">+</span> Panier
                                </button>
                            </form>
                        </div>
                    </div>
                </article>
            @endif

            <div class="bestsellers-modern__list">
                @forelse($others as $product)
                    <article class="bestsellers-modern__card" aria-label="{{ $product->name }}">
                        @if(!empty($product->discount_percent) && (int) $product->discount_percent > 0)
                            <div class="bestsellers-modern__card-badge">-{{ (int) $product->discount_percent }}%</div>
                        @elseif(!empty($product->badge_type) && $product->badge_type === 'new')
                            <div class="bestsellers-modern__card-badge bestsellers-modern__card-badge--new">NEW</div>
                        @elseif(!empty($product->badge_type) && $product->badge_type === 'hot')
                            <div class="bestsellers-modern__card-badge bestsellers-modern__card-badge--hot">HOT</div>
                        @endif

                        <a href="{{ $product->slug ? route('product.show', $product->slug) : route('demo.product') }}" class="bestsellers-modern__card-media">
                            <img src="@image_url($product->image)" alt="{{ $product->name }}" loading="lazy" />
                        </a>
                        <div class="bestsellers-modern__card-body">
                            <h3 class="bestsellers-modern__card-name">{{ $product->name }}</h3>
                            <div class="bestsellers-modern__card-prices">
                                <span class="bestsellers-modern__card-price">{{ $product->formatted_price }}</span>
                                @if(!empty($product->formatted_old_price))
                                    <span class="bestsellers-modern__card-old">{{ $product->formatted_old_price }}</span>
                                @endif
                            </div>
                            <form action="{{ route('cart.add') }}" method="POST" style="margin:0">
                                @csrf
                                <input type="hidden" name="product_id" value="{{ $product->id }}">
                                <input type="hidden" name="quantity" value="1">
                                <button class="bestsellers-modern__card-cta" type="submit">Ajouter</button>
                            </form>
                        </div>
                    </article>
                @empty
                @endforelse
            </div>
        </div>
    </div>
</section>
