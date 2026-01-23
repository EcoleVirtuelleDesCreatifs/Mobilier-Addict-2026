@extends('admin.layout')

@section('content')
    <div class="d-flex align-items-center justify-content-between gap-3 mb-4">
        <div>
            <h1 class="h3 fw-bold mb-1">Modifier produit</h1>
            <div class="small" style="color: var(--admin-muted);">{{ $product->name }}</div>
        </div>
        <a href="{{ route('admin.products.index') }}" class="btn btn-admin-ghost">Retour</a>
    </div>

    @if ($errors->any())
        <div class="alert alert-danger">
            <div class="fw-semibold mb-1">Veuillez corriger les erreurs :</div>
            <ul class="mb-0">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form method="POST" action="{{ route('admin.products.update', $product) }}" enctype="multipart/form-data" class="admin-card p-4">
        @csrf
        @method('PUT')

        <div class="row g-3">
            <div class="col-12 col-lg-6">
                <label class="form-label">Nom</label>
                <input type="text" name="name" value="{{ old('name', $product->name) }}" class="form-control" required>
            </div>
            <div class="col-12 col-lg-6">
                <label class="form-label">Slug</label>
                <input type="text" name="slug" value="{{ old('slug', $product->slug) }}" class="form-control">
            </div>

            <div class="col-12">
                <label class="form-label">Description courte</label>
                <textarea name="short_description" class="form-control" rows="2">{{ old('short_description', $product->short_description) }}</textarea>
            </div>

            <div class="col-12">
                <label class="form-label">Description</label>
                <textarea id="product_description" name="description" class="form-control" rows="8">{{ old('description', $product->description) }}</textarea>
            </div>

            <div class="col-12 col-lg-6">
                <label class="form-label">Image (laisser vide pour conserver)</label>
                <input type="file" name="image" class="form-control">
                <div class="mt-2 rounded-3 overflow-hidden" style="width:120px;height:120px;border:1px solid var(--admin-border);">
                    <img src="{{ asset($product->image) }}" alt="" style="width:100%;height:100%;object-fit:cover;">
                </div>
            </div>

            <div class="col-12 col-lg-3">
                <label class="form-label">Prix</label>
                <input type="number" step="0.01" name="price" value="{{ old('price', $product->price) }}" class="form-control" required>
            </div>
            <div class="col-12 col-lg-3">
                <label class="form-label">Ancien prix</label>
                <input type="number" step="0.01" name="old_price" value="{{ old('old_price', $product->old_price) }}" class="form-control">
            </div>

            <div class="col-12 col-lg-4">
                <label class="form-label">Catégorie</label>
                <select name="category_id" class="form-select">
                    <option value="">—</option>
                    @foreach($categories as $category)
                        <option value="{{ $category->id }}" @selected(old('category_id', $product->category_id) == $category->id)>{{ $category->name }}</option>
                    @endforeach
                </select>
            </div>
            <div class="col-12 col-lg-4">
                <label class="form-label">SKU</label>
                <input type="text" name="sku" value="{{ old('sku', $product->sku) }}" class="form-control">
            </div>
            <div class="col-12 col-lg-4">
                <label class="form-label">Stock</label>
                <input type="number" name="stock" value="{{ old('stock', $product->stock) }}" class="form-control">
            </div>

            <div class="col-12 col-lg-3">
                <label class="form-label">Badge</label>
                <input type="text" name="badge" value="{{ old('badge', $product->badge) }}" class="form-control">
            </div>
            <div class="col-12 col-lg-3">
                <label class="form-label">Type badge</label>
                <select name="badge_type" class="form-select">
                    <option value="">—</option>
                    @foreach(['new' => 'New', 'hot' => 'Hot', 'sale' => 'Sale', 'custom' => 'Custom'] as $k => $v)
                        <option value="{{ $k }}" @selected(old('badge_type', $product->badge_type) === $k)>{{ $v }}</option>
                    @endforeach
                </select>
            </div>
            <div class="col-12 col-lg-3">
                <label class="form-label">Ordre</label>
                <input type="number" name="order" value="{{ old('order', $product->order) }}" class="form-control">
            </div>
            <div class="col-12 col-lg-3">
                <label class="form-label">Actif</label>
                <select name="is_active" class="form-select">
                    <option value="1" @selected(old('is_active', $product->is_active ? 1 : 0) == 1)>Oui</option>
                    <option value="0" @selected(old('is_active', $product->is_active ? 1 : 0) == 0)>Non</option>
                </select>
            </div>

            <div class="col-12">
                <div class="d-flex flex-wrap gap-3">
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" name="is_featured" value="1" id="is_featured" @checked(old('is_featured', $product->is_featured))>
                        <label class="form-check-label" for="is_featured">Mis en avant</label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" name="is_bestseller" value="1" id="is_bestseller" @checked(old('is_bestseller', $product->is_bestseller))>
                        <label class="form-check-label" for="is_bestseller">Best seller</label>
                    </div>
                </div>
            </div>

            <div class="col-12 d-flex justify-content-end gap-2">
                <a href="{{ route('admin.products.index') }}" class="btn btn-admin-ghost">Annuler</a>
                <button type="submit" class="btn btn-admin-primary">Enregistrer</button>
            </div>
        </div>
    </form>
@endsection

@push('scripts')
    <script src="https://cdn.ckeditor.com/ckeditor5/40.2.0/classic/ckeditor.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            if (window.ClassicEditor) {
                ClassicEditor.create(document.querySelector('#product_description')).catch(function () {});
            }
        });
    </script>
@endpush
