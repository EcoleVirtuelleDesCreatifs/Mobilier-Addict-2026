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

    $variantRows = old('variants');
    if ($variantRows === null && $isEdit) {
        $variantRows = ($product->variants ?? collect())
            ->map(fn ($v) => [
                'id' => $v->id,
                'variant_type' => $v->variant_type,
                'thickness_cm' => $v->thickness_cm,
                'places' => $v->places,
                'price' => $v->price,
                'stock' => $v->stock,
                'is_active' => $v->is_active ? 1 : 0,
            ])
            ->values()
            ->all();
    }
    $variantRows = is_array($variantRows) ? $variantRows : [];
@endphp

<input type="hidden" name="slug" value="{{ old('slug', $isEdit ? $product->slug : null) }}">
<input type="hidden" name="variants_enabled" value="1">

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
        <div class="d-flex align-items-center justify-content-between gap-3 mb-2">
            <div class="fw-semibold">Variantes (Matelas: Épaisseur/Places • Couette: Type/Places)</div>
            <button type="button" class="btn btn-sm btn-admin-ghost" id="addVariantRow">Ajouter une variante</button>
        </div>
        <div class="small mb-3" style="color: var(--admin-muted);">Pour les matelas: renseigne Épaisseur + Places. Pour les couettes: renseigne Type + Places (Épaisseur = 0).</div>

        <div class="table-responsive">
            <table class="table table-dark table-borderless align-middle mb-0" style="--bs-table-bg: transparent; min-width: 760px;">
                <thead style="color: var(--admin-muted);">
                    <tr>
                        <th style="width:220px;">Type (Couette)</th>
                        <th style="width:160px;">Épaisseur (cm)</th>
                        <th style="width:140px;">Places</th>
                        <th style="width:200px;">Prix (FCFA)</th>
                        <th style="width:160px;">Stock</th>
                        <th style="width:160px;">Actif</th>
                        <th style="width:80px;"></th>
                    </tr>
                </thead>
                <tbody id="variantsTbody" style="border-top: 1px solid var(--admin-border);">
                    @forelse($variantRows as $i => $row)
                        <tr>
                            <td>
                                <input type="text" class="form-control" name="variants[{{ $i }}][variant_type]" value="{{ $row['variant_type'] ?? '' }}" placeholder="Ex: Type A / Drap coton">
                            </td>
                            <td>
                                <input type="hidden" name="variants[{{ $i }}][id]" value="{{ $row['id'] ?? '' }}">
                                <input type="number" class="form-control" name="variants[{{ $i }}][thickness_cm]" value="{{ $row['thickness_cm'] ?? '' }}" min="0" step="1" placeholder="Ex: 30">
                            </td>
                            <td>
                                <input type="number" class="form-control" name="variants[{{ $i }}][places]" value="{{ $row['places'] ?? '' }}" min="1" step="1" placeholder="Ex: 2">
                            </td>
                            <td>
                                <input type="number" class="form-control" name="variants[{{ $i }}][price]" value="{{ $row['price'] ?? '' }}" min="0" step="1" placeholder="Ex: 105000">
                            </td>
                            <td>
                                <input type="number" class="form-control" name="variants[{{ $i }}][stock]" value="{{ $row['stock'] ?? 0 }}" min="0" step="1">
                            </td>
                            <td>
                                @php $va = isset($row['is_active']) ? (int) $row['is_active'] : 1; @endphp
                                <select class="form-select" name="variants[{{ $i }}][is_active]">
                                    <option value="1" @selected($va === 1)>Actif</option>
                                    <option value="0" @selected($va === 0)>Inactif</option>
                                </select>
                            </td>
                            <td class="text-end">
                                <button type="button" class="btn btn-sm btn-danger" data-role="remove-variant">×</button>
                            </td>
                        </tr>
                    @empty
                        <tr id="variantsEmptyRow">
                            <td colspan="7" style="color: var(--admin-muted);">Aucune variante. Clique sur “Ajouter une variante”.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <template id="variantRowTemplate">
            <tr>
                <td>
                    <input type="text" class="form-control" data-name="variant_type" placeholder="Ex: Type A / Drap coton">
                </td>
                <td>
                    <input type="hidden" data-name="id" value="">
                    <input type="number" class="form-control" data-name="thickness_cm" min="0" step="1" placeholder="Ex: 30">
                </td>
                <td>
                    <input type="number" class="form-control" data-name="places" min="1" step="1" placeholder="Ex: 2">
                </td>
                <td>
                    <input type="number" class="form-control" data-name="price" min="0" step="1" placeholder="Ex: 105000">
                </td>
                <td>
                    <input type="number" class="form-control" data-name="stock" min="0" step="1" value="0">
                </td>
                <td>
                    <select class="form-select" data-name="is_active">
                        <option value="1">Actif</option>
                        <option value="0">Inactif</option>
                    </select>
                </td>
                <td class="text-end">
                    <button type="button" class="btn btn-sm btn-danger" data-role="remove-variant">×</button>
                </td>
            </tr>
        </template>

        <script>
        document.addEventListener('DOMContentLoaded', () => {
            const tbody = document.getElementById('variantsTbody');
            const addBtn = document.getElementById('addVariantRow');
            const tpl = document.getElementById('variantRowTemplate');

            if (!tbody || !addBtn || !tpl) return;

            const getNextIndex = () => {
                const rows = tbody.querySelectorAll('tr');
                let max = -1;
                rows.forEach(r => {
                    const any = r.querySelector('input[name^="variants["]');
                    if (!any) return;
                    const name = any.getAttribute('name') || '';
                    const m = name.match(/^variants\[(\d+)\]/);
                    if (m) max = Math.max(max, parseInt(m[1], 10));
                });
                return max + 1;
            };

            const syncRowNames = (row, index) => {
                row.querySelectorAll('[data-name]').forEach(el => {
                    const field = el.getAttribute('data-name');
                    el.setAttribute('name', `variants[${index}][${field}]`);
                    el.removeAttribute('data-name');
                });
            };

            const removeEmptyRow = () => {
                const empty = document.getElementById('variantsEmptyRow');
                if (empty) empty.remove();
            };

            const addRow = () => {
                removeEmptyRow();
                const frag = tpl.content.cloneNode(true);
                const tr = frag.querySelector('tr');
                const idx = getNextIndex();
                syncRowNames(tr, idx);
                tbody.appendChild(tr);
            };

            addBtn.addEventListener('click', addRow);

            tbody.addEventListener('click', (e) => {
                const btn = e.target && e.target.closest ? e.target.closest('[data-role="remove-variant"]') : null;
                if (!btn) return;
                const tr = btn.closest('tr');
                if (tr) tr.remove();

                if (tbody.querySelectorAll('tr').length === 0) {
                    const empty = document.createElement('tr');
                    empty.id = 'variantsEmptyRow';
                    empty.innerHTML = '<td colspan="7" style="color: var(--admin-muted);">Aucune variante. Clique sur “Ajouter une variante”.</td>';
                    tbody.appendChild(empty);
                }
            });
        });
        </script>
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
