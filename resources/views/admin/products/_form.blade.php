@php
    $isEdit = isset($product) && $product;

    $displayPrice = old('price', $isEdit ? ($product->old_price ?: $product->price) : null);
    $displayPromoPrice = old('promo_price', $isEdit ? ($product->old_price ? $product->price : null) : null);

    $selectedSection = old('section');
    if ($selectedSection === null && $isEdit) {
        $selectedSection = $product->is_collection
            ? 'collection'
            : ($product->is_featured ? 'featured' : ($product->is_bestseller ? 'bestseller' : ''));
    }
@endphp

<div class="row g-3">
    <div class="col-12 col-lg-6">
        <label class="form-label">Nom</label>
        <input type="text" name="name" value="{{ old('name', $isEdit ? $product->name : null) }}" class="form-control" required>
    </div>
    <input type="hidden" name="slug" value="{{ old('slug', $isEdit ? $product->slug : null) }}">

    <div class="col-12">
        <label class="form-label">Description courte</label>
        <textarea name="short_description" class="form-control" rows="2">{{ old('short_description', $isEdit ? $product->short_description : null) }}</textarea>
    </div>

    <div class="col-12">
        <label class="form-label">Description</label>
        <textarea id="product_description" name="description" class="form-control" rows="8">{{ old('description', $isEdit ? $product->description : null) }}</textarea>
    </div>

    <div class="col-12 col-lg-6">
        <label class="form-label">Image{{ $isEdit ? ' (laisser vide pour conserver)' : '' }}</label>
        <input type="file" name="image" class="form-control" {{ $isEdit ? '' : 'required' }}>
        @if($isEdit)
            <div class="mt-2 rounded-3 overflow-hidden" style="width:120px;height:120px;border:1px solid var(--admin-border);">
                <img src="{{ asset($product->image) }}" alt="" style="width:100%;height:100%;object-fit:cover;">
            </div>
        @endif
    </div>

    <div class="col-12 col-lg-6">
        <label class="form-label">Images (plusieurs)</label>
        <input type="file" name="gallery[]" class="form-control" multiple>
        @if($isEdit && !empty($product->gallery))
            <div class="d-flex flex-wrap gap-2 mt-2">
                @foreach($product->gallery as $img)
                    <div class="rounded-3 overflow-hidden" style="width:72px;height:72px;border:1px solid var(--admin-border);">
                        <img src="{{ asset($img) }}" alt="" style="width:100%;height:100%;object-fit:cover;">
                    </div>
                @endforeach
            </div>
        @endif
    </div>

    <div class="col-12 col-lg-3">
        <label class="form-label">{{ $isEdit ? 'Prix actuelle' : 'Prix' }}</label>
        <input type="number" step="0.01" name="price" value="{{ $isEdit ? $displayPrice : old('price') }}" class="form-control" required>
    </div>
    <div class="col-12 col-lg-3">
        <label class="form-label">Prix promo</label>
        <input type="number" step="0.01" name="promo_price" value="{{ $isEdit ? $displayPromoPrice : old('promo_price') }}" class="form-control">
    </div>

    <div class="col-12 col-lg-4">
        <label class="form-label">Catégorie</label>
        <select name="category_id" class="form-select">
            <option value="">—</option>
            @foreach($categories as $category)
                <option value="{{ $category->id }}" @selected(old('category_id', $isEdit ? $product->category_id : null) == $category->id)>{{ $category->name }}</option>
            @endforeach
        </select>
    </div>
    <div class="col-12 col-lg-4">
        <label class="form-label">Section</label>
        <select name="section" class="form-select">
            <option value="" @selected(($selectedSection ?? '') === '')>—</option>
            <option value="collection" @selected($selectedSection === 'collection')>Nos Matelas d'Exception (Collection)</option>
            <option value="featured" @selected($selectedSection === 'featured')>Les Essentiels (Mise en avant)</option>
            <option value="bestseller" @selected($selectedSection === 'bestseller')>Best sellers</option>
        </select>
    </div>
    <div class="col-12 col-lg-4">
        <label class="form-label">SKU</label>
        <input type="text" name="sku" value="{{ old('sku', $isEdit ? $product->sku : null) }}" class="form-control">
    </div>

    <div class="col-12 col-lg-4">
        <label class="form-label">Stock</label>
        <input type="number" name="stock" value="{{ old('stock', $isEdit ? $product->stock : 0) }}" class="form-control">
    </div>

    <div class="col-12 col-lg-3">
        <label class="form-label">Badge</label>
        <input type="text" name="badge" value="{{ old('badge', $isEdit ? $product->badge : null) }}" class="form-control">
    </div>
    <div class="col-12 col-lg-3">
        <label class="form-label">Type badge</label>
        <select name="badge_type" class="form-select">
            <option value="">—</option>
            @foreach(['new' => 'New', 'hot' => 'Hot', 'sale' => 'Sale', 'custom' => 'Custom'] as $k => $v)
                <option value="{{ $k }}" @selected(old('badge_type', $isEdit ? $product->badge_type : null) === $k)>{{ $v }}</option>
            @endforeach
        </select>
    </div>
    <div class="col-12 col-lg-3">
        <label class="form-label">Ordre</label>
        <input type="number" name="order" value="{{ old('order', $isEdit ? $product->order : 0) }}" class="form-control">
    </div>
    <div class="col-12 col-lg-3">
        <label class="form-label">En ligne</label>
        <select name="is_active" class="form-select">
            @php $activeValue = old('is_active', $isEdit ? ($product->is_active ? 1 : 0) : 1); @endphp
            <option value="1" @selected($activeValue == 1)>En ligne</option>
            <option value="0" @selected($activeValue == 0)>Hors ligne</option>
        </select>
    </div>

    <div class="col-12">
        <div class="d-flex flex-wrap gap-3">
            <div class="form-check">
                <input class="form-check-input" type="checkbox" name="is_featured" value="1" id="is_featured" @checked(old('is_featured', $isEdit ? $product->is_featured : false))>
                <label class="form-check-label" for="is_featured">Mis en avant</label>
            </div>
            <div class="form-check">
                <input class="form-check-input" type="checkbox" name="is_bestseller" value="1" id="is_bestseller" @checked(old('is_bestseller', $isEdit ? $product->is_bestseller : false))>
                <label class="form-check-label" for="is_bestseller">Best seller</label>
            </div>
        </div>
    </div>
</div>
