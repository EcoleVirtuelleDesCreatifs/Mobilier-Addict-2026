@extends('layouts.admin')

@section('content')
    <div class="content-body">
        <div class="container-fluid">
            <div class="d-flex align-items-center justify-content-between gap-3 mb-4">
                <div>
                    <h1 class="h3 fw-bold mb-1">Nouvelle catégorie</h1>
                    <div class="small" style="color: var(--admin-muted);">Ajoute une catégorie au catalogue.</div>
                </div>
                <a href="{{ route('admin.categories.index') }}" class="btn btn-admin-ghost">Retour</a>
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

            <form method="POST" action="{{ route('admin.categories.store') }}" enctype="multipart/form-data" class="admin-card p-4">
                @csrf

                <div class="row g-3">
                    <div class="col-12 col-lg-6">
                        <label class="form-label">Nom</label>
                        <input type="text" name="name" value="{{ old('name') }}" class="form-control" required>
                    </div>
                    <div class="col-12 col-lg-6">
                        <label class="form-label">Slug (optionnel)</label>
                        <input type="text" name="slug" value="{{ old('slug') }}" class="form-control">
                    </div>

                    <div class="col-12">
                        <label class="form-label">Description</label>
                        <textarea name="description" class="form-control" rows="4">{{ old('description') }}</textarea>
                    </div>

                    <div class="col-12 col-lg-6">
                        <label class="form-label">Image</label>
                        <input type="file" name="image" class="form-control" required>
                    </div>
                    <div class="col-12 col-lg-6">
                        <label class="form-label">Texte alternatif (alt)</label>
                        <input type="text" name="image_alt" value="{{ old('image_alt') }}" class="form-control">
                    </div>

                    <div class="col-12 col-lg-4">
                        <label class="form-label">Parent</label>
                        <select name="parent_id" class="form-select">
                            <option value="">—</option>
                            @foreach($parents as $parent)
                                <option value="{{ $parent->id }}" @selected(old('parent_id') == $parent->id)>{{ $parent->name }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="col-12 col-lg-4">
                        <label class="form-label">Menus rattachés</label>
                        <select name="menu_ids[]" class="form-select" multiple>
                            @foreach(($menus ?? collect()) as $menu)
                                <option value="{{ $menu->id }}" @selected(in_array($menu->id, old('menu_ids', [])))>
                                    {{ $menu->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="col-12 col-lg-4">
                        <label class="form-label">Taille</label>
                        <select name="size" class="form-select" required>
                            @foreach(['small' => 'Small', 'medium' => 'Medium', 'large' => 'Large'] as $k => $v)
                                <option value="{{ $k }}" @selected(old('size', 'small') === $k)>{{ $v }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="col-12 col-lg-2">
                        <label class="form-label">Ordre</label>
                        <input type="number" name="order" value="{{ old('order', 0) }}" class="form-control">
                    </div>

                    <div class="col-12 col-lg-2">
                        <label class="form-label">Actif</label>
                        <select name="is_active" class="form-select">
                            <option value="1" @selected(old('is_active', 1) == 1)>Oui</option>
                            <option value="0" @selected(old('is_active', 1) == 0)>Non</option>
                        </select>
                    </div>

                    <div class="col-12">
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" name="is_featured" value="1" id="is_featured" @checked(old('is_featured'))>
                            <label class="form-check-label" for="is_featured">Mis en avant</label>
                        </div>
                    </div>

                    <div class="col-12">
                        <label class="form-label">Produits rattachés</label>
                        <select name="product_ids[]" class="form-select" multiple style="height: 200px;">
                            @php
                                $products = \App\Models\Product::query()
                                    ->orderBy('name')
                                    ->get();
                            @endphp
                            @foreach($products as $product)
                                <option value="{{ $product->id }}" @selected(in_array($product->id, old('product_ids', [])))>
                                    {{ $product->name }} ({{ $product->price }}F)
                                </option>
                            @endforeach
                        </select>
                        <div class="small" style="color: var(--admin-muted); margin-top: 4px;">Sélectionnez les produits à afficher dans cette catégorie</div>
                    </div>

                    <div class="col-12 d-flex justify-content-end gap-2">
                        <a href="{{ route('admin.categories.index') }}" class="btn btn-admin-ghost">Annuler</a>
                        <button type="submit" class="btn btn-admin-primary">Créer</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection
