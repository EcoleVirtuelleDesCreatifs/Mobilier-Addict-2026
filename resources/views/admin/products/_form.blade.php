@php
    $isEdit = isset($product) && $product;

    $displayPrice = old('price', $isEdit ? ($product->old_price ?: $product->price) : null);
    $displayPromoPrice = old('promo_price', $isEdit ? ($product->old_price ? $product->price : null) : null);

    $selectedSections = old('sections');
    if ($selectedSections === null && $isEdit) {
        $selectedSections = [];
        if ($product->is_collection) {
            $selectedSections[] = 'collection';
        }
        if ($product->is_featured) {
            $selectedSections[] = 'featured';
        }
        if ($product->is_bestseller) {
            $selectedSections[] = 'bestseller';
        }
    }
    $selectedSections = is_array($selectedSections) ? $selectedSections : [];
@endphp

<input type="hidden" name="slug" value="{{ old('slug', $isEdit ? $product->slug : null) }}">

<div class="d-grid gap-3">
    <div class="admin-card p-3">
        <div class="fw-semibold mb-2">Description du produit</div>
        <div class="row g-3">
            <div class="col-12 col-lg-6">
                <label class="form-label">Titre</label>
                <input type="text" name="name" value="{{ old('name', $isEdit ? $product->name : null) }}" class="form-control" required>
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

            <div class="col-12">
                <label class="form-label">Résumé</label>
                <textarea name="short_description" class="form-control" rows="2">{{ old('short_description', $isEdit ? $product->short_description : null) }}</textarea>
            </div>

            <div class="col-12">
                <label class="form-label">Description</label>
                <textarea id="product_description" name="description" class="form-control" rows="8">{{ old('description', $isEdit ? $product->description : null) }}</textarea>
            </div>

            <div class="col-12 col-lg-3">
                <label class="form-label">{{ $isEdit ? 'Prix actuelle' : 'Prix' }}</label>
                <input type="number" step="0.01" name="price" value="{{ $isEdit ? $displayPrice : old('price') }}" class="form-control" required>
            </div>
            <div class="col-12 col-lg-3">
                <label class="form-label">Prix promo</label>
                <input type="number" step="0.01" name="promo_price" value="{{ $isEdit ? $displayPromoPrice : old('promo_price') }}" class="form-control">
            </div>

            <div class="col-12 col-lg-3">
                <label class="form-label">Prix de livraison</label>
                <input type="number" step="0.01" name="shipping_price" value="{{ old('shipping_price', $isEdit ? ($product->shipping_price ?? 0) : 0) }}" class="form-control">
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
        </div>
    </div>

    <div class="admin-card p-3">
        <div class="fw-semibold mb-2">Emplacement du produit</div>
        <div class="row g-3">
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
                <label class="form-label">Menus rattachés</label>
                @php
                    $defaultSelected = $selectedMenuIds ?? ($isEdit ? $product->menus->pluck('id')->all() : []);
                    $selected = old('menu_ids', $defaultSelected);
                    $selected = is_array($selected) ? $selected : [];
                @endphp
                <select name="menu_ids[]" class="form-select" multiple>
                    @foreach(($menus ?? collect()) as $menu)
                        <option value="{{ $menu->id }}" @selected(in_array($menu->id, $selected))>
                            {{ $menu->name }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="col-12 col-lg-4">
                <label class="form-label">Section</label>
                <select name="sections[]" class="form-select" multiple>
                    <option value="collection" @selected(in_array('collection', $selectedSections, true))>Nos Matelas d'Exception (Collection)</option>
                    <option value="featured" @selected(in_array('featured', $selectedSections, true))>Les Essentiels (Mise en avant)</option>
                    <option value="bestseller" @selected(in_array('bestseller', $selectedSections, true))>Best sellers</option>
                </select>
            </div>

            <div class="col-12 col-lg-4">
                <label class="form-label">Stock</label>
                <input type="number" name="stock" value="{{ old('stock', $isEdit ? $product->stock : 0) }}" class="form-control">
            </div>

            <div class="col-12 col-lg-3">
                <label class="form-label">Ordre</label>
                <input type="number" name="order" value="{{ old('order', $isEdit ? $product->order : 0) }}" class="form-control">
            </div>
        </div>
    </div>

    <div class="admin-card p-3">
        <div class="fw-semibold mb-2">Mise à la UNE</div>
        <div class="row g-3">
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
    </div>

    <div class="admin-card p-3">
        <div class="fw-semibold mb-2">AMÉLIORER LE SEO</div>
        <div class="row g-3">
            <div class="col-12">
                <label class="form-label">Meta Title</label>
                <input type="text" name="seo_title" value="{{ old('seo_title', $isEdit ? ($product->seo_title ?? null) : null) }}" class="form-control">
            </div>

            <div class="col-12">
                <label class="form-label">Meta Description</label>
                <textarea name="seo_description" class="form-control" rows="3">{{ old('seo_description', $isEdit ? ($product->seo_description ?? null) : null) }}</textarea>
            </div>

            <div class="col-12">
                <label class="form-label">Mot clé</label>
                <input type="text" name="seo_keywords" value="{{ old('seo_keywords', $isEdit ? ($product->seo_keywords ?? null) : null) }}" class="form-control">
            </div>
        </div>
    </div>
</div>
