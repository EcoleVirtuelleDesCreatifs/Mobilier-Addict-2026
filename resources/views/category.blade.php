@extends('layouts.front')

@section('title', $category->name . ' - Mobilier Addict')
@section('meta_description', $category->description ?? 'Découvrez notre sélection de ' . $category->name)

@section('content')
    <style>
        .products-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 24px;
        }

        @media (max-width: 768px) {
            .products-grid {
                grid-template-columns: 1fr !important;
                gap: 16px !important;
            }
        }

        @media (min-width: 769px) and (max-width: 1024px) {
            .products-grid {
                grid-template-columns: repeat(2, 1fr) !important;
            }
        }

        .category-cover {
            position: relative;
            min-height: 40vh;
            background: linear-gradient(135deg, #0f172a 0%, #1e3a8a 50%, #0f172a 100%);
            overflow: hidden;
            display: flex;
            align-items: center;
        }

        .category-cover::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: radial-gradient(circle at 20% 50%, rgba(236, 72, 153, 0.15) 0%, transparent 50%),
                radial-gradient(circle at 80% 50%, rgba(59, 130, 246, 0.15) 0%, transparent 50%);
            animation: pulse 15s ease-in-out infinite;
        }

        .category-cover::after {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: radial-gradient(circle at 50% 50%, rgba(139, 92, 246, 0.1) 0%, transparent 60%);
            animation: pulse 20s ease-in-out infinite reverse;
        }

        @keyframes pulse {

            0%,
            100% {
                opacity: 0.5;
                transform: scale(1);
            }

            50% {
                opacity: 1;
                transform: scale(1.1);
            }
        }

        .category-cover-image {
            position: absolute;
            right: 0;
            top: 0;
            bottom: 0;
            width: 50%;
            max-width: 800px;
            opacity: 0.15;
            filter: blur(3px);
            z-index: 1;
            object-fit: cover;
            mask-image: linear-gradient(to left, rgba(0, 0, 0, 1) 0%, rgba(0, 0, 0, 0) 100%);
            -webkit-mask-image: linear-gradient(to left, rgba(0, 0, 0, 1) 0%, rgba(0, 0, 0, 0) 100%);
        }

        @media (max-width: 768px) {
            .category-cover {
                min-height: 80vh;
            }

            .category-cover-image {
                width: 100%;
                opacity: 0.1;
                mask-image: linear-gradient(to top, rgba(0, 0, 0, 1) 0%, rgba(0, 0, 0, 0) 100%);
                -webkit-mask-image: linear-gradient(to top, rgba(0, 0, 0, 1) 0%, rgba(0, 0, 0, 0) 100%);
            }
        }
    </style>

    <section class="category-cover" style="padding: 80px 0;">
        @if (isset($category->image))
            <img src="{!! $category->image !!}" alt="{{ $category->name }}" class="category-cover-image" />
        @endif
        <div class="container" style="position: relative; z-index: 2;">
            <div class="row justify-content-center">
                <div class="col-lg-8" style="text-align: center;">
                    <div
                        style="display: inline-block; padding: 8px 20px; background: rgba(236, 72, 153, 0.15); border-radius: 30px; margin-bottom: 24px;">
                        <span
                            style="color: #ec4899; font-size: 0.8125rem; letter-spacing: 2px; text-transform: uppercase; font-weight: 600;">Catégorie</span>
                    </div>
                    <h1
                        style="font-size: clamp(2rem, 4vw, 3rem); font-weight: 800; color: #fff; margin-bottom: 16px; line-height: 1.1;">
                        {{ $category->name }}
                    </h1>
                    @if (isset($category->description) && $category->description)
                        <p style="font-size: 1.125rem; color: rgba(255,255,255,0.8); margin-bottom: 0; line-height: 1.6;">
                            {{ $category->description }}
                        </p>
                    @endif
                </div>
            </div>
        </div>
    </section>

    <section style="padding: 80px 0; background: #1e3a8a; position: relative;">
        <div class="container" style="position: relative; z-index: 1;">
            <div style="text-align: center; margin-bottom: 48px;">
                <span
                    style="color: #ec4899; font-size: 0.875rem; letter-spacing: 2px; text-transform: uppercase; font-weight: 600;">Nos
                    produits</span>
                <h2
                    style="font-size: clamp(1.5rem, 3vw, 2.5rem); font-weight: 800; color: #fff; margin-top: 12px; margin-bottom: 16px;">
                    Qualité Premium ({{ $category->productsMany->count() }} produits)
                </h2>
            </div>
            <div class="products-grid">
                @forelse($category->productsMany as $product)
                    <div class="product-card"
                        style="background: rgba(255,255,255,0.05); border-radius: 16px; padding: 20px; border: 1px solid rgba(255,255,255,0.1);">
                        <a href="{{ $product->slug ? route('product.show', $product->slug) : '#' }}"
                            style="text-decoration: none; color: inherit;">
                            <div
                                style="aspect-ratio: 4/3; background: #1e3a8a; border-radius: 12px; margin-bottom: 16px; display: flex; align-items: center; justify-content: center; overflow: hidden;">
                                @if ($product->image)
                                    <img src="{{ image_url($product->image) }}" alt="{{ $product->name }}"
                                        style="width: 100%; height: 100%; object-fit: cover;">
                                @else
                                    <span
                                        style="font-size: 3rem; font-weight: 800; color: rgba(255,255,255,0.4);">{{ $product->name[0] }}</span>
                                @endif
                            </div>
                            <h3
                                style="font-size: 1rem; font-weight: 700; color: #fff; margin-bottom: 12px; line-height: 1.4;">
                                {{ $product->name }}</h3>
                        </a>
                        <div
                            style="display: flex; align-items: center; justify-content: space-between; margin-bottom: 16px;">
                            <span
                                style="font-size: 1.25rem; font-weight: 800; color: #ec4899;">{{ number_format($product->price, 0, ',', '.') }}F</span>
                        </div>
                        <a href="{{ $product->slug ? route('product.show', $product->slug) : '#' }}"
                            style="display: inline-block; text-align: center; background: #ec4899; color: #fff; padding: 12px 20px; border-radius: 8px; text-decoration: none; font-weight: 600; font-size: 0.875rem; width: 100%;">
                            Voir le produit
                        </a>
                    </div>
                @empty
                    <div style="grid-column: 1 / -1; text-align: center; color: rgba(255,255,255,0.7);">
                        <h3 style="font-size: 1.25rem; margin-bottom: 12px;">Aucun produit disponible</h3>
                        <p>Veuillez revenir ultérieurement.</p>
                    </div>
                @endforelse
            </div>
        </div>
    </section>
@endsection
