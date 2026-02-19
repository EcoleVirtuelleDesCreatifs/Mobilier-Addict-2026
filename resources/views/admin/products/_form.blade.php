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

    $defaultVariantMode = 'standard';
    if ($isEdit && ($product->variants ?? collect())->contains(fn ($v) => ($v->variant_type ?? null) === 'chairs')) {
        $defaultVariantMode = 'chairs';
    }
    $variantMode = old('variant_mode', $defaultVariantMode);
    $variantMode = in_array($variantMode, ['standard', 'chairs'], true) ? $variantMode : $defaultVariantMode;

    $selectedCategoryIds = old('category_ids', $selectedCategoryIds ?? ($isEdit ? (($product->categories ?? collect())->pluck('id')->all()) : []));
    $selectedCategoryIds = is_array($selectedCategoryIds) ? $selectedCategoryIds : [];
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
                    <div class="mt-2 d-flex align-items-end gap-2" data-image-block>
                        <div class="rounded-3 overflow-hidden" style="width:120px;height:120px;border:1px solid var(--admin-border);">
                            <img src="@image_url($product->image)" alt="" style="width:100%;height:100%;object-fit:cover;">
                        </div>
                        @if(!empty($product->image))
                            <button
                                type="button"
                                class="btn btn-sm btn-danger"
                                style="width:34px;height:34px;display:inline-flex;align-items:center;justify-content:center;padding:0;border-radius:10px;"
                                data-delete-url="{{ route('admin.products.image.destroy', $product) }}"
                                data-confirm="Supprimer l'image principale ?"
                                aria-label="Supprimer l'image"
                                title="Supprimer"
                            >&times;</button>
                        @endif
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
                <label class="form-label">Couleurs disponibles (Drap &amp; Taie)</label>
                @php
                    $colorsValue = old('available_colors', $isEdit ? ($product->available_colors ?? []) : []);
                    $colorsValue = is_array($colorsValue) ? $colorsValue : [];
                    $colorsValue = array_values(array_unique(array_filter(array_map('trim', array_map('strval', $colorsValue)))));
                    $suggestedColors = [
                        'Blanc',
                        'Bleu',
                        'Gris',
                        'Beige',
                        'Rouge',
                        'Violet',
                        'Vert',
                        'Rose',
                        'Marron',
                        'Jaune',
                    ];

                    $colorHex = [
                        'Blanc' => '#ffffff',
                        'Bleu' => '#2563eb',
                        'Gris' => '#9ca3af',
                        'Beige' => '#d6c6a6',
                        'Rouge' => '#dc2626',
                        'Violet' => '#7c3aed',
                        'Vert' => '#16a34a',
                        'Rose' => '#ec4899',
                        'Marron' => '#7c4a2d',
                        'Jaune' => '#facc15',
                    ];
                @endphp
                <div data-role="color-picker" class="rounded-3" style="border:1px solid var(--admin-border); padding:10px; background: rgba(255,255,255,.03);">
                    <div class="d-flex flex-wrap gap-2">
                        @foreach($suggestedColors as $c)
                            @php
                                $hex = $colorHex[$c] ?? '#ffffff';
                                $isSelected = in_array($c, $colorsValue, true);
                            @endphp
                            <button
                                type="button"
                                data-color="{{ $c }}"
                                data-selected="{{ $isSelected ? '1' : '0' }}"
                                class="btn btn-sm"
                                style="display:flex;align-items:center;gap:8px;border-radius:999px;border:1px solid var(--admin-border); background: {{ $isSelected ? 'rgba(255,255,255,.08)' : 'transparent' }}; color: inherit;"
                            >
                                <span style="width:16px;height:16px;border-radius:999px;background: {{ $hex }}; border: 1px solid rgba(255,255,255,.35);"></span>
                                <span>{{ $c }}</span>
                                <span data-check style="margin-left:2px; {{ $isSelected ? '' : 'display:none' }}">✓</span>
                            </button>
                        @endforeach
                    </div>

                    <div class="mt-3 d-flex gap-2">
                        <input type="text" class="form-control" data-role="custom-color" placeholder="Ajouter une couleur (ex: Turquoise)">
                        <button type="button" class="btn btn-admin" data-role="add-custom-color">Ajouter</button>
                    </div>

                    <div class="mt-2" data-role="selected-inputs">
                        @foreach($colorsValue as $c)
                            <input type="hidden" name="available_colors[]" value="{{ $c }}">
                        @endforeach
                    </div>
                </div>

                <script>
                    document.addEventListener('DOMContentLoaded', function () {
                        const root = document.querySelector('[data-role="color-picker"]');
                        if (!root) return;

                        const inputsWrap = root.querySelector('[data-role="selected-inputs"]');
                        const customInput = root.querySelector('[data-role="custom-color"]');
                        const addBtn = root.querySelector('[data-role="add-custom-color"]');

                        const normalize = (v) => String(v || '').trim();
                        const getSelected = () => {
                            const values = [];
                            inputsWrap.querySelectorAll('input[name="available_colors[]"]').forEach(i => {
                                const v = normalize(i.value);
                                if (v) values.push(v);
                            });
                            return values;
                        };

                        const setSelected = (values) => {
                            inputsWrap.innerHTML = '';
                            const uniq = [];
                            values.forEach(v => {
                                const val = normalize(v);
                                if (!val) return;
                                if (uniq.includes(val)) return;
                                uniq.push(val);
                            });
                            uniq.forEach(v => {
                                const input = document.createElement('input');
                                input.type = 'hidden';
                                input.name = 'available_colors[]';
                                input.value = v;
                                inputsWrap.appendChild(input);
                            });
                        };

                        root.querySelectorAll('[data-color]').forEach(btn => {
                            btn.addEventListener('click', () => {
                                const color = normalize(btn.getAttribute('data-color'));
                                if (!color) return;
                                const selected = getSelected();
                                const isSelected = selected.includes(color);
                                const next = isSelected ? selected.filter(v => v !== color) : [...selected, color];
                                setSelected(next);

                                btn.setAttribute('data-selected', isSelected ? '0' : '1');
                                btn.style.background = isSelected ? 'transparent' : 'rgba(255,255,255,.08)';
                                const check = btn.querySelector('[data-check]');
                                if (check) check.style.display = isSelected ? 'none' : '';
                            });
                        });

                        if (addBtn && customInput) {
                            addBtn.addEventListener('click', () => {
                                const v = normalize(customInput.value);
                                if (!v) return;
                                const selected = getSelected();
                                if (!selected.includes(v)) {
                                    setSelected([...selected, v]);
                                }
                                customInput.value = '';
                            });
                        }
                    });
                </script>
            </div>

            <div class="col-12 col-lg-6">
                <label class="form-label">Images (plusieurs)</label>
                <input type="file" name="gallery[]" class="form-control" multiple>
                @if($isEdit && !empty($product->gallery))
                    <div class="d-flex flex-wrap gap-2 mt-2">
                        @foreach($product->gallery as $i => $img)
                            <div class="d-flex flex-column gap-1" data-gallery-item>
                                <div class="rounded-3 overflow-hidden" style="width:72px;height:72px;border:1px solid var(--admin-border);">
                                    <img src="@image_url($img)" alt="" style="width:100%;height:100%;object-fit:cover;">
                                </div>
                                <button
                                    type="button"
                                    class="btn btn-sm btn-danger"
                                    style="padding:2px 8px;"
                                    data-delete-url="{{ route('admin.products.gallery.destroy', [$product, $i]) }}"
                                    data-confirm="Supprimer cette image ?"
                                    aria-label="Supprimer l'image"
                                    title="Supprimer"
                                >&times;</button>
                            </div>
                        @endforeach
                    </div>
                @endif
            </div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const csrf = document.querySelector('meta[name="csrf-token"]')?.getAttribute('content') || '';
            document.querySelectorAll('[data-delete-url]').forEach(function (btn) {
                btn.addEventListener('click', async function () {
                    const url = btn.getAttribute('data-delete-url');
                    if (!url) return;

                    const message = btn.getAttribute('data-confirm') || 'Confirmer la suppression ?';
                    if (!confirm(message)) return;

                    btn.disabled = true;
                    try {
                        const res = await fetch(url, {
                            method: 'POST',
                            headers: {
                                'X-CSRF-TOKEN': csrf,
                                'X-Requested-With': 'XMLHttpRequest',
                                'Content-Type': 'application/json',
                                'Accept': 'application/json',
                            },
                            body: JSON.stringify({ _method: 'DELETE' }),
                            credentials: 'same-origin',
                        });

                        if (!res.ok) {
                            window.location.href = url;
                            return;
                        }

                        const galleryItem = btn.closest('[data-gallery-item]');
                        if (galleryItem) {
                            galleryItem.remove();
                            return;
                        }

                        const imageBlock = btn.closest('[data-image-block]');
                        if (imageBlock) {
                            imageBlock.remove();
                            return;
                        }
                    } catch (e) {
                        window.location.href = url;
                    }
                });
            });
        });
    </script>

    <div class="admin-card p-3">
        <div class="d-flex align-items-center justify-content-between gap-3 mb-2">
            <div class="fw-semibold">Variantes</div>
            <div class="d-flex align-items-center gap-2">
                <select class="form-select form-select-sm" name="variant_mode" id="variantModeSelect" style="width: 210px;">
                    <option value="standard" @selected($variantMode === 'standard')>Standard</option>
                    <option value="chairs" @selected($variantMode === 'chairs')>Chaises</option>
                </select>
            <button type="button" class="btn btn-sm btn-admin-ghost" id="addVariantRow">Ajouter une variante</button>
            </div>
        </div>
        <div class="small mb-3" style="color: var(--admin-muted);" id="variantHelpText">Pour les matelas: renseigne Épaisseur + Places. Pour les couettes: renseigne Type + Places (Épaisseur = 0).</div>

        <div class="table-responsive">
            <table class="table table-dark table-borderless align-middle mb-0" style="--bs-table-bg: transparent; min-width: 760px;">
                <thead style="color: var(--admin-muted);">
                    <tr>
                        <th style="width:220px;" data-variant-col="type">Type (Couette)</th>
                        <th style="width:160px;" data-variant-col="thickness">Épaisseur (cm)</th>
                        <th style="width:140px;" data-variant-col="places">Places</th>
                        <th style="width:200px;">Prix (FCFA)</th>
                        <th style="width:160px;">Stock</th>
                        <th style="width:160px;">Actif</th>
                        <th style="width:80px;"></th>
                    </tr>
                </thead>
                <tbody id="variantsTbody" style="border-top: 1px solid var(--admin-border);">
                    @forelse($variantRows as $i => $row)
                        <tr>
                            <td data-variant-col="type">
                                <input type="text" class="form-control" name="variants[{{ $i }}][variant_type]" value="{{ $row['variant_type'] ?? '' }}" placeholder="Ex: Type A / Drap coton" data-variant-field="type">
                            </td>
                            <td data-variant-col="thickness">
                                <input type="hidden" name="variants[{{ $i }}][id]" value="{{ $row['id'] ?? '' }}">
                                <input type="number" class="form-control" name="variants[{{ $i }}][thickness_cm]" value="{{ $row['thickness_cm'] ?? '' }}" min="0" step="1" placeholder="Ex: 30" data-variant-field="thickness">
                            </td>
                            <td data-variant-col="places">
                                <input type="text" inputmode="decimal" class="form-control" name="variants[{{ $i }}][places]" value="{{ $row['places'] ?? '' }}" placeholder="Ex: 2,5" data-variant-field="places">
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
                <td data-variant-col="type">
                    <input type="text" class="form-control" data-name="variant_type" placeholder="Ex: Type A / Drap coton" data-variant-field="type">
                </td>
                <td data-variant-col="thickness">
                    <input type="hidden" data-name="id" value="">
                    <input type="number" class="form-control" data-name="thickness_cm" min="0" step="1" placeholder="Ex: 30" data-variant-field="thickness">
                </td>
                <td data-variant-col="places">
                    <input type="text" inputmode="decimal" class="form-control" data-name="places" placeholder="Ex: 2,5" data-variant-field="places">
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
            const modeSelect = document.getElementById('variantModeSelect');
            const helpText = document.getElementById('variantHelpText');

            if (!tbody || !addBtn || !tpl) return;

            const applyModeToRow = (row, mode) => {
                const typeInput = row.querySelector('[data-variant-field="type"]');
                const thicknessInput = row.querySelector('[data-variant-field="thickness"]');
                const placesInput = row.querySelector('[data-variant-field="places"]');

                if (mode === 'chairs') {
                    row.querySelectorAll('[data-variant-col="type"], [data-variant-col="thickness"]').forEach(el => {
                        el.style.display = 'none';
                    });

                    if (typeInput) {
                        typeInput.value = 'chairs';
                        typeInput.setAttribute('type', 'hidden');
                        typeInput.classList.add('d-none');
                    }

                    if (thicknessInput) {
                        thicknessInput.value = '0';
                        thicknessInput.setAttribute('type', 'hidden');
                        thicknessInput.classList.add('d-none');
                    }

                    if (placesInput) {
                        placesInput.setAttribute('type', 'number');
                        placesInput.removeAttribute('inputmode');
                        placesInput.setAttribute('step', '1');
                        placesInput.setAttribute('min', '1');
                        placesInput.setAttribute('placeholder', 'Ex: 4');
                    }
                } else {
                    row.querySelectorAll('[data-variant-col="type"], [data-variant-col="thickness"]').forEach(el => {
                        el.style.display = '';
                    });

                    if (typeInput) {
                        typeInput.setAttribute('type', 'text');
                        typeInput.classList.remove('d-none');
                    }
                    if (thicknessInput) {
                        thicknessInput.setAttribute('type', 'number');
                        thicknessInput.classList.remove('d-none');
                    }
                    if (placesInput) {
                        placesInput.setAttribute('type', 'text');
                        placesInput.setAttribute('inputmode', 'decimal');
                        placesInput.setAttribute('placeholder', 'Ex: 2,5');
                    }
                }
            };

            const applyMode = (mode) => {
                const placesHeader = document.querySelector('th[data-variant-col="places"]');
                if (placesHeader) {
                    placesHeader.textContent = mode === 'chairs' ? 'Nombre de chaises' : 'Places';
                }
                if (helpText) {
                    helpText.textContent = mode === 'chairs'
                        ? 'Renseigne le nombre de chaises (ex: 4, 6) et le prix correspondant.'
                        : 'Pour les matelas: renseigne Épaisseur + Places. Pour les couettes: renseigne Type + Places (Épaisseur = 0).';
                }

                tbody.querySelectorAll('tr').forEach(tr => {
                    if (tr.id === 'variantsEmptyRow') return;
                    applyModeToRow(tr, mode);
                });
            };

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
                const mode = modeSelect ? modeSelect.value : 'standard';
                applyModeToRow(tr, mode);
                tbody.appendChild(tr);
                return tr;
            };

            addBtn.addEventListener('click', addRow);

            if (modeSelect) {
                modeSelect.addEventListener('change', () => {
                    applyMode(modeSelect.value);

                    if (modeSelect.value === 'chairs') {
                        const hasAnyRow = !!tbody.querySelector('tr:not(#variantsEmptyRow)');
                        if (!hasAnyRow) {
                            const row4 = addRow();
                            const row6 = addRow();

                            const setPlaces = (row, v) => {
                                const input = row ? row.querySelector('[data-variant-field="places"]') : null;
                                if (input) input.value = String(v);
                            };
                            setPlaces(row4, 4);
                            setPlaces(row6, 6);
                        }
                    }
                });
                applyMode(modeSelect.value);
            }

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
            <div class="col-12 col-lg-6">
                <label class="form-label">Catégories Section Home (plusieurs)</label>
                <select name="category_ids[]" class="form-select" multiple>
                    @foreach(($homeSectionCategories ?? collect()) as $category)
                        <option value="{{ $category->id }}" @selected(in_array($category->id, $selectedCategoryIds))>
                            {{ $category->name }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="col-12 col-lg-6">
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
