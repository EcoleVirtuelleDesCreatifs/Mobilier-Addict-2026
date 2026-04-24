        <section class="bestsellers-clean" aria-label="Nos meilleurs produits">
    <style>
        .bestsellers-clean {
            padding: 80px 0;
            background: #fff
        }

        .bestsellers-clean__container {
            max-width: 1400px;
            margin: 0 auto;
            padding: 0 20px
        }

        .bestsellers-clean__header {
            text-align: center;
            margin-bottom: 50px
        }

        .bestsellers-clean__badge {
            display: inline-block;
            padding: 8px 20px;
            background: #ec4899;
            color: #fff;
            border-radius: 4px;
            margin-bottom: 20px;
            font-size: 0.8125rem;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 1px
        }

        .bestsellers-clean__title {
            font-size: 2.5rem;
            font-weight: 800;
            color: #0f172a;
            margin: 0 0 12px;
            letter-spacing: -0.02em
        }

        .bestsellers-clean__subtitle {
            font-size: 1rem;
            color: #64748b;
            margin: 0
        }

        .bestsellers-clean__grid {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 24px
        }

        .bestsellers-clean__card {
            background: #fff;
            border: 1px solid #e2e8f0;
            border-radius: 12px;
            overflow: hidden;
            transition: all .3s ease
        }

        .bestsellers-clean__card:hover {
            border-color: #ec4899;
            box-shadow: 0 8px 24px rgba(236,72,153,.15);
            transform: translateY(-4px)
        }

        .bestsellers-clean__card-media {
            position: relative;
            height: 220px;
            overflow: hidden;
            background: #f8fafc
        }

        .bestsellers-clean__card-media img {
            width: 100%;
            height: 100%;
            object-fit: contain;
            padding: 30px;
            transition: transform .3s ease
        }

        .bestsellers-clean__card:hover .bestsellers-clean__card-media img {
            transform: scale(1.05)
        }

        .bestsellers-clean__badge-discount {
            position: absolute;
            top: 12px;
            left: 12px;
            padding: 6px 12px;
            background: #ec4899;
            color: #fff;
            border-radius: 4px;
            font-size: 0.75rem;
            font-weight: 700
        }

        .bestsellers-clean__card-body {
            padding: 20px
        }

        .bestsellers-clean__rating {
            display: flex;
            align-items: center;
            gap: 6px;
            margin-bottom: 12px;
            font-size: 0.875rem;
            color: #f59e0b
        }

        .bestsellers-clean__rating-count {
            color: #64748b;
            font-size: 0.8125rem
        }

        .bestsellers-clean__name {
            font-size: 1rem;
            font-weight: 700;
            color: #0f172a;
            margin: 0 0 12px;
            line-height: 1.4;
            display: -webkit-box;
            -webkit-line-clamp: 2;
            -webkit-box-orient: vertical;
            overflow: hidden
        }

        .bestsellers-clean__price {
            font-size: 1.25rem;
            font-weight: 800;
            color: #ec4899;
            margin-bottom: 16px
        }

        .bestsellers-clean__price-old {
            font-size: 0.875rem;
            color: #94a3b8;
            text-decoration: line-through;
            margin-left: 8px;
            font-weight: 500
        }

        .bestsellers-clean__actions {
            display: flex;
            gap: 12px
        }

        .bestsellers-clean__btn {
            flex: 1;
            padding: 12px 20px;
            border: none;
            border-radius: 8px;
            font-weight: 700;
            font-size: 0.875rem;
            cursor: pointer;
            transition: all .2s ease
        }

        .bestsellers-clean__btn--primary {
            background: #ec4899;
            color: #fff
        }

        .bestsellers-clean__btn--primary:hover {
            background: #be185d
        }

        .bestsellers-clean__btn--secondary {
            background: #f1f5f9;
            color: #0f172a
        }

        .bestsellers-clean__btn--secondary:hover {
            background: #e2e8f0
        }

        .bestsellers-clean__btn--full {
            width: 100%
        }

        @media (max-width: 1024px) {
            .bestsellers-clean__grid {
                grid-template-columns: repeat(2, 1fr)
            }
        }

        @media (max-width: 768px) {
            .bestsellers-clean {
                padding: 60px 0
            }

            .bestsellers-clean__grid {
                grid-template-columns: 1fr
            }

            .bestsellers-clean__card-media {
                height: 200px
            }
        }
    </style>

    <div class="bestsellers-clean__container">
        <div class="bestsellers-clean__header">
            <span class="bestsellers-clean__badge">Best-Sellers</span>
            <h2 class="bestsellers-clean__title">Les préférés de nos clients</h2>
            <p class="bestsellers-clean__subtitle">Qualité premium, satisfaction garantie</p>
        </div>

        @php
            $allProducts = ($favoriteProducts ?? collect());
        @endphp

        <div class="bestsellers-clean__grid">
            @foreach($allProducts as $product)
                <article class="bestsellers-clean__card" aria-label="{{ $product->name }}">
                    @if(!empty($product->discount_percent) && (int) $product->discount_percent > 0)
                        <div class="bestsellers-clean__badge-discount">-{{ (int) $product->discount_percent }}%</div>
                    @endif

                    <a href="{{ $product->slug ? route('product.show', $product->slug) : route('demo.product') }}" class="bestsellers-clean__card-media">
                        <img src="@image_url($product->image)" alt="{{ $product->name }}" loading="lazy">
                    </a>
                    <div class="bestsellers-clean__card-body">
                        <h3 class="bestsellers-clean__name">{{ $product->name }}</h3>
                        <div class="bestsellers-clean__price">
                            {{ $product->formatted_price }}
                            @if(!empty($product->formatted_old_price))
                                <span class="bestsellers-clean__price-old">{{ $product->formatted_old_price }}</span>
                            @endif
                        </div>
                        <form action="{{ route('cart.add') }}" method="POST" style="margin:0">
                            @csrf
                            <input type="hidden" name="product_id" value="{{ $product->id }}">
                            <input type="hidden" name="quantity" value="1">
                            <button class="bestsellers-clean__btn bestsellers-clean__btn--primary bestsellers-clean__btn--full" type="submit">Ajouter</button>
                        </form>
                    </div>
                </article>
            @endforeach
        </div>
    </div>
</section>
