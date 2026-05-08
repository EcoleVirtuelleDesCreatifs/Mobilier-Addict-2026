        <section class="best-sellers" aria-label="Nos meilleurs produits">
    <style>
        .best-sellers {
            padding: 80px 6%;
            background: #fff;
            font-family: Arial, sans-serif;
        }

        .section-header {
            text-align: center;
            margin-bottom: 55px;
        }

        .section-badge {
            display: inline-block;
            padding: 10px 24px;
            border-radius: 50px;
            background: linear-gradient(135deg, #f0559d, #d92776);
            color: #fff;
            font-size: 12px;
            font-weight: 800;
            letter-spacing: 1.5px;
            margin-bottom: 18px;
        }

        .section-header h2 {
            margin: 0;
            font-size: 46px;
            color: #101828;
            font-weight: 900;
        }

        .section-header p {
            margin-top: 14px;
            font-size: 16px;
            color: #667085;
        }

        .products-grid {
            max-width: 1280px;
            margin: 0 auto;
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            gap: 32px;
        }

        .product-card {
            position: relative;
            background: #fff;
            border: 1px solid #e5eaf3;
            border-radius: 24px;
            padding: 18px;
            box-shadow: 0 18px 45px rgba(16, 24, 40, 0.06);
            transition: all 0.3s ease;
        }

        .product-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 25px 60px rgba(16, 24, 40, 0.1);
        }

        .discount {
            position: absolute;
            top: 18px;
            left: 18px;
            z-index: 2;
            padding: 8px 15px;
            border-radius: 50px;
            background: linear-gradient(135deg, #ff9b21, #ef7900);
            color: #fff;
            font-size: 12px;
            font-weight: 800;
            box-shadow: 0 8px 18px rgba(239, 121, 0, 0.3);
        }

        .product-image {
            height: 260px;
            border-radius: 18px;
            overflow: hidden;
            background: #f8fafc;
            margin-bottom: 20px;
        }

        .product-image img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            transition: transform 0.5s ease;
        }

        .product-card:hover .product-image img {
            transform: scale(1.05);
        }

        .product-info h3 {
            margin: 0;
            font-size: 20px;
            color: #101828;
            font-weight: 700;
        }

        .product-info p {
            margin: 8px 0 16px;
            color: #667085;
            font-size: 14px;
        }

        .price {
            display: flex;
            align-items: center;
            gap: 10px;
            margin-bottom: 18px;
        }

        .price strong {
            color: #101828;
            font-size: 18px;
            font-weight: 800;
        }

        .price span {
            color: #98a2b3;
            text-decoration: line-through;
            font-size: 14px;
        }

        .product-card button {
            width: 100%;
            border: none;
            border-radius: 14px;
            padding: 14px;
            background: #101828;
            color: #fff;
            font-weight: 700;
            cursor: pointer;
            transition: all 0.3s ease;
        }

        .product-card button:hover {
            background: #000;
            transform: translateY(-2px);
        }

        @media (max-width: 1024px) {
            .products-grid {
                grid-template-columns: repeat(2, 1fr);
            }
        }

        @media (max-width: 600px) {
            .section-header h2 {
                font-size: 34px;
            }

            .products-grid {
                grid-template-columns: 1fr;
            }
        }
    </style>

    <div class="section-header">
        <span class="section-badge">BEST-SELLERS</span>
        <h2>Les préférés de nos clients</h2>
        <p>Qualité premium, confort durable, satisfaction garantie</p>
    </div>

    @php
        $allProducts = ($favoriteProducts ?? collect());
    @endphp

    <div class="products-grid">
        @foreach($allProducts as $product)
            <article class="product-card" aria-label="{{ $product->name }}">
                @if(!empty($product->discount_percent) && (int) $product->discount_percent > 0)
                    <span class="discount">-{{ (int) $product->discount_percent }}%</span>
                @endif

                <a href="{{ $product->slug ? route('product.show', $product->slug) : route('demo.product') }}" class="product-image">
                    <img src="@image_url($product->image)" alt="{{ $product->name }}" loading="lazy">
                </a>
                <div class="product-info">
                    <h3>{{ $product->name }}</h3>
                    <p>{{ Str::limit($product->description ?? '', 80) }}</p>
                    <div class="price">
                        <strong>{{ $product->formatted_price }}</strong>
                        @if(!empty($product->formatted_old_price))
                            <span>{{ $product->formatted_old_price }}</span>
                        @endif
                    </div>
                    <a href="{{ $product->slug ? route('product.show', $product->slug) : route('demo.product') }}" style="text-decoration:none">
                        <button type="button">Voir le produit</button>
                    </a>
                </div>
            </article>
        @endforeach
    </div>
</section>
