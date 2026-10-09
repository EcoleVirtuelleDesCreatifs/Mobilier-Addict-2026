@php
    $isEdit = isset($category) && $category->exists;
    $cat = $category ?? null;
@endphp

<div class="row g-3">
    <div class="col-12 col-lg-8">
        <label class="form-label">Nom de la catégorie <span class="text-danger">*</span></label>
        <input type="text" name="name" id="category-name" value="{{ old('name', $cat?->name) }}" class="form-control" required>
    </div>

    <div class="col-12 col-lg-4">
        <label class="form-label">Slug</label>
        <input type="text" name="slug" id="category-slug" value="{{ old('slug', $cat?->slug) }}" class="form-control" placeholder="Généré automatiquement si vide">
    </div>

    <div class="col-12">
        <label class="form-label">Description</label>
        <textarea name="description" class="form-control" rows="3">{{ old('description', $cat?->description) }}</textarea>
    </div>

    <div class="col-12 col-lg-6">
        <label class="form-label">Image {{ $isEdit ? '' : '*' }}</label>
        <input type="file" name="image" class="form-control" accept="image/*" {{ $isEdit ? '' : 'required' }}>
        @if($isEdit && $cat->image)
            <div class="mt-2 rounded-3 overflow-hidden" style="width:120px;height:120px;border:1px solid var(--admin-border);">
                <img src="@image_url($cat->image)" alt="" style="width:100%;height:100%;object-fit:cover;">
            </div>
        @endif
    </div>

    <div class="col-12 col-lg-6">
        <div class="row g-3">
            <div class="col-12">
                <label class="form-label">Texte alternatif de l'image (SEO)</label>
                <input type="text" name="image_alt" value="{{ old('image_alt', $cat?->image_alt) }}" class="form-control" placeholder="Ex : Canapé 3 places tissu gris">
            </div>
            <div class="col-12">
                <label class="form-label">Couleur</label>
                <div class="d-flex align-items-center gap-2">
                    <input type="color" name="color" value="{{ old('color', $cat?->color ?? '#64748b') }}" class="form-control form-control-color" style="width:60px;height:38px;padding:4px;">
                    <span class="small" style="color: var(--admin-muted);">Couleur d'accent de la catégorie</span>
                </div>
            </div>
        </div>
    </div>

    <div class="col-12 col-lg-6">
        <label class="form-label">Menus rattachés</label>
        @php
            $menuSelected = old('menu_ids', $selectedMenuIds ?? []);
        @endphp
        <select name="menu_ids[]" class="form-select" multiple style="height: 130px;">
            @foreach(($menus ?? collect()) as $menu)
                <option value="{{ $menu->id }}" @selected(in_array($menu->id, $menuSelected))>
                    {{ $menu->name }}
                </option>
            @endforeach
        </select>
        <div class="small mt-1" style="color: var(--admin-muted);">Maintenez Ctrl/Cmd pour plusieurs choix.</div>
    </div>

    <div class="col-12 col-lg-6">
        <div class="row g-3">
            <div class="col-6">
                <label class="form-label">Catégorie parente</label>
                <select name="parent_id" class="form-select">
                    <option value="">— Aucune —</option>
                    @foreach(($parents ?? collect()) as $parent)
                        <option value="{{ $parent->id }}" @selected((string) old('parent_id', $cat?->parent_id) === (string) $parent->id)>
                            {{ $parent->name }}
                        </option>
                    @endforeach
                </select>
            </div>
            <div class="col-6">
                <label class="form-label">Ordre d'affichage</label>
                <input type="number" name="order" value="{{ old('order', $cat?->order ?? 0) }}" class="form-control" min="0">
            </div>
            <div class="col-6">
                <label class="form-label">Taille de la tuile</label>
                <select name="size" class="form-select">
                    @foreach(['small' => 'Petite', 'medium' => 'Moyenne', 'large' => 'Grande'] as $val => $label)
                        <option value="{{ $val }}" @selected(old('size', $cat?->size ?? 'medium') === $val)>{{ $label }}</option>
                    @endforeach
                </select>
            </div>
            <div class="col-6 d-flex align-items-end gap-4 pb-1">
                <div class="form-check">
                    <input type="hidden" name="is_active" value="0">
                    <input class="form-check-input" type="checkbox" name="is_active" value="1" id="is_active"
                        @checked((bool) old('is_active', $cat?->is_active ?? true))>
                    <label class="form-check-label" for="is_active">Active</label>
                </div>
                <div class="form-check">
                    <input type="hidden" name="is_featured" value="0">
                    <input class="form-check-input" type="checkbox" name="is_featured" value="1" id="is_featured"
                        @checked((bool) old('is_featured', $cat?->is_featured ?? false))>
                    <label class="form-check-label" for="is_featured">En vedette</label>
                </div>
            </div>
        </div>
    </div>

    <div class="col-12">
        <label class="form-label">Produits rattachés</label>
        <input type="text" id="product-search" class="form-control mb-2" placeholder="Filtrer les produits…">
        @php
            $productSelected = old('product_ids', $selectedProductIds ?? []);
        @endphp
        <select name="product_ids[]" id="product-select" class="form-select" multiple style="height: 200px;">
            @foreach(($products ?? collect()) as $product)
                <option value="{{ $product->id }}" @selected(in_array($product->id, $productSelected))>
                    {{ $product->name }} ({{ number_format((float) $product->price, 0, ',', '.') }} F)
                </option>
            @endforeach
        </select>
        <div class="small mt-1" style="color: var(--admin-muted);">Sélectionnez les produits à afficher dans cette catégorie.</div>
    </div>

    <div class="col-12 d-flex justify-content-end gap-2">
        <a href="{{ route('admin.categories.index') }}" class="btn btn-admin-ghost">Annuler</a>
        <button type="submit" class="btn btn-admin-primary">{{ $isEdit ? 'Enregistrer' : 'Créer' }}</button>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function () {
    // Auto-slug depuis le nom (seulement si le champ slug est vide)
    var nameInput = document.getElementById('category-name');
    var slugInput = document.getElementById('category-slug');
    if (nameInput && slugInput) {
        nameInput.addEventListener('input', function () {
            if (slugInput.dataset.touched === '1') return;
            slugInput.value = this.value
                .toLowerCase()
                .normalize('NFD').replace(/[̀-ͯ]/g, '')
                .replace(/[^a-z0-9]+/g, '-')
                .replace(/^-+|-+$/g, '');
        });
        slugInput.addEventListener('input', function () {
            this.dataset.touched = this.value === '' ? '0' : '1';
        });
    }

    // Filtre de recherche sur le select produits
    var search = document.getElementById('product-search');
    var select = document.getElementById('product-select');
    if (search && select) {
        var options = Array.from(select.options);
        search.addEventListener('input', function () {
            var q = this.value.toLowerCase();
            options.forEach(function (opt) {
                opt.hidden = q !== '' && opt.textContent.toLowerCase().indexOf(q) === -1;
            });
        });
    }
});
</script>
