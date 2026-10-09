@extends('layouts.admin')

@section('content')
    <!--**********************************
                Content body start
            ***********************************-->
    <div class="content-body">
        <div class="container-fluid">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body" style="max-height: none; overflow: visible;">
                        <h4 class="card-title mb-4">MODIFIER LA CATÉGORIE B2B</h4>

                        <form action="{{ route('admin.b2b.update', $b2bCategory) }}" method="POST">
                            @csrf
                            @method('PUT')

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="key" class="form-label">Clé *</label>
                                        <input type="text" id="key" name="key" class="form-control"
                                            value="{{ old('key', $b2bCategory->key) }}" required maxlength="255" />
                                        <small class="text-muted">Identifiant unique (ex: medicosoins)</small>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="name" class="form-label">Nom *</label>
                                        <input type="text" id="name" name="name" class="form-control"
                                            value="{{ old('name', $b2bCategory->name) }}" required maxlength="255" />
                                    </div>
                                </div>
                            </div>

                            <div class="mb-3">
                                <label for="description" class="form-label">Description</label>
                                <input type="text" id="description" name="description" class="form-control"
                                    value="{{ old('description', $b2bCategory->description) }}" maxlength="255" />
                            </div>

                            <div class="row">
                                <div class="col-md-4">
                                    <div class="mb-3">
                                        <label for="color" class="form-label">Couleur *</label>
                                        <input type="color" id="color" name="color"
                                            class="form-control form-control-color"
                                            value="{{ old('color', $b2bCategory->color) }}" required />
                                    </div>
                                </div>

                                <div class="col-md-4">
                                    <div class="mb-3">
                                        <label for="min_products" class="form-label">Minimum de produits *</label>
                                        <input type="number" id="min_products" name="min_products" class="form-control"
                                            value="{{ old('min_products', $b2bCategory->min_products) }}" required
                                            min="1" />
                                        <small class="text-muted">Nombre minimum de produits à commander</small>
                                    </div>
                                </div>

                                <div class="col-md-4">
                                    <div class="mb-3">
                                        <label for="is_active" class="form-label">Statut</label>
                                        <select id="is_active" name="is_active" class="form-select">
                                            <option value="1"
                                                {{ old('is_active', $b2bCategory->is_active) ? 'selected' : '' }}>Actif
                                            </option>
                                            <option value="0"
                                                {{ !old('is_active', $b2bCategory->is_active) ? 'selected' : '' }}>Inactif
                                            </option>
                                        </select>
                                    </div>
                                </div>
                            </div>

                            <div class="mb-3">
                                <label for="products" class="form-label">Produits associés</label>
                                <div class="row" style="max-height: 400px; overflow-y: auto;">
                                    @foreach ($products as $product)
                                        <div class="col-md-4 col-lg-3 mb-3">
                                            <div class="card h-100 {{ $b2bCategory->products->contains($product->id) ? 'border-primary' : '' }}"
                                                style="cursor: pointer; transition: all 0.2s ease;"
                                                onclick="toggleProduct({{ $product->id }})">
                                                <div class="card-body p-2">
                                                    <div class="form-check">
                                                        <input class="form-check-input product-checkbox" type="checkbox"
                                                            name="products[]" value="{{ $product->id }}"
                                                            id="product-{{ $product->id }}"
                                                            {{ $b2bCategory->products->contains($product->id) ? 'checked' : '' }}
                                                            onclick="event.stopPropagation()">
                                                        <label class="form-check-label"
                                                            for="product-{{ $product->id }}"></label>
                                                    </div>
                                                    @if ($product->image)
                                                        <img src="{{ asset($product->image) }}" alt="{{ $product->name }}"
                                                            class="img-fluid rounded mb-2"
                                                            style="height: 100px; object-fit: cover; width: 100%;">
                                                    @else
                                                        <div class="bg-light rounded mb-2 d-flex align-items-center justify-content-center"
                                                            style="height: 100px;">
                                                            <i class="fas fa-image text-muted" style="font-size: 2rem;"></i>
                                                        </div>
                                                    @endif
                                                    <h6 class="card-title mb-1" style="font-size: 0.9rem;">
                                                        {{ \Illuminate\Support\Str::limit($product->name, 30) }}</h6>
                                                    <p class="card-text mb-0" style="font-size: 0.85rem;">
                                                        {{ $product->price }} F</p>
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                                <small class="text-muted">Cliquez sur les cartes pour sélectionner les produits</small>
                            </div>

                            <script>
                                function toggleProduct(productId) {
                                    const checkbox = document.getElementById('product-' + productId);
                                    checkbox.checked = !checkbox.checked;
                                    const card = checkbox.closest('.card');
                                    if (checkbox.checked) {
                                        card.classList.add('border-primary');
                                    } else {
                                        card.classList.remove('border-primary');
                                    }
                                }
                            </script>

                            @error('key')
                                <div class="alert alert-danger">{{ $message }}</div>
                            @enderror

                            <div class="d-flex justify-content-end gap-2 mt-4">
                                <a href="{{ route('admin.b2b.index') }}" class="btn btn-secondary">Annuler</a>
                                <button type="submit" class="btn btn-primary">
                                    <i class="fas fa-save me-2"></i>Mettre à jour
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
