@extends('layouts.admin')

@section('content')
    <div class="content-body">
        <div class="container-fluid">
            <div class="d-flex align-items-center justify-content-between gap-3 mb-4">
                <div>
                    <h1 class="h3 fw-bold mb-1">Modifier catégorie</h1>
                    <div class="small" style="color: var(--admin-muted);">{{ $category->name }}</div>
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

            <form method="POST" action="{{ route('admin.categories.update', $category) }}" enctype="multipart/form-data" class="admin-card p-4">
                @csrf
                @method('PUT')

                <div class="row g-3">
                    <div class="col-12">
                        <label class="form-label">Nom de la catégorie</label>
                        <input type="text" name="name" id="name" value="{{ old('name', $category->name) }}" class="form-control" required>
                    </div>

                    <div class="col-12">
                        <label class="form-label">Description</label>
                        <textarea name="description" class="form-control" rows="3">{{ old('description', $category->description) }}</textarea>
                    </div>

                    <div class="col-12 col-lg-6">
                        <label class="form-label">Image</label>
                        <input type="file" name="image" class="form-control">
                        <div class="mt-2 rounded-3 overflow-hidden" style="width:120px;height:120px;border:1px solid var(--admin-border);">
                            <img src="@image_url($category->image)" alt="" style="width:100%;height:100%;object-fit:cover;">
                        </div>
                    </div>

                    <div class="col-12 col-lg-6">
                        <label class="form-label">Menus rattachés</label>
                        @php
                            $defaultSelected = $selectedMenuIds ?? [];
                            $selected = old('menu_ids', $defaultSelected);
                        @endphp
                        <select name="menu_ids[]" class="form-select" multiple style="height: 120px;">
                            @foreach(($menus ?? collect()) as $menu)
                                <option value="{{ $menu->id }}" @selected(in_array($menu->id, $selected))>
                                    {{ $menu->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="col-12">
                        <label class="form-label">Produits rattachés</label>
                        <select name="product_ids[]" class="form-select" multiple style="height: 200px;">
                            @php
                                $products = \App\Models\Product::query()
                                    ->orderBy('name')
                                    ->get();
                                $categoryProductIds = $category->products()->pluck('products.id')->values()->all();
                            @endphp
                            @foreach($products as $product)
                                <option value="{{ $product->id }}" @selected(in_array($product->id, $categoryProductIds))>
                                    {{ $product->name }} ({{ $product->price }}F)
                                </option>
                            @endforeach
                        </select>
                        <div class="small" style="color: var(--admin-muted); margin-top: 4px;">Sélectionnez les produits à afficher dans cette catégorie</div>
                    </div>

                    <div class="col-12 d-flex justify-content-end gap-2">
                        <a href="{{ route('admin.categories.index') }}" class="btn btn-admin-ghost">Annuler</a>
                        <button type="submit" class="btn btn-admin-primary">Enregistrer</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

@endsection
