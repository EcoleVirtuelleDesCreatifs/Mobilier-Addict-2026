@extends('layouts.admin')

@section('content')




<!--**********************************
    Content body start
***********************************-->
<div class="content-body">
    <div class="container-fluid">


                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title">CRÉER UN MENU</h4>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">



                                <form action="{{ route('admin.menus.store') }}" method="POST">
                                    @csrf

                                    {{-- Titre --}}
                                    <div class="form-group mb-3">
                                        <label for="name">Titre du menu</label>
                                        <input type="text" name="name" id="name" class="form-control" value="{{ old('name') }}" required>
                                        @error('name')
                                            <small class="text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>

                                    {{-- Slug --}}
                                    <div class="form-group mb-3">
                                        <label for="slug">Slug (optionnel)</label>
                                        <input type="text" name="slug" id="slug" class="form-control" value="{{ old('slug') }}">
                                        <small class="form-text text-muted">Laissez vide pour génération automatique</small>
                                        @error('slug')
                                            <small class="text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>

                                    {{-- URL --}}
                                    <div class="form-group mb-3">
                                        <label for="url">URL (optionnel)</label>
                                        <input type="text" name="url" id="url" class="form-control" value="{{ old('url') }}" placeholder="https://example.com ou /page">
                                        <small class="form-text text-muted">URL externe ou interne pour ce menu</small>
                                        @error('url')
                                            <small class="text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>

                                    <div class="form-group mb-3">
                                        <label for="product_ids">Produits rattachés (optionnel)</label>
                                        <select name="product_ids[]" id="product_ids" class="form-control" multiple>
                                            @foreach(($products ?? collect()) as $product)
                                                <option value="{{ $product->id }}" @selected(in_array($product->id, old('product_ids', [])))>
                                                    {{ $product->name }}
                                                </option>
                                            @endforeach
                                        </select>
                                        @error('product_ids')
                                            <small class="text-danger">{{ $message }}</small>
                                        @enderror
                                        @error('product_ids.*')
                                            <small class="text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>

                                    {{-- Menu parent --}}
                                    <div class="form-group mb-3">
                                        <label for="parent_id">Menu parent (optionnel)</label>
                                        <select name="parent_id" id="parent_id" class="form-control">
                                            <option value="">-- Menu principal --</option>
                                            @foreach($parentMenus as $parentMenu)
                                                <option value="{{ $parentMenu->id }}" {{ old('parent_id') == $parentMenu->id ? 'selected' : '' }}>
                                                    {{ $parentMenu->name }}
                                                </option>
                                            @endforeach
                                        </select>
                                        <small class="form-text text-muted">Sélectionnez un menu parent pour créer un sous-menu</small>
                                        @error('parent_id')
                                            <small class="text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>

                                    {{-- Position --}}
                                    <div class="form-group mb-3">
                                        <label for="position">Emplacement</label>
                                        <select name="position" id="position" class="form-control" required>
                                            <option value="header" {{ old('position', 'header') === 'header' ? 'selected' : '' }}>Header</option>
                                            <option value="footer" {{ old('position') === 'footer' ? 'selected' : '' }}>Footer</option>
                                            <option value="sidebar" {{ old('position') === 'sidebar' ? 'selected' : '' }}>Sidebar</option>
                                        </select>
                                        @error('position')
                                            <small class="text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>

                                    <div class="form-group mb-3">
                                        <label for="order">Ordre</label>
                                        <input type="number" name="order" id="order" class="form-control" value="{{ old('order') }}" min="0">
                                        @error('order')
                                            <small class="text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>

                                    <div class="form-group mb-3">
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" name="is_active" id="is_active" value="1" {{ old('is_active', true) ? 'checked' : '' }}>
                                            <label class="form-check-label" for="is_active">Actif</label>
                                        </div>
                                    </div>

                                    <div class="form-group mb-3">
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" name="open_new_tab" id="open_new_tab" value="1" {{ old('open_new_tab') ? 'checked' : '' }}>
                                            <label class="form-check-label" for="open_new_tab">Ouvrir dans un nouvel onglet</label>
                                        </div>
                                    </div>

                                    {{-- Boutons --}}
                                    <div class="form-group">
                                        <button type="submit" class="btn btn-primary">
                                            <i class="fa fa-save"></i> Créer le menu
                                        </button>
                                        <a href="{{ route('admin.menus.index') }}" class="btn btn-secondary ml-2">
                                            <i class="fa fa-times"></i> Annuler
                                        </a>
                                    </div>

                                </form>


                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!--**********************************
    Content body end
***********************************-->

<script>
document.addEventListener('DOMContentLoaded', function() {
    const nameInput = document.getElementById('name');
    const slugInput = document.getElementById('slug');

    if (nameInput && slugInput) {
        nameInput.addEventListener('input', function() {
            // Only auto-generate if slug is empty or hasn't been manually modified
            if (!slugInput.dataset.modified) {
                const slug = this.value
                    .toLowerCase()
                    .normalize('NFD')
                    .replace(/[\u0300-\u036f]/g, '')
                    .replace(/[^a-z0-9\s-]/g, '')
                    .trim()
                    .replace(/\s+/g, '-')
                    .replace(/-+/g, '-');
                slugInput.value = slug;
            }
        });

        // Mark slug as modified when user manually edits it
        slugInput.addEventListener('input', function() {
            if (this.value !== '') {
                this.dataset.modified = 'true';
            }
        });
    }
});
</script>

@endsection
