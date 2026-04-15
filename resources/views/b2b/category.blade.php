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
                    {{ $category->description }} - Minimum {{ $category->min_products }} produits requis
                </p>
            </div>
        </div>
    </div>
</section>

<form action="{{ route('b2b.submit', $category->key) }}" method="POST" id="b2bOrderForm">
    @csrf

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
                        <div style="display: flex; align-items: center; justify-content: center; gap: 8px; background: rgba(255,255,255,0.1); padding: 14px 24px; border-radius: 12px; transition: all 0.3s ease;">
                            <input type="checkbox" name="products[]" value="{{ $product->id }}" class="b2b-product-checkbox" style="width: 20px; height: 20px; cursor: pointer; accent-color: #ec4899; z-index: 10; position: relative;">
                            <span style="font-weight: 600; color: #fff; cursor: pointer;" onclick="this.previousElementSibling.click()">Sélectionner</span>
                        </div>
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

    @if($products->count() > 0)
    <section style="padding: 100px 0; background: #fff; position: relative; overflow: hidden;">
        <div style="position: absolute; width: 500px; height: 500px; background: radial-gradient(circle, rgba(236, 72, 153, 0.08) 0%, transparent 60%); top: -200px; right: -100px;">
        </div>
        <div class="container" style="position: relative; z-index: 1;">
            <div class="row justify-content-center">
                <div class="col-lg-8">
                    <div style="background: linear-gradient(135deg, #1e3a8a 0%, #0f172a 100%); border-radius: 32px; padding: 48px; position: relative; overflow: hidden;">
                        <div style="position: absolute; width: 200px; height: 200px; background: radial-gradient(circle, rgba(236, 72, 153, 0.3) 0%, transparent 70%); top: -50px; right: -50px;">
                        </div>
                        <div style="position: relative; z-index: 1;">
                            <h2 style="font-size: clamp(1.5rem, 3vw, 2.5rem); font-weight: 800; color: #fff; margin-bottom: 32px; text-align: center;">
                                Informations de l'entreprise
                            </h2>

                            <div class="row mb-3">
                                <div class="col-md-6">
                                    <label for="company_name" class="form-label" style="color: rgba(255,255,255,0.9); font-weight: 600;">Nom de l'entreprise *</label>
                                    <input type="text" id="company_name" name="company_name" class="form-control" required style="background: rgba(255,255,255,0.1); border: 1px solid rgba(255,255,255,0.2); color: #fff;" />
                                </div>

                                <div class="col-md-6">
                                    <label for="email" class="form-label" style="color: rgba(255,255,255,0.9); font-weight: 600;">Email *</label>
                                    <input type="email" id="email" name="email" class="form-control" required style="background: rgba(255,255,255,0.1); border: 1px solid rgba(255,255,255,0.2); color: #fff;" />
                                </div>
                            </div>

                            <div class="row mb-3">
                                <div class="col-md-6">
                                    <label for="phone" class="form-label" style="color: rgba(255,255,255,0.9); font-weight: 600;">Téléphone *</label>
                                    <input type="text" id="phone" name="phone" class="form-control" required style="background: rgba(255,255,255,0.1); border: 1px solid rgba(255,255,255,0.2); color: #fff;" />
                                </div>
                            </div>

                            <div class="mb-4">
                                <label for="message" class="form-label" style="color: rgba(255,255,255,0.9); font-weight: 600;">Message (optionnel)</label>
                                <textarea id="message" name="message" class="form-control" rows="3" style="background: rgba(255,255,255,0.1); border: 1px solid rgba(255,255,255,0.2); color: #fff;"></textarea>
                            </div>

                            @error('products')
                                <div class="alert alert-danger">{{ $message }}</div>
                            @enderror

                            <div style="display: flex; gap: 16px; justify-content: center; flex-wrap: wrap;">
                                <a href="{{ route('b2b.index') }}" style="display: inline-flex; align-items: center; gap: 10px; background: rgba(255,255,255,0.2); color: #fff; padding: 16px 36px; border-radius: 50px; text-decoration: none; font-weight: 600; font-size: 1rem; transition: all 0.3s ease;">
                                    Annuler
                                </a>
                                <button type="submit" style="display: inline-flex; align-items: center; gap: 10px; background: linear-gradient(135deg, #ec4899 0%, #be185d 100%); color: #fff; padding: 16px 36px; border-radius: 50px; border: none; cursor: pointer; font-weight: 600; font-size: 1rem; transition: all 0.3s ease; box-shadow: 0 10px 30px -5px rgba(236, 72, 153, 0.4);">
                                    Envoyer la demande
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    @endif
</form>

<style>
.b2b-product-checkbox:checked + span {
    color: #ec4899;
}
</style>

<script>
document.addEventListener('DOMContentLoaded', function() {
    // Validate on form submit
    const form = document.getElementById('b2bOrderForm');
    if (form) {
        form.addEventListener('submit', function(e) {
            const count = document.querySelectorAll('.b2b-product-checkbox:checked').length;
            const minProducts = {{ $category->min_products }};
            if (count < minProducts) {
                e.preventDefault();
                alert('Vous devez sélectionner au moins ' + minProducts + ' produits.');
            }
        });
    }
});
</script>
@endsection
