@extends('layouts.front')

@section('title', 'B2B - Achats en Gros')

@section('content')
    <style>
        * {
            scroll-behavior: smooth;
        }

        .hero-fade {
            animation: fadeUp 1s ease-out forwards;
        }

        .product-card {
            transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
            position: relative;
            overflow: hidden;
        }

        .product-card:hover {
            transform: translateY(-12px) scale(1.02);
            box-shadow: 0 25px 50px -12px rgba(236, 72, 153, 0.3);
        }

        .product-card::before {
            content: '';
            position: absolute;
            inset: 0;
            background: linear-gradient(135deg, rgba(236, 72, 153, 0.1) 0%, transparent 50%);
            opacity: 0;
            transition: opacity 0.4s ease;
        }

        .product-card:hover::before {
            opacity: 1;
        }

        @keyframes fadeUp {
            from {
                opacity: 0;
                transform: translateY(40px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        @keyframes pulse {

            0%,
            100% {
                transform: scale(1);
                opacity: 0.8;
            }

            50% {
                transform: scale(1.05);
                opacity: 1;
            }
        }

        .b2b-card {
            transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
            position: relative;
            overflow: hidden;
        }

        .b2b-card:hover {
            transform: translateY(-8px);
        }

        .b2b-card__overlay {
            position: absolute;
            inset: 0;
            background: linear-gradient(180deg, rgba(0, 0, 0, 0.1) 0%, rgba(0, 0, 0, 0.7) 100%);
            transition: all 0.4s ease;
        }

        .b2b-card:hover .b2b-card__overlay {
            background: linear-gradient(180deg, rgba(0, 0, 0, 0.2) 0%, rgba(0, 0, 0, 0.8) 100%);
        }

        .b2b-card__content {
            position: relative;
            z-index: 2;
        }
    </style>

    <section
        style="min-height: 80vh; background: linear-gradient(180deg, #0f172a 0%, #1e3a8a 100%); position: relative; overflow: hidden; display: flex; align-items: center;">
        <div
            style="position: absolute; width: 100%; height: 100%; background: url('data:image/svg+xml,<svg xmlns=%22http://www.w3.org/2000/svg%22 viewBox=%220 0 100 100%22><circle cx=%2250%22 cy=%2250%22 r=%2240%22 fill=%22none%22 stroke=%22rgba(236,72,153,0.05)%22 stroke-width=%221%22/><circle cx=%2250%22 cy=%2250%22 r=%2230%22 fill=%22none%22 stroke=%22rgba(236,72,153,0.05)%22 stroke-width=%221%22/><circle cx=%2250%22 cy=%2250%22 r=%2220%22 fill=%22none%22 stroke=%22rgba(236,72,153,0.05)%22 stroke-width=%221%22/></svg>') repeat; background-size: 400px 400px; opacity: 0.5;">
        </div>
        <div class="container" style="position: relative; z-index: 1;">
            <div class="row justify-content-center">
                <div class="col-lg-8 hero-fade" style="text-align: center;">
                    <div
                        style="display: inline-block; padding: 8px 20px; background: rgba(236, 72, 153, 0.15); border-radius: 30px; margin-bottom: 32px; border: 1px solid rgba(236, 72, 153, 0.3);">
                        <span
                            style="color: #ec4899; font-size: 0.8125rem; letter-spacing: 2px; text-transform: uppercase; font-weight: 600;">Espace
                            Professionnel</span>
                    </div>
                    <h1
                        style="font-size: clamp(2.5rem, 5vw, 4.5rem); font-weight: 800; color: #fff; margin-bottom: 32px; line-height: 1.1;">
                        <span
                            style="background: linear-gradient(90deg, #ec4899, #f472b6); -webkit-background-clip: text; -webkit-text-fill-color: transparent;">Espace
                            Entreprise</span>
                    </h1>
                    <p
                        style="font-size: 1.25rem; color: rgba(255,255,255,0.8); margin-bottom: 48px; line-height: 1.8; max-width: 700px; margin-left: auto; margin-right: auto;">
                        Des solutions sur mesure pour hôtels, cliniques, résidences et entreprises exigeantes.
                    </p>
                    <div style="display: flex; gap: 16px; justify-content: center; flex-wrap: wrap;">
                        <a href="#categories"
                            style="display: inline-block; background: #ec4899; color: #fff; padding: 18px 40px; border-radius: 50px; text-decoration: none; font-weight: 600; transition: all 0.3s ease;">
                            Explorer nos gammes
                        </a>
                        <a href="https://wa.me/{{ whatsapp_number() }}" target="_blank"
                            style="display: inline-block; border: 2px solid rgba(255,255,255,0.3); color: #fff; padding: 16px 38px; border-radius: 50px; text-decoration: none; font-weight: 500; transition: all 0.3s ease;">
                            Contactez-nous
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section id="categories" style="padding: 40px 0; background: #fff;">
        <div class="container">
            <div style="text-align: center; margin-bottom: 30px;">
                <span
                    style="color: #ec4899; font-size: 0.875rem; letter-spacing: 2px; text-transform: uppercase; font-weight: 500;">Nos
                    solutions</span>
                <h2
                    style="font-size: clamp(2.5rem, 5vw, 4rem); font-weight: 700; color: #1e3a8a; margin-top: 16px; margin-bottom: 24px;">
                    Univers professionnels
                </h2>
                <p style="color: #6b7280; font-size: 1.25rem; max-width: 600px; margin: 0 auto;">
                    Chaque gamme conçue pour répondre aux exigences de votre secteur
                </p>
            </div>
            <div style="display: flex; flex-wrap: nowrap; gap: 20px; overflow-x: auto; padding: 10px 0;">
                @foreach ($categories as $index => $category)
                    <a href="{{ route('b2b.category', $category->key) }}" class="b2b-card"
                        style="text-decoration: none; display: block; flex: 0 0 calc(25% - 15px); aspect-ratio: 1/1; border-radius: 20px; background: {{ $index % 2 == 0 ? 'linear-gradient(135deg, #3b82f6 0%, #1e40af 100%)' : 'linear-gradient(135deg, #ec4899 0%, #be185d 100%)' }}; box-shadow: 0 10px 40px -10px rgba(59, 130, 246, 0.3); min-width: 250px;">
                        <div class="b2b-card__overlay"></div>
                        <div class="b2b-card__content"
                            style="position: absolute; bottom: 0; left: 0; right: 0; padding: 32px;">
                            <div
                                style="width: 60px; height: 60px; border-radius: 16px; background: rgba(255,255,255,0.25); backdrop-filter: blur(10px); display: flex; align-items: center; justify-content: center; margin-bottom: 16px; border: 1px solid rgba(255,255,255,0.3);">
                                <span
                                    style="font-size: 1.5rem; font-weight: 700; color: #fff;">{{ $category->name[0] }}</span>
                            </div>
                            <h3 style="font-size: 1.25rem; font-weight: 700; color: #fff; margin-bottom: 8px;">
                                {{ $category->name }}</h3>
                            <p
                                style="color: rgba(255,255,255,0.8); font-size: 0.875rem; margin-bottom: 12px; line-height: 1.5;">
                                {{ $category->description }}</p>
                            <span
                                style="color: #fff; font-size: 0.8125rem; font-weight: 600; display: inline-flex; align-items: center; gap: 6px;">Découvrir
                                <span style="font-size: 1rem;">→</span></span>
                        </div>
                    </a>
                @endforeach
            </div>
        </div>
    </section>

    <section
        style="padding: 100px 0; background: linear-gradient(180deg, #0f172a 0%, #1e3a8a 100%); position: relative; overflow: hidden;">
        <div class="container" style="position: relative; z-index: 1;">
            <div style="text-align: center; margin-bottom: 60px;">
                <span
                    style="color: #ec4899; font-size: 0.875rem; letter-spacing: 2px; text-transform: uppercase; font-weight: 600;">Nos
                    produits</span>
                <h2
                    style="font-size: clamp(2rem, 4vw, 3.5rem); font-weight: 800; color: #fff; margin-top: 16px; margin-bottom: 24px;">
                    Qualité Premium
                </h2>
            </div>
            <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(280px, 1fr)); gap: 28px;">
                @foreach($products as $product)
                    <div class="product-card" style="background: rgba(255,255,255,0.05); border-radius: 24px; padding: 24px; border: 1px solid rgba(255,255,255,0.1); position: relative; z-index: 1;">
                        <a href="{{ $product->slug ? route('product.show', $product->slug) : '#' }}" style="text-decoration: none; color: inherit;">
                            <div style="aspect-ratio: 4/3; background: linear-gradient(135deg, rgba(236, 72, 153, 0.1) 0%, rgba(59, 130, 246, 0.1) 100%); border-radius: 16px; margin-bottom: 20px; display: flex; align-items: center; justify-content: center; position: relative; overflow: hidden;">
                                @if($product->image)
                                    <img src="{{ image_url($product->image) }}" alt="{{ $product->name }}" style="width: 100%; height: 100%; object-fit: cover;">
                                @else
                                    <span style="font-size: 4rem; font-weight: 800; color: rgba(255,255,255,0.4);">{{ $product->name[0] }}</span>
                                @endif
                            </div>
                            <h3 style="font-size: 1.125rem; font-weight: 700; color: #fff; margin-bottom: 8px;">{{ $product->name }}</h3>
                        </a>
                        <div style="display: flex; align-items: center; justify-content: space-between; margin-bottom: 16px;">
                            <span style="font-size: 1.5rem; font-weight: 800; color: #ec4899;">{{ $product->formatted_price }}</span>
                        </div>
                        <a href="{{ $product->slug ? route('product.show', $product->slug) : '#' }}" style="display: inline-flex; align-items: center; justify-content: center; gap: 8px; background: linear-gradient(135deg, #ec4899 0%, #be185d 100%); color: #fff; padding: 14px 24px; border-radius: 12px; text-decoration: none; font-weight: 600; font-size: 0.9375rem; transition: all 0.3s ease; width: 100%;">
                            <svg style="width: 18px; height: 18px;" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z"></path></svg>
                            Voir le produit
                        </a>
                    </div>
                @endforeach
            </div>
        </div>
    </section>

@endsection
