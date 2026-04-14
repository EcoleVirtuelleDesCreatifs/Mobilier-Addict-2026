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
                    <h4 class="card-title mb-4">AJOUTER UNE CATÉGORIE B2B</h4>

                    <form action="{{ route('admin.b2b.store') }}" method="POST">
                        @csrf

                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="key" class="form-label">Clé *</label>
                                    <input type="text" id="key" name="key" class="form-control" value="{{ old('key') }}" required maxlength="255" />
                                    <small class="text-muted">Identifiant unique (ex: medicosoins)</small>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="name" class="form-label">Nom *</label>
                                    <input type="text" id="name" name="name" class="form-control" value="{{ old('name') }}" required maxlength="255" />
                                </div>
                            </div>
                        </div>

                        <div class="mb-3">
                            <label for="description" class="form-label">Description</label>
                            <input type="text" id="description" name="description" class="form-control" value="{{ old('description') }}" maxlength="255" />
                        </div>

                        <div class="row">
                            <div class="col-md-4">
                                <div class="mb-3">
                                    <label for="color" class="form-label">Couleur *</label>
                                    <input type="color" id="color" name="color" class="form-control form-control-color" value="{{ old('color', '#3b82f6') }}" required />
                                </div>
                            </div>

                            <div class="col-md-4">
                                <div class="mb-3">
                                    <label for="min_products" class="form-label">Minimum de produits *</label>
                                    <input type="number" id="min_products" name="min_products" class="form-control" value="{{ old('min_products', 5) }}" required min="1" />
                                    <small class="text-muted">Nombre minimum de produits à commander</small>
                                </div>
                            </div>

                            <div class="col-md-4">
                                <div class="mb-3">
                                    <label for="is_active" class="form-label">Statut</label>
                                    <select id="is_active" name="is_active" class="form-select">
                                        <option value="1" {{ old('is_active', true) ? 'selected' : '' }}>Actif</option>
                                        <option value="0" {{ !old('is_active', true) ? 'selected' : '' }}>Inactif</option>
                                    </select>
                                </div>
                            </div>
                        </div>

                        <div class="mb-3">
                            <label for="products" class="form-label">Produits associés</label>
                            <select id="products" name="products[]" class="form-select" multiple style="height: 200px;">
                                @foreach($products as $product)
                                    <option value="{{ $product->id }}" {{ old('products') && in_array($product->id, old('products')) ? 'selected' : '' }}>
                                        {{ $product->name }} - {{ $product->price }} F
                                    </option>
                                @endforeach
                            </select>
                            <small class="text-muted">Maintenez Ctrl (ou Cmd sur Mac) pour sélectionner plusieurs produits</small>
                        </div>

                        @error('key')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror

                        <div class="d-flex justify-content-end gap-2 mt-4">
                            <a href="{{ route('admin.b2b.index') }}" class="btn btn-secondary">Annuler</a>
                            <button type="submit" class="btn btn-primary">
                                <i class="fas fa-save me-2"></i>Enregistrer
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
