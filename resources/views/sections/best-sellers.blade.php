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
            background: linear-gradient(135deg, #ec4899 0%, #be185d 100%);
            color: #fff;
            border-radius: 50px;
            margin-bottom: 20px;
            font-size: 0.8125rem;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 1px;
            box-shadow: 0 4px 15px rgba(236,72,153,.3)
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
            gap: 32px
        }

        .bestsellers-clean__card {
            background: #fff;
            border: 1px solid #e2e8f0;
            border-radius: 20px;
            overflow: hidden;
            transition: all .4s cubic-bezier(.4,0,.2,1);
            position: relative
        }

        .bestsellers-clean__card:hover {
            border-color: #ec4899;
            box-shadow: 0 20px 60px rgba(236,72,153,.2);
            transform: translateY(-8px)
        }

        .bestsellers-clean__card-media {
            position: relative;
            height: 240px;
            overflow: hidden;
            background: linear-gradient(135deg, #f8fafc 0%, #f1f5f9 100%)
        }

        .bestsellers-clean__card-media img {
            width: 100%;
            height: 100%;
            object-fit: contain;
            padding: 30px;
            transition: transform .5s ease
        }

        .bestsellers-clean__card:hover .bestsellers-clean__card-media img {
            transform: scale(1.1)
        }

        .bestsellers-clean__badge-discount {
            position: absolute;
            top: 16px;
            left: 16px;
            padding: 8px 16px;
            background: linear-gradient(135deg, #f59e0b 0%, #d97706 100%);
            color: #fff;
            border-radius: 50px;
            font-size: 0.75rem;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            box-shadow: 0 4px 12px rgba(245,158,11,.4)
        }

        .bestsellers-clean__card-body {
            padding: 24px
        }

        .bestsellers-clean__name {
            font-size: 1.125rem;
            font-weight: 700;
            color: #0f172a;
            margin: 0 0 16px;
            line-height: 1.4;
            display: -webkit-box;
            -webkit-line-clamp: 2;
            -webkit-box-orient: vertical;
            overflow: hidden;
            min-height: 48px
        }

        .bestsellers-clean__price {
            font-size: 1.5rem;
            font-weight: 900;
            color: #ec4899;
            margin-bottom: 20px;
            letter-spacing: -0.02em
        }

        .bestsellers-clean__price-old {
            font-size: 1rem;
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
            padding: 14px 20px;
            border: none;
            border-radius: 12px;
            font-weight: 700;
            font-size: 0.875rem;
            cursor: pointer;
            transition: all .3s ease;
            text-transform: uppercase;
            letter-spacing: 0.5px
        }

        .bestsellers-clean__btn--primary {
            background: linear-gradient(135deg, #ec4899 0%, #be185d 100%);
            color: #fff;
            box-shadow: 0 4px 15px rgba(236,72,153,.3)
        }

        .bestsellers-clean__btn--primary:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 25px rgba(236,72,153,.4)
        }

        .bestsellers-clean__btn--secondary {
            background: #f1f5f9;
            color: #0f172a;
            border: 1px solid #e2e8f0
        }

        .bestsellers-clean__btn--secondary:hover {
            background: #e2e8f0;
            transform: translateY(-2px)
        }

        .bestsellers-clean__btn--full {
            width: 100%
        }

        .bestsellers-clean__btn-icon {
            display: inline-flex;
            align-items: center;
            gap: 8px
        }

        @media (max-width: 1024px) {
            .bestsellers-clean__grid {
                grid-template-columns: repeat(2, 1fr);
                gap: 24px
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

            .bestsellers-clean__name {
                font-size: 1rem;
                min-height: 44px
            }

            .bestsellers-clean__price {
                font-size: 1.25rem
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
                        <div class="bestsellers-clean__actions">
                            <a href="{{ $product->slug ? route('product.show', $product->slug) : route('demo.product') }}" class="bestsellers-clean__btn bestsellers-clean__btn--secondary">
                                <span class="bestsellers-clean__btn-icon">
                                    <i class="fa-solid fa-eye"></i> Voir
                                </span>
                            </a>
                            <form action="{{ route('cart.add') }}" method="POST" style="margin:0">
                                @csrf
                                <input type="hidden" name="product_id" value="{{ $product->id }}">
                                <input type="hidden" name="quantity" value="1">
                                <button class="bestsellers-clean__btn bestsellers-clean__btn--primary" type="submit">
                                    <span class="bestsellers-clean__btn-icon">
                                        <i class="fa-solid fa-cart-plus"></i> Ajouter
                                    </span>
                                </button>
                            </form>
                        </div>
                    </div>
                </article>
            @endforeach
        </div>
    </div>
</section>
