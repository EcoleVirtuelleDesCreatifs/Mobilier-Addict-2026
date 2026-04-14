@extends('layouts.front')

@section('title', 'B2B - ' . $category->name)

@section('content')
<section class="b2b-category-hero" style="background: {{ $category->color }}; padding: 80px 0 60px; color: #fff;">
    <div class="container">
        <div class="text-center">
            <h1 style="font-size: 2.5rem; font-weight: 950; margin-bottom: 16px;">{{ $category->name }}</h1>
            <p style="font-size: 1.125rem; opacity: 0.9;">{{ $category->description }} - Minimum {{ $category->min_products }} produits requis</p>
        </div>
    </div>
</section>

<section class="b2b-products" style="padding: 60px 0;">
    <div class="container">
        @if(session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        <form action="{{ route('b2b.submit', $category->key) }}" method="POST" id="b2bOrderForm">
            @csrf
            
            <div class="row mb-4">
                <div class="col-12">
                    <div class="alert alert-info d-flex justify-content-between align-items-center">
                        <div>
                            <i class="fas fa-info-circle me-2"></i>
                            <strong>Minimum requis :</strong> {{ $category->min_products }} produits
                        </div>
                        <div>
                            <span class="badge bg-primary" id="selectedCount">0</span> produits sélectionnés
                        </div>
                    </div>
                </div>
            </div>

            <div class="row">
                @forelse($products as $product)
                    <div class="col-md-6 col-lg-4 mb-4">
                        <div class="b2b-product-card" style="background: #fff; border-radius: 16px; overflow: hidden; box-shadow: 0 4px 20px rgba(0,0,0,0.08); border: 2px solid transparent; transition: all 0.3s ease;">
                            <div style="height: 200px; overflow: hidden;">
                                @if($product->image)
                                    <img src="@image_url($product->image)" alt="{{ $product->name }}" style="width: 100%; height: 100%; object-fit: cover;" />
                                @else
                                    <div style="width: 100%; height: 100%; background: #e2e8f0; display: flex; align-items: center; justify-content: center; font-size: 3rem; font-weight: 950; color: #64748b;">{{ $product->name[0] }}</div>
                                @endif
                            </div>
                            <div style="padding: 20px;">
                                <h3 style="font-size: 1.125rem; font-weight: 700; color: #1e293b; margin: 0 0 8px;">{{ $product->name }}</h3>
                                <p style="font-size: 0.9375rem; color: #64748b; margin: 0 0 16px;">{{ Str::limit($product->description ?? '', 80) }}</p>
                                
                                <div class="d-flex justify-content-between align-items-center">
                                    <div>
                                        @if($product->price)
                                            <span style="font-size: 1.25rem; font-weight: 950; color: {{ $category->color }};">{{ number_format($product->price, 0, ',', ' ') }} FCFA</span>
                                        @endif
                                    </div>
                                    <label class="d-flex align-items-center" style="cursor: pointer;">
                                        <input type="checkbox" name="products[]" value="{{ $product->id }}" class="b2b-product-checkbox" style="width: 24px; height: 24px; cursor: pointer;">
                                        <span class="ms-2" style="font-weight: 600; color: #1e293b;">Sélectionner</span>
                                    </label>
                                </div>
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="col-12">
                        <div class="alert alert-warning text-center">
                            <h5>Aucun produit disponible dans cette catégorie</h5>
                            <p>Veuillez sélectionner une autre catégorie.</p>
                        </div>
                    </div>
                @endforelse
            </div>

            @if($products->count() > 0)
            <div class="row mt-4">
                <div class="col-12">
                    <div class="card" style="border-radius: 16px; box-shadow: 0 4px 20px rgba(0,0,0,0.08);">
                        <div class="card-body">
                            <h4 class="card-title mb-4">Informations de l'entreprise</h4>
                            
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label for="company_name" class="form-label">Nom de l'entreprise *</label>
                                    <input type="text" id="company_name" name="company_name" class="form-control" required />
                                </div>
                                
                                <div class="col-md-6 mb-3">
                                    <label for="email" class="form-label">Email *</label>
                                    <input type="email" id="email" name="email" class="form-control" required />
                                </div>
                            </div>
                            
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label for="phone" class="form-label">Téléphone *</label>
                                    <input type="text" id="phone" name="phone" class="form-control" required />
                                </div>
                            </div>
                            
                            <div class="mb-3">
                                <label for="message" class="form-label">Message (optionnel)</label>
                                <textarea id="message" name="message" class="form-control" rows="3"></textarea>
                            </div>
                            
                            @error('products')
                                <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                            
                            <div class="d-flex justify-content-end">
                                <a href="{{ route('b2b.index') }}" class="btn btn-secondary me-2">Annuler</a>
                                <button type="submit" class="btn btn-primary" style="background: {{ $category->color }}; border: none;">
                                    <i class="fas fa-paper-plane me-2"></i>Envoyer la demande
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            @endif
        </form>
    </div>
</section>

<style>
.b2b-product-card.selected {
    border-color: {{ $category->color }};
    box-shadow: 0 8px 30px rgba(0,0,0,0.15);
}
</style>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const checkboxes = document.querySelectorAll('.b2b-product-checkbox');
    const selectedCount = document.getElementById('selectedCount');
    const minProducts = {{ $category->min_products }};
    
    function updateSelectedCount() {
        const count = document.querySelectorAll('.b2b-product-checkbox:checked').length;
        selectedCount.textContent = count;
        
        if (count < minProducts) {
            selectedCount.className = 'badge bg-secondary';
        } else {
            selectedCount.className = 'badge bg-success';
        }
    }
    
    checkboxes.forEach(checkbox => {
        checkbox.addEventListener('change', function() {
            const card = this.closest('.b2b-product-card');
            if (this.checked) {
                card.classList.add('selected');
            } else {
                card.classList.remove('selected');
            }
            updateSelectedCount();
        });
    });
    
    updateSelectedCount();
});
</script>
@endsection
