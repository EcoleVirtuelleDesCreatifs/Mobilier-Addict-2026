@extends('layouts.front')

@section('title', 'B2B - ' . $category->name)

@section('content')
<style>
    * {
        scroll-behavior: smooth;
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
</style>

<section style="min-height: 60vh; background: linear-gradient(180deg, #0f172a 0%, #1e3a8a 100%); position: relative; overflow: hidden; display: flex; align-items: center;">
    <div style="position: absolute; width: 100%; height: 100%; background: url('data:image/svg+xml,<svg xmlns=%22http://www.w3.org/2000/svg%22 viewBox=%220 0 100 100%22><circle cx=%2250%22 cy=%2250%22 r=%2240%22 fill=%22none%22 stroke=%22rgba(236,72,153,0.05)%22 stroke-width=%221%22/><circle cx=%2250%22 cy=%2250%22 r=%2230%22 fill=%22none%22 stroke=%22rgba(236,72,153,0.05)%22 stroke-width=%221%22/><circle cx=%2250%22 cy=%2250%22 r=%2220%22 fill=%22none%22 stroke=%22rgba(236,72,153,0.05)%22 stroke-width=%221%22/></svg>') repeat; background-size: 400px 400px; opacity: 0.5;">
    </div>
    <div class="container" style="position: relative; z-index: 1;">
        <div class="row justify-content-center">
            <div class="col-lg-8" style="text-align: center;">
                <div style="display: inline-block; padding: 8px 20px; background: rgba(236, 72, 153, 0.15); border-radius: 30px; margin-bottom: 32px; border: 1px solid rgba(236, 72, 153, 0.3);">
                    <span style="color: #ec4899; font-size: 0.8125rem; letter-spacing: 2px; text-transform: uppercase; font-weight: 600;">Espace Professionnel</span>
                </div>
                <h1 style="font-size: clamp(2.5rem, 5vw, 4.5rem); font-weight: 800; color: #fff; margin-bottom: 32px; line-height: 1.1;">
                    {{ $category->name }}
                </h1>
                <p style="font-size: 1.25rem; color: rgba(255,255,255,0.8); margin-bottom: 48px; line-height: 1.8; max-width: 700px; margin-left: auto; margin-right: auto;">
                    {{ $category->description }}
                </p>
                <div style="display: flex; gap: 16px; justify-content: center; flex-wrap: wrap;">
                    <a href="https://wa.me/{{ whatsapp_number() }}?text=Bonjour, je suis intéressé par la gamme {{ $category->name }} pour mon entreprise." target="_blank" rel="noopener" style="display: inline-flex; align-items: center; gap: 10px; background: linear-gradient(135deg, #25D366 0%, #128C7E 100%); color: #fff; padding: 16px 36px; border-radius: 50px; text-decoration: none; font-weight: 600; font-size: 1rem; transition: all 0.3s ease; box-shadow: 0 10px 30px -5px rgba(37, 211, 102, 0.4);">
                        <svg style="width: 20px; height: 20px;" fill="currentColor" viewBox="0 0 24 24"><path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 00-3.48-8.413z"/></svg>
                        Commander via WhatsApp
                    </a>
                </div>
            </div>
        </div>
    </div>
</section>

<section style="padding: 100px 0; background: linear-gradient(180deg, #0f172a 0%, #1e3a8a 100%); position: relative; overflow: hidden;">
    <div class="container" style="position: relative; z-index: 1;">
        <div style="text-align: center; margin-bottom: 60px;">
            <span style="color: #ec4899; font-size: 0.875rem; letter-spacing: 2px; text-transform: uppercase; font-weight: 600;">Nos produits</span>
            <h2 style="font-size: clamp(2rem, 4vw, 3.5rem); font-weight: 800; color: #fff; margin-top: 16px; margin-bottom: 24px;">
                Qualité Premium ({{ $products->count() }} produits)
            </h2>
        </div>
        <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(280px, 1fr)); gap: 28px;">
            @forelse($products as $product)
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
                        <span style="font-size: 1.5rem; font-weight: 800; color: #ec4899;">{{ number_format($product->price, 0, ',', '.') }}F</span>
                    </div>
                    <a href="{{ $product->slug ? route('product.show', $product->slug) : '#' }}" style="display: inline-flex; align-items: center; justify-content: center; gap: 8px; background: linear-gradient(135deg, #ec4899 0%, #be185d 100%); color: #fff; padding: 14px 24px; border-radius: 12px; text-decoration: none; font-weight: 600; font-size: 0.9375rem; transition: all 0.3s ease; width: 100%;">
                        <svg style="width: 18px; height: 18px;" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z"></path></svg>
                        Voir le produit
                    </a>
                </div>
            @empty
                <div style="grid-column: 1 / -1; text-align: center; color: rgba(255,255,255,0.7);">
                    <h3 style="font-size: 1.5rem; margin-bottom: 16px;">Aucun produit disponible</h3>
                    <p>Veuillez sélectionner une autre catégorie.</p>
                </div>
            @endforelse
        </div>
    </div>
</section>
@endsection
