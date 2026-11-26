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

@push('styles')
<style>
    .pf-req{color:#e11d48;margin-left:2px}
    .pf-hint{font-size:12px;color:var(--admin-muted);margin-top:4px}
    .pf-count{font-size:12px;font-weight:400;color:var(--admin-muted);margin-left:auto}
    label:has(>.pf-count){display:flex;align-items:baseline;gap:2px;width:100%}
    .pf-count.is-warn{color:#d97706}.pf-count.is-bad{color:#e11d48}
    .pf-title{display:flex;align-items:center;gap:10px;font-weight:600;margin-bottom:12px}
    .pf-title span{display:inline-grid;place-items:center;width:26px;height:26px;border-radius:50%;background:rgba(240,40,110,.12);color:#F0286E;font-size:12px;font-weight:700}
    .pf-nav{position:sticky;top:64px;z-index:5;display:flex;flex-wrap:wrap;gap:6px;padding:8px;margin:-4px 0 4px;border-radius:12px;background:var(--admin-card-bg,#fff);border:1px solid var(--admin-border);box-shadow:0 6px 18px -12px rgba(0,0,0,.25)}
    .pf-nav a{padding:6px 12px;border-radius:999px;font-size:13px;color:inherit;text-decoration:none}
    .pf-nav a:hover{background:rgba(240,40,110,.1);color:#F0286E}
    .pf-chips{display:flex;flex-wrap:wrap;gap:8px}
    .pf-chip{position:relative;margin:0}
    .pf-chip input{position:absolute;opacity:0;pointer-events:none}
    .pf-chip span{display:inline-flex;align-items:center;gap:6px;padding:7px 14px;border-radius:999px;border:1px solid var(--admin-border);font-size:13px;cursor:pointer;user-select:none;transition:.15s}
    .pf-chip input:checked+span{background:#0B1A3F;border-color:#0B1A3F;color:#fff}
    .pf-chip input:checked+span::before{content:'✓'}
    .pf-chip input:focus-visible+span{outline:2px solid #F0286E;outline-offset:2px}
    .pf-money{position:relative}
    .pf-money .form-control{padding-right:64px}
    .pf-money::after{content:'FCFA';position:absolute;right:12px;top:50%;transform:translateY(-50%);font-size:12px;color:var(--admin-muted);pointer-events:none}
    .pf-serp{border:1px solid var(--admin-border);border-radius:12px;padding:14px 16px;background:#fff;font-family:Arial,sans-serif}
    .pf-serp-url{font-size:12px;color:#4d5156}
    .pf-serp-title{font-size:18px;line-height:1.3;color:#1a0dab;margin:2px 0;overflow:hidden;text-overflow:ellipsis;white-space:nowrap}
    .pf-serp-desc{font-size:13px;line-height:1.5;color:#4d5156}
    .pf-actions{position:sticky;bottom:0;z-index:5;display:flex;justify-content:flex-end;align-items:center;gap:10px;padding:12px 16px;margin:16px -24px -24px;border-top:1px solid var(--admin-border);background:var(--admin-card-bg,#fff);border-radius:0 0 16px 16px}
    .pf-actions .pf-dirty{margin-right:auto;font-size:13px;color:var(--admin-muted)}
</style>
@endpush

<nav class="pf-nav" aria-label="Sections du formulaire">
    <a href="#pf-description">Description</a><a href="#pf-prix">Prix &amp; images</a><a href="#pf-caracteristiques">Caractéristiques</a><a href="#pf-variantes">Variantes</a><a href="#pf-emplacement">Emplacement</a><a href="#pf-visibilite">Visibilité</a><a href="#pf-seo">SEO</a>
</nav>

<input type="hidden" name="slug" value="{{ old('slug', $isEdit ? $product->slug : null) }}">
<input type="hidden" name="variants_enabled" value="1">

<div class="d-grid gap-3">
    <div class="admin-card p-3" id="pf-description">
        <div class="pf-title"><span>1</span>Description du produit</div>
        <div class="row g-3">
            <div class="col-12 col-lg-6">
                <label class="form-label" for="pf-name">Nom du produit<span class="pf-req">*</span> <span class="pf-count" data-count-for="pf-name" data-max="80"></span></label>
                <input type="text" id="pf-name" name="name" value="{{ old('name', $isEdit ? $product->name : null) }}" class="form-control @error('name') is-invalid @enderror" required maxlength="255" placeholder="Ex : Matelas Addict PH10 ferme 140×190 cm — 2 places" autocomplete="off">
                @error('name')<div class="invalid-feedback">{{ $message }}</div>@enderror
                <div class="pf-hint">Type · gamme · fermeté · dimensions — places. Évitez les MAJUSCULES et les tirets.</div>
            </div>

            <div class="col-12 col-lg-6">
                <label class="form-label">Image principale{!! $isEdit ? ' <small class="text-muted">(laisser vide pour conserver)</small>' : '<span class="pf-req">*</span>' !!}</label>
                <input type="file" name="image" class="form-control @error('image') is-invalid @enderror" accept="image/jpeg,image/png,image/webp" {{ $isEdit ? '' : 'required' }} data-role="image-input" data-preview="mainImagePreview">
                @error('image')<div class="invalid-feedback">{{ $message }}</div>@enderror
                <div class="pf-hint">Carrée, 1200 × 1200 px conseillé · JPG, PNG ou WebP · 4 Mo max. Convertie en WebP automatiquement.</div>
                <div class="mt-2 rounded-3 overflow-hidden d-none" style="width:120px;height:120px;border:1px solid var(--admin-border);" id="mainImagePreview">
                    <img src="" alt="" style="width:100%;height:100%;object-fit:cover;">
                </div>
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
                <label class="form-label" for="pf-short">Résumé <span class="pf-count" data-count-for="pf-short" data-max="160"></span></label>
                <textarea id="pf-short" name="short_description" class="form-control" rows="2" placeholder="Une phrase qui donne envie : bénéfice principal, fermeté, garantie…">{{ old('short_description', $isEdit ? $product->short_description : null) }}</textarea>
            </div>

            <div class="col-12">
                <label class="form-label">Description</label>
                <textarea id="product_description" name="description" class="form-control" rows="8">{{ old('description', $isEdit ? $product->description : null) }}</textarea>
            </div>

        </div>
    </div>

    <div class="admin-card p-3" id="pf-prix">
        <div class="pf-title"><span>2</span>Prix &amp; images</div>
        <div class="row g-3">
            <div class="col-12 col-lg-3">
                <label class="form-label" for="pf-price">{{ $isEdit ? 'Prix actuel' : 'Prix' }}<span class="pf-req">*</span></label>
                <div class="pf-money"><input type="number" id="pf-price" step="1" min="0" inputmode="numeric" name="price" value="{{ $isEdit ? $displayPrice : old('price') }}" class="form-control @error('price') is-invalid @enderror" required placeholder="Ex : 150000"></div>
                @error('price')<div class="invalid-feedback d-block">{{ $message }}</div>@enderror
            </div>
            <div class="col-12 col-lg-3">
                <label class="form-label" for="pf-promo">Prix promo</label>
                <div class="pf-money"><input type="number" id="pf-promo" step="1" min="0" inputmode="numeric" name="promo_price" value="{{ $isEdit ? $displayPromoPrice : old('promo_price') }}" class="form-control @error('promo_price') is-invalid @enderror" placeholder="Optionnel"></div>
                <div class="pf-hint" id="pf-promo-info">Doit être inférieur au prix.</div>
            </div>
            <div class="col-12 col-lg-3">
                <label class="form-label" for="pf-shipping">Prix de livraison</label>
                <div class="pf-money"><input type="number" id="pf-shipping" step="1" min="0" inputmode="numeric" name="shipping_price" value="{{ old('shipping_price', $isEdit ? ($product->shipping_price ?? 0) : 0) }}" class="form-control"></div>
                <div class="pf-hint">0 = livraison gratuite.</div>
            </div>
            <div class="col-12 col-lg-3">
                <label class="form-label" for="pf-stock">Stock (sans variante)</label>
                <input type="number" id="pf-stock" name="stock" min="0" step="1" value="{{ old('stock', $isEdit ? $product->stock : 0) }}" class="form-control">
                <div class="pf-hint">Avec des variantes, c'est leur stock qui compte.</div>
            </div>

            <div class="col-12 col-lg-6">
                <label class="form-label">Couleurs disponibles <small class="text-muted">(draps, taies…)</small></label>
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
                <label class="form-label">Galerie <small class="text-muted">(plusieurs images, vues détail, mise en situation)</small></label>
                <input type="file" name="gallery[]" class="form-control" accept="image/jpeg,image/png,image/webp" multiple data-role="gallery-input">
                <div class="d-flex flex-wrap gap-2 mt-2" data-role="gallery-preview"></div>
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

    <div class="admin-card p-3" id="pf-caracteristiques">
        <div class="pf-title"><span>3</span>Caractéristiques</div>
        <div class="row g-3">
            <div class="col-12 col-lg-3">
                <label class="form-label">SKU (référence)</label>
                <input type="text" name="sku" value="{{ old('sku', $isEdit ? $product->sku : null) }}" class="form-control" placeholder="Ex: MAT-001">
            </div>
            <div class="col-12 col-lg-3">
                <label class="form-label">Dimensions</label>
                <input type="text" name="dimensions" value="{{ old('dimensions', $isEdit ? $product->dimensions : null) }}" class="form-control" placeholder="Ex : 140 × 190 cm">
            </div>
            <div class="col-12 col-lg-3">
                <label class="form-label">Matière</label>
                <input type="text" name="material" value="{{ old('material', $isEdit ? $product->material : null) }}" class="form-control" placeholder="Ex: Bois massif">
            </div>
            <div class="col-12 col-lg-3">
                <label class="form-label">Couleur principale</label>
                <input type="text" name="color" value="{{ old('color', $isEdit ? $product->color : null) }}" class="form-control" placeholder="Ex: Bleu nuit">
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

            const imageInput = document.querySelector('[data-role="image-input"]');
            if (imageInput) {
                imageInput.addEventListener('change', function () {
                    const file = this.files && this.files[0];
                    const preview = document.getElementById(this.getAttribute('data-preview'));
                    if (!preview) return;
                    if (file && file.type.startsWith('image/')) {
                        preview.querySelector('img').src = URL.createObjectURL(file);
                        preview.classList.remove('d-none');
                    } else {
                        preview.classList.add('d-none');
                    }
                });
            }

            const galleryInput = document.querySelector('[data-role="gallery-input"]');
            const galleryPreview = document.querySelector('[data-role="gallery-preview"]');
            if (galleryInput && galleryPreview) {
                galleryInput.addEventListener('change', function () {
                    galleryPreview.innerHTML = '';
                    Array.from(this.files || []).slice(0, 12).forEach(function (file) {
                        if (!file.type.startsWith('image/')) return;
                        const wrap = document.createElement('div');
                        wrap.className = 'rounded-3 overflow-hidden';
                        wrap.style.cssText = 'width:56px;height:56px;border:1px solid var(--admin-border);';
                        const img = document.createElement('img');
                        img.src = URL.createObjectURL(file);
                        img.style.cssText = 'width:100%;height:100%;object-fit:cover;';
                        wrap.appendChild(img);
                        galleryPreview.appendChild(wrap);
                    });
                });
            }
        });
    </script>

    <div class="admin-card p-3" id="pf-variantes">
        <div class="d-flex align-items-center justify-content-between gap-3 mb-2">
            <div class="pf-title mb-0"><span>4</span>Variantes <small class="text-muted fw-normal">(tailles, épaisseurs, nombre de chaises…)</small></div>
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
            <table class="table table-borderless align-middle mb-0" style="--bs-table-bg: transparent; min-width: 760px;">
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
                        el.classList.add('d-none');
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
                        el.classList.remove('d-none');
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
                const typeHeader = document.querySelector('th[data-variant-col="type"]');
                const thicknessHeader = document.querySelector('th[data-variant-col="thickness"]');
                const placesHeader = document.querySelector('th[data-variant-col="places"]');

                if (typeHeader) {
                    typeHeader.classList.toggle('d-none', mode === 'chairs');
                }

                if (thicknessHeader) {
                    thicknessHeader.classList.toggle('d-none', mode === 'chairs');
                }

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

                const empty = document.getElementById('variantsEmptyRow');
                if (empty) {
                    const colSpan = mode === 'chairs' ? 5 : 7;
                    empty.innerHTML = `<td colspan="${colSpan}" style="color: var(--admin-muted);">Aucune variante. Clique sur “Ajouter une variante”.</td>`;
                }
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
                    const colSpan = (modeSelect && modeSelect.value === 'chairs') ? 5 : 7;
                    empty.innerHTML = `<td colspan="${colSpan}" style="color: var(--admin-muted);">Aucune variante. Clique sur “Ajouter une variante”.</td>`;
                    tbody.appendChild(empty);
                }
            });
        });
        </script>
    </div>

    <div class="admin-card p-3" id="pf-emplacement">
        <div class="pf-title"><span>5</span>Emplacement dans la boutique</div>
        @php
            $defaultSelected = $selectedMenuIds ?? ($isEdit ? $product->menus->pluck('id')->all() : []);
            $selected = old('menu_ids', $defaultSelected);
            $selected = array_map('intval', is_array($selected) ? $selected : []);
            $selectedCats = array_map('intval', $selectedCategoryIds);
        @endphp
        <div class="row g-4">
            <div class="col-12">
                <label class="form-label d-block">Rayons (menus)<span class="pf-req">*</span> <small class="text-muted">— où le produit apparaît dans la boutique</small></label>
                <div class="pf-chips">
                    @forelse(($menus ?? collect()) as $menu)
                        <label class="pf-chip"><input type="checkbox" name="menu_ids[]" value="{{ $menu->id }}" @checked(in_array((int) $menu->id, $selected, true))><span>{{ $menu->name }}</span></label>
                    @empty
                        <span class="pf-hint">Aucun menu. Créez d'abord un menu.</span>
                    @endforelse
                </div>
                <div class="pf-hint" id="pf-menu-warn" hidden>Sans rayon, le produit n'apparaîtra dans aucune liste de la boutique.</div>
            </div>

            <div class="col-12">
                <label class="form-label d-block">Catégories de la page d'accueil</label>
                <div class="pf-chips">
                    @forelse(($homeSectionCategories ?? collect()) as $category)
                        <label class="pf-chip"><input type="checkbox" name="category_ids[]" value="{{ $category->id }}" @checked(in_array((int) $category->id, $selectedCats, true))><span>{{ $category->name }}</span></label>
                    @empty
                        <span class="pf-hint">Aucune catégorie de page d'accueil.</span>
                    @endforelse
                </div>
            </div>

            <div class="col-12 col-lg-8">
                <label class="form-label d-block">Sections mises en avant</label>
                <div class="pf-chips">
                    <label class="pf-chip"><input type="checkbox" name="sections[]" value="collection" @checked(in_array('collection', $selectedSections, true))><span>Nos Matelas d'Exception</span></label>
                    <label class="pf-chip"><input type="checkbox" name="sections[]" value="featured" @checked(in_array('featured', $selectedSections, true))><span>Les Essentiels</span></label>
                    <label class="pf-chip"><input type="checkbox" name="sections[]" value="bestseller" @checked(in_array('bestseller', $selectedSections, true))><span>Best sellers</span></label>
                </div>
            </div>

            <div class="col-12 col-lg-4">
                <label class="form-label" for="pf-order">Ordre d'affichage</label>
                <input type="number" id="pf-order" name="order" value="{{ old('order', $isEdit ? $product->order : 0) }}" class="form-control">
                <div class="pf-hint">Plus petit = affiché en premier.</div>
            </div>
        </div>
    </div>

    <div class="admin-card p-3" id="pf-visibilite">
        <div class="pf-title"><span>6</span>Visibilité &amp; badge</div>
        <div class="row g-3">
            <div class="col-12 col-lg-3">
                <label class="form-label">En ligne</label>
                <select name="is_active" class="form-select">
                    @php $activeValue = old('is_active', $isEdit ? ($product->is_active ? 1 : 0) : 1); @endphp
                    <option value="1" @selected($activeValue == 1)>En ligne</option>
                    <option value="0" @selected($activeValue == 0)>Hors ligne</option>
                </select>
            </div>

            <div class="col-12 col-lg-3">
                <label class="form-label">Badge</label>
                <input type="text" name="badge" value="{{ old('badge', $isEdit ? $product->badge : null) }}" class="form-control" placeholder="Ex: -20%, Promo">
            </div>
            <div class="col-12 col-lg-3">
                <label class="form-label">Type de badge</label>
                @php $badgeType = old('badge_type', $isEdit ? $product->badge_type : null); @endphp
                <select name="badge_type" class="form-select">
                    <option value="">—</option>
                    <option value="new" @selected($badgeType === 'new')>Nouveau</option>
                    <option value="hot" @selected($badgeType === 'hot')>Tendance</option>
                    <option value="sale" @selected($badgeType === 'sale')>Promotion</option>
                    <option value="custom" @selected($badgeType === 'custom')>Personnalisé</option>
                </select>
            </div>

        </div>
    </div>

    <div class="admin-card p-3" id="pf-seo">
        <div class="pf-title"><span>7</span>Référencement Google (SEO)</div>
        <div class="row g-3">
            <div class="col-12 col-xl-7">
                <label class="form-label" for="pf-seo-title">Titre Google <span class="pf-count" data-count-for="pf-seo-title" data-max="60"></span></label>
                <input type="text" id="pf-seo-title" name="seo_title" value="{{ old('seo_title', $isEdit ? ($product->seo_title ?? null) : null) }}" class="form-control" maxlength="255" placeholder="Laisser vide : généré à partir du nom">
                <div class="pf-hint">60 caractères max. Vide = « Nom Dimensions | Mobilier Addict ».</div>

                <label class="form-label mt-3" for="pf-seo-desc">Description Google <span class="pf-count" data-count-for="pf-seo-desc" data-max="155"></span></label>
                <textarea id="pf-seo-desc" name="seo_description" class="form-control" rows="3" placeholder="Laisser vide : le résumé est utilisé">{{ old('seo_description', $isEdit ? ($product->seo_description ?? null) : null) }}</textarea>
                <div class="pf-hint">120 à 155 caractères : bénéfice, prix ou livraison à Abidjan, appel à l'action.</div>

                <label class="form-label mt-3" for="pf-seo-kw">Mots-clés <small class="text-muted">(usage interne)</small></label>
                <input type="text" id="pf-seo-kw" name="seo_keywords" value="{{ old('seo_keywords', $isEdit ? ($product->seo_keywords ?? null) : null) }}" class="form-control" placeholder="Ex : matelas ferme Abidjan, matelas 140x190">
            </div>
            <div class="col-12 col-xl-5">
                <label class="form-label">Aperçu dans Google</label>
                <div class="pf-serp" aria-live="polite">
                    <div class="pf-serp-url">mobilier-addict.com › produit</div>
                    <div class="pf-serp-title" id="pf-serp-title">Nom du produit | Mobilier Addict</div>
                    <div class="pf-serp-desc" id="pf-serp-desc">La description apparaîtra ici.</div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function () {
    const $ = (id) => document.getElementById(id);
    const form = document.querySelector('[data-product-form]') || ($('pf-name') && $('pf-name').form);
    if (!form) return;

    // Compteurs de caractères
    document.querySelectorAll('[data-count-for]').forEach(function (counter) {
        const field = $(counter.dataset.countFor);
        const max = parseInt(counter.dataset.max, 10);
        if (!field) return;
        const update = function () {
            const n = field.value.trim().length;
            counter.textContent = n + ' / ' + max;
            counter.classList.toggle('is-warn', n > max * 0.9 && n <= max);
            counter.classList.toggle('is-bad', n > max);
        };
        field.addEventListener('input', update);
        update();
    });

    // Promo : remise calculée et contrôle promo < prix
    const price = $('pf-price'), promo = $('pf-promo'), info = $('pf-promo-info');
    const checkPromo = function () {
        if (!price || !promo || !info) return;
        const p = parseFloat(price.value), q = parseFloat(promo.value);
        promo.setCustomValidity('');
        if (!q) { info.textContent = 'Doit être inférieur au prix.'; info.style.color = ''; return; }
        if (p && q >= p) { promo.setCustomValidity('Le prix promo doit être inférieur au prix.'); info.textContent = 'Le prix promo doit être inférieur au prix.'; info.style.color = '#e11d48'; return; }
        if (p) { info.textContent = 'Remise affichée : -' + Math.round((p - q) / p * 100) + ' %'; info.style.color = '#16a34a'; }
    };
    [price, promo].forEach(el => el && el.addEventListener('input', checkPromo));
    checkPromo();

    // Aperçu Google
    const name = $('pf-name'), seoTitle = $('pf-seo-title'), seoDesc = $('pf-seo-desc'), shortDesc = $('pf-short');
    const cut = (t, n) => t.length > n ? t.slice(0, n - 1).replace(/\s+\S*$/, '') + '…' : t;
    const serp = function () {
        const base = (name && name.value.trim()) || 'Nom du produit';
        const title = (seoTitle && seoTitle.value.trim()) || cut(base.replace(/\s*cm\s*—.*$/, '').replace(/\s+—.*$/, ''), 42) + ' | Mobilier Addict';
        const desc = (seoDesc && seoDesc.value.trim()) || (shortDesc && shortDesc.value.trim()) || 'Achetez ' + base + ' à Abidjan chez Mobilier Addict.';
        $('pf-serp-title').textContent = cut(title, 62);
        $('pf-serp-desc').textContent = cut(desc, 158);
    };
    [name, seoTitle, seoDesc, shortDesc].forEach(el => el && el.addEventListener('input', serp));
    serp();

    // Avertissement : aucun rayon coché
    const menuWarn = $('pf-menu-warn');
    const menuBoxes = form.querySelectorAll('input[name="menu_ids[]"]');
    const checkMenus = function () { if (menuWarn) menuWarn.hidden = Array.from(menuBoxes).some(b => b.checked) || !menuBoxes.length; };
    menuBoxes.forEach(b => b.addEventListener('change', checkMenus));
    checkMenus();

    // Modifications non enregistrées + double clic sur « Enregistrer »
    let dirty = false;
    const dirtyLabel = form.querySelector('.pf-dirty');
    form.addEventListener('input', function () { dirty = true; if (dirtyLabel) dirtyLabel.textContent = 'Modifications non enregistrées'; });
    form.addEventListener('change', function () { dirty = true; if (dirtyLabel) dirtyLabel.textContent = 'Modifications non enregistrées'; });
    window.addEventListener('beforeunload', function (e) { if (dirty) { e.preventDefault(); e.returnValue = ''; } });
    form.addEventListener('submit', function () {
        dirty = false;
        form.querySelectorAll('button[type="submit"]').forEach(function (b) { b.disabled = true; b.dataset.label = b.textContent; b.textContent = 'Enregistrement…'; });
    });
});
</script>
